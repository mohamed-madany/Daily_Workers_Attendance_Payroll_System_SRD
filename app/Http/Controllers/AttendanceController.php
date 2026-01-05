<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Models\Worker;
use App\Services\Attendance\AttendanceService;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.attendance.index', [
            'workers' => Worker::all(),
            'attendances' => Attendance::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = now()->toDateString();
        $workers = Worker::where('status', 'active')
            ->whereDoesntHave('attendances', function ($query) use ($today) {
                $query->where('date', $today);
            })
            ->get();

        return view('pages.attendance.create', [
            'workers' => $workers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRequest $request)
    {
        app(AttendanceService::class)
            ->record($request->validated());

        return redirect()
            ->route('attendance.index')
            ->with('success', 'تم تسجيل الحضور بنجاح');
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
