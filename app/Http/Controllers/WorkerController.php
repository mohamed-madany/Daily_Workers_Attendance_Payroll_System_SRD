<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workers = Worker::all();
        return view('pages.workers.index', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.workers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $worker = new Worker;
        $worker->name = $request->name;
        $worker->role = $request->role;
        $worker->daily_fee = $request->daily_fee;
        $worker->status = $request->status;
        $worker->phone = $request->phone;
        $worker->save();

        return redirect()->route('workers.index')->with('success', 'تم إضافة العامل بنجاح');
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
        $worker = Worker::findOrFail($id);
        return view('pages.workers.edit', compact('worker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Worker::findOrFail($id)->update($request->all());
        return redirect()->route('workers.index')->with('success', 'تم تحديث بيانات العامل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Worker::findOrFail($id)->delete();
        return redirect()->route('workers.index')->with('success', 'تم حذف العامل بنجاح');
    }
}
