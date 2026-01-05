<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Http\Request;
    
class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('pages.dashboard', [
            'workers' => Worker::all(),
        ]);
    }
}
