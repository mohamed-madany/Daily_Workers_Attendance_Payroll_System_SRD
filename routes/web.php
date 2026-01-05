<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DailyLedgerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Daily Workers ERP - Web Routes
|--------------------------------------------------------------------------
|
| These routes provide the UI for the Daily Workers ERP system.
| All data is currently using placeholder/mock data.
| Connect to controllers and pass real data when backend is ready.
|
*/

// Dashboard
Route::get('/', [DashboardController::class, '__invoke'])->name('dashboard');

// Workers CRUD
Route::prefix('workers')->name('workers.')->group(function () {
    Route::get('/', [WorkerController::class, 'index'])->name('index');

    Route::get('/create', [WorkerController::class, 'create'])->name('create');

    Route::get('/{worker}/edit', [WorkerController::class, 'edit'])->name('edit');

    // POST routes - placeholder for controller integration
    Route::post('/store', [WorkerController::class, 'store'])->name('store');

    Route::put('/update/{worker}', [WorkerController::class, 'update'])->name('update');

    Route::delete('/destroy/{worker}', [WorkerController::class, 'destroy'])->name('destroy');
});

// Attendance
Route::prefix('attendance')->name('attendance.')->group(function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('index');

    Route::get('/create', [AttendanceController::class, 'create'])->name('create');
    Route::get('/{attendance}/edit', [AttendanceController::class, 'edit'])->name('edit');

    Route::post('/', [AttendanceController::class, 'store'])->name('store');

    Route::put('/{attendance}', [AttendanceController::class, 'update'])->name('update');

    Route::delete('/{attendance}', [AttendanceController::class, 'destroy'])->name('destroy');
});

// Deductions
Route::prefix('deductions')->name('deductions.')->group(function () {
    Route::get('/', [DeductionController::class, 'index'])->name('index');

    Route::get('/create', [DeductionController::class, 'create'])->name('create');

    Route::post('/', [DeductionController::class, 'store'])->name('store');

    Route::get('/{deduction}/edit', [DeductionController::class, 'edit'])->name('edit');

    Route::put('/{deduction}', [DeductionController::class, 'update'])->name('update');

    Route::delete('/{deduction}', [DeductionController::class, 'destroy'])->name('destroy');
});

// Daily Ledger (read-only)
Route::prefix('ledger')->name('ledger.')->group(function () {
    Route::get('/', [DailyLedgerController::class, '__invoke'])->name('index');
});

// Payments
Route::prefix('payments')->name('payments.')->group(function () {
    Route::get('/', [PaymentController::class, 'index'])->name('index');

    Route::get('/create', [PaymentController::class, 'create'])->name('create');

    Route::post('/', [PaymentController::class, 'store'])->name('store');

    Route::get('/{payment}/edit', [PaymentController::class, 'edit'])->name('edit');

    Route::put('/{payment}', [PaymentController::class, 'update'])->name('update');

    Route::delete('/{payment}', [PaymentController::class, 'destroy'])->name('destroy');
});

// Reports
Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/monthly', function () {
        return view('pages.reports.monthly');
    })->name('monthly');

    Route::get('/worker', function () {
        return view('pages.reports.worker');
    })->name('worker');
});

// Authentication placeholder
Route::post('/logout', function () {
    // Auth::logout();
    return redirect('/');
})->name('logout');
