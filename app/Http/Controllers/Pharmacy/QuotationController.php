<?php

namespace App\Http\Controllers\Pharmacy;

use Throwable;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Notifications\QuotationCreatedNotification;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class QuotationController extends Controller
{
    /**
     * Display quotation form.
     */
    public function create(
        Prescription $prescription
    ): View {

        return view(
            'pharmacy.quotations.create',
            compact('prescription')
        );
    }

    /**
     * Store quotation.
     */
    public function store(
        Request $request,
        Prescription $prescription
    ): RedirectResponse {

        $validated = $request->validate([

            'drug_name.*' => [
                'required',
                'string',
                'max:255',
            ],

            'quantity.*' => [
                'required',
                'integer',
                'min:1',
            ],

            'unit_price.*' => [
                'required',
                'numeric',
                'min:0',
            ],

        ]);

        DB::beginTransaction();

        try 
        {

            $quotation = Quotation::create([

                'prescription_id' =>
                    $prescription->id,

                'total_amount' => 0,

                'status' => 'pending',

            ]);

            $grandTotal = 0;

            foreach ($validated['drug_name']  as $index => $drugName) 
            {

                $quantity =
                    $validated['quantity'][$index];

                $unitPrice =
                    $validated['unit_price'][$index];

                $totalAmount =
                    $quantity * $unitPrice;

                QuotationItem::create([

                    'quotation_id' =>
                        $quotation->id,

                    'drug_name' =>
                        $drugName,

                    'quantity' =>
                        $quantity,

                    'unit_price' =>
                        $unitPrice,

                    'total_amount' =>
                        $totalAmount,

                ]);

                $grandTotal += $totalAmount;
            }

            // Update total
            $quotation->update([
                'total_amount' =>
                    $grandTotal,

            ]);

            $quotation->refresh();

            $prescription->update([

                'status' => 'quoted',

            ]);

            $prescription
                ->user
                ->notify(
                    new QuotationCreatedNotification(
                        $quotation
                    )
                );

            DB::commit();

            return redirect()
                ->route(
                    'pharmacy.prescriptions.index'
                )
                ->with(
                    'success',
                    'Quotation sent successfully.'
                );

        } 
        catch (Throwable $exception) 
        {

            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors([
                    'error' =>
                       'Failed to create quotation.',
                ]);
        }
    }
}