<?php

namespace App\Http\Controllers;

use App\Models\DailyLedger;
use Illuminate\Http\Request;

class DailyLedgerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $ledgers = DailyLedger::with('worker')
            ->orderBy('date', 'desc')
            ->get();

        return view('pages.ledger.index', compact('ledgers'));
    }
}
