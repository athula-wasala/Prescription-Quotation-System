<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\View\View;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PharmacyPrescriptionController extends Controller
{
    /**
     * Display all prescriptions.
     */
    public function index(Request $request)
    {
        $query = Prescription::with(['user', 'images', 'quotation']);

        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $prescriptions = $query->latest()->paginate(10);

        return view('pharmacy.prescriptions.index', compact('prescriptions'));
    }
}