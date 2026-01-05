<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use App\Models\Worker;
use App\Services\Attendance\DailyLedgerService;
use Illuminate\Http\Request;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deductions = Deduction::all();

        return view('pages.deductions.index', [
            'deductions' => $deductions,
            'totalDeductionsThisWeek' => Deduction::totalDeductionsThisWeek(),
            'totalDeductionsThisMonth' => Deduction::totalDeductionsThisMonth(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.deductions.create', [
            'workers' => Worker::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Deduction::create([
            'date' => $request->date,
            'deduction_amount' => $request->amount,
            'reason' => $request->reason,
            'worker_id' => $request->worker_id,
        ]);
        app(DailyLedgerService::class)
            ->generateForWorker($request->worker_id, $request->date);

        return redirect()->route('deductions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.deductions.edit', [
            'workers' => Worker::all(),
            'deduction' => Deduction::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $deduction = Deduction::findOrFail($id);
        $deduction->update([
            'date' => $request->date,
            'deduction_amount' => $request->amount,
            'reason' => $request->reason,
            'worker_id' => $request->worker_id,
        ]);
        app(DailyLedgerService::class)
            ->generateForWorker($request->worker_id, $request->date);

        return redirect()->route('deductions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Deduction::destroy($id);

        return redirect()->route('deductions.index');
    }
}
