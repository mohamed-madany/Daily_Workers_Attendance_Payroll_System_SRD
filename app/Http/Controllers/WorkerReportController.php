<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Services\WorkerReportService;
use Illuminate\Http\Request;

class WorkerReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.reports.filter-worker', [
            'workers' => Worker::all()
        ]);
    }

    // Filter user report
    public function filterUser(Request $request)
    {
        $request->validate([
            'worker_id' => 'required|exists:workers,id',
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date',
        ]);

        $worker = Worker::findOrFail($request->worker_id);

        $start = $request->from_date ?? now()->startOfMonth()->toDateString();
        $end = $request->to_date ?? now()->toDateString();

        $summary = app(WorkerReportService::class)
            ->generateReportForWorker(
                $worker->id,
                $start,
                $end
            );

        return view('pages.reports.filter-worker', [
            'workers' => Worker::all(),
            'selectedWorker' => $worker,
            'summary' => $summary,
        ]);
    }

    /**
     * Display the specified resource via GET /worker/{worker}
     */
    public function show(string $id)
    {
        $worker = Worker::findOrFail($id);

        $start = request()->query('from_date', now()->startOfMonth()->toDateString());
        $end = request()->query('to_date', now()->toDateString());

        $summary = app(WorkerReportService::class)
            ->generateReportForWorker($worker->id, $start, $end);

        return view('pages.reports.filter-worker', [
            'workers' => Worker::all(),
            'selectedWorker' => $worker,
            'summary' => $summary,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
