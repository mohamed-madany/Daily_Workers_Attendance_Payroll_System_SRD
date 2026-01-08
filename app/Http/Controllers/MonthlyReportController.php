<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MonthlyReportController extends Controller
{
    public function __invoke()
    {
        // Placeholder data for monthly report

        
        return view('pages.reports.monthly');
    }
}
