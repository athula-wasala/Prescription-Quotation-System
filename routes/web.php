<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserManagementController;

use App\Http\Controllers\Pharmacy\QuotationController;
use App\Http\Controllers\Pharmacy\PharmacyPrescriptionController;

use App\Http\Controllers\Customer\PrescriptionController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (auth()->check()) {

        return redirect()->route('dashboard');
    }

    return view('welcome');

});

/*
|--------------------------------------------------------------------------
| Main Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $user = auth()->user();

    if ($user->hasRole('admin')) {

        return redirect('/admin/users');
    }

    if ($user->hasRole('pharmacy')) {

        return redirect('/pharmacy/prescriptions');
    }

    return redirect('/customer/prescriptions');

})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:manage users'
])->group(function () {

    Route::get(
        '/admin/users',
        [UserManagementController::class, 'index']
    )->name('admin.users.index');

});

/*
|--------------------------------------------------------------------------
| Pharmacy Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:manage prescriptions'
])->group(function () {

    Route::get(
        '/pharmacy/prescriptions',
        [PharmacyPrescriptionController::class, 'index']
    )->name('pharmacy.prescriptions.index');

    Route::get(
        '/pharmacy/prescriptions/{prescription}/quotation/create',
        [QuotationController::class, 'create']
    )->name('pharmacy.quotations.create');

    Route::post(
        '/pharmacy/prescriptions/{prescription}/quotation',
        [QuotationController::class, 'store']
    )->name('pharmacy.quotations.store');

});

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:customer',
])->group(function () {

    Route::get(
        '/customer/prescriptions',
        [PrescriptionController::class, 'index']
    )->name('customer.prescriptions.index');

    Route::get(
        '/customer/prescriptions/create',
        [PrescriptionController::class, 'create']
    )->name('customer.prescriptions.create');

    Route::post(
        '/customer/prescriptions',
        [PrescriptionController::class, 'store']
    )->name('customer.prescriptions.store');

    Route::post(
        '/customer/quotations/{quotation}/accept',
        [PrescriptionController::class, 'acceptQuotation']
    )->name('customer.quotations.accept');

    Route::post(
        '/customer/quotations/{quotation}/reject',
        [PrescriptionController::class, 'rejectQuotation']
    )->name('customer.quotations.reject');

});

/*
|--------------------------------------------------------------------------
| Legacy Dashboard Redirects
|--------------------------------------------------------------------------
*/

Route::redirect(
    '/admin/dashboard',
    '/admin/users'
);

Route::redirect(
    '/pharmacy/dashboard',
    '/pharmacy/prescriptions'
);

Route::redirect(
    '/customer/dashboard',
    '/customer/prescriptions'
);

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::view('/profile', 'profile.edit')
        ->name('profile.edit');

});

require __DIR__.'/auth.php';