<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Models\Worker;
use App\Services\AttendanceService;
use DomainException;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.attendance.index', [
            'workers' => Worker::all(),
            'attendances' => Attendance::latest()->simplePaginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = now()->toDateString();
        $workers = Worker::where('status', 'active')->get();

        return view('pages.attendance.create', [
            'workers' => $workers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRequest $request)
    {
        try {
            if ($request['status'] == 'absent') {
                app(AttendanceService::class)
                    ->recordAbsent($request->validated());

                return redirect()
                    ->route('attendance.index')
                    ->with('success', 'تم تسجيل الغياب بنجاح');
            }

            app(AttendanceService::class)
                ->record($request->validated());

            return redirect()
                ->route('attendance.index')
                ->with('success', 'تم تسجيل الحضور بنجاح');
        } catch (DomainException $e) {
            return redirect()
                ->route('attendance.create')
                ->with('error', $e->getMessage());
        }
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
        $attendance = Attendance::findOrFail($id);

        return view('pages.attendance.edit', [
            'attendance' => $attendance,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttendanceRequest $request, string $id)
    {
        app(AttendanceService::class)
            ->update($request->validated(), $id);

        return redirect()->route('attendance.index')->with('success', 'تم تحديث الحضور بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
