<?php

use App\Http\Controllers\DashboardController;
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
    
    Route::delete('/destroy/{worker}', [WorkerController::class,'destroy'])->name('destroy');
});

// Attendance
Route::prefix('attendance')->name('attendance.')->group(function () {
    Route::get('/', function () {
        return view('pages.attendance.index');
    })->name('index');
    
    Route::get('/create', function () {
        return view('pages.attendance.create');
    })->name('create');
    
    Route::post('/', function () {
        return redirect()->route('attendance.index')->with('success', 'Attendance recorded successfully!');
    })->name('store');
    
    Route::put('/{attendance}', function ($attendance) {
        return redirect()->route('attendance.index')->with('success', 'Attendance updated successfully!');
    })->name('update');
    
    Route::delete('/{attendance}', function ($attendance) {
        return redirect()->route('attendance.index')->with('success', 'Attendance deleted successfully!');
    })->name('destroy');
});

// Deductions
Route::prefix('deductions')->name('deductions.')->group(function () {
    Route::get('/', function () {
        return view('pages.deductions.index');
    })->name('index');
    
    Route::get('/create', function () {
        return view('pages.deductions.create');
    })->name('create');
    
    Route::post('/', function () {
        return redirect()->route('deductions.index')->with('success', 'Deduction added successfully!');
    })->name('store');
    
    Route::put('/{deduction}', function ($deduction) {
        return redirect()->route('deductions.index')->with('success', 'Deduction updated successfully!');
    })->name('update');
    
    Route::delete('/{deduction}', function ($deduction) {
        return redirect()->route('deductions.index')->with('success', 'Deduction deleted successfully!');
    })->name('destroy');
});

// Daily Ledger (read-only)
Route::prefix('ledger')->name('ledger.')->group(function () {
    Route::get('/', function () {
        return view('pages.ledger.index');
    })->name('index');
});

// Payments
Route::prefix('payments')->name('payments.')->group(function () {
    Route::get('/', function () {
        return view('pages.payments.index');
    })->name('index');
    
    Route::get('/create', function () {
        return view('pages.payments.create');
    })->name('create');
    
    Route::post('/', function () {
        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully!');
    })->name('store');
    
    Route::delete('/{payment}', function ($payment) {
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully!');
    })->name('destroy');
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
