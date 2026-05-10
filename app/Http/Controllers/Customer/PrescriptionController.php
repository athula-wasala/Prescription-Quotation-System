<?php

namespace App\Http\Controllers\Customer;

use Throwable;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Models\Prescription;
use App\Models\PrescriptionImage;
use App\Models\Quotation;

use App\Http\Controllers\Controller;

class PrescriptionController extends Controller
{
    /**
     * Show customer prescriptions (ONLY THEIR OWN)
     */
    public function index()
    { 
        $prescriptions = Prescription::with(['images', 'quotation.items'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('customer.prescriptions.index', compact('prescriptions'));
    }

    /**
     * Show create form
     */
    public function create(): View
    {
        return view('customer.prescriptions.create');
    }

    /**
     * Store prescription
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'delivery_address' => ['required', 'string', 'max:255'],
            'delivery_time' => ['required', 'string', 'max:255'],
            'note' => ['nullable', 'string'],

            'images' => ['required', 'array', 'max:5'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        try {

            $prescription = Prescription::create([
                'user_id' => auth()->id(),
                'note' => $validated['note'] ?? null,
                'delivery_address' => $validated['delivery_address'],
                'delivery_time' => $validated['delivery_time'],
                'status' => 'pending',
            ]);

            foreach ($request->file('images') as $image) {

                $path = $image->store('prescriptions', 'public');

                PrescriptionImage::create([
                    'prescription_id' => $prescription->id,
                    'image_path' => $path,
                ]);
            }

            return redirect()
                ->route('customer.prescriptions.index')
                ->with('success', 'Prescription uploaded successfully.');

        } catch (Throwable $e) {

            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'Failed to upload prescription.',
                ]);
        }
    }

    /**
     * Accept quotation
     */
    public function acceptQuotation(Quotation $quotation): RedirectResponse
    {
        $quotation->update([
            'status' => 'accepted',
        ]);

        $quotation->prescription->update([
            'status' => 'accepted',
        ]);

        return back()->with(
            'success',
            'Quotation accepted successfully.'
        );
    }

    /**
     * Reject quotation
     */
    public function rejectQuotation(Quotation $quotation): RedirectResponse
    {
        $quotation->update([
            'status' => 'rejected',
        ]);

        $quotation->prescription->update([
            'status' => 'rejected',
        ]);

        return back()->with(
            'success',
            'Quotation rejected successfully.'
        );
    }
}