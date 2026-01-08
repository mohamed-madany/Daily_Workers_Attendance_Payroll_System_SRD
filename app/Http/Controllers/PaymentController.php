<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Worker;
use App\Models\DailyLedger;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments.
     */
    public function index()
    {
        $payments = Payment::with('worker')
            ->orderBy('payment_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();

        // Calculate stats
        $stats = [
            'today' => Payment::whereDate('payment_date', $today)->sum('payment_amount'),
            'week' => Payment::whereDate('payment_date', '>=', $startOfWeek)->sum('payment_amount'),
            'month' => Payment::whereDate('payment_date', '>=', $startOfMonth)->sum('payment_amount'),
            'outstanding' => $this->calculateOutstandingBalance(),
        ];

        return view('pages.payments.index', compact('payments', 'stats'));
    }

    /**
     * Show the form for creating a new payment.
     */
    public function create()
    {
        $workers = Worker::where('status', 'active')
            ->get()
            ->map(function ($worker) {
                $worker->balance = $this->getWorkerBalance($worker->id);
                return $worker;
            });

        return view('pages.payments.create', compact('workers'));
    }

    /**
     * Store a newly created payment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'worker_id' => 'required|exists:workers,id',
            'payment_amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'method' => 'required|in:cash,bank_transfer,mobile_wallet',
            'notes' => 'nullable|string|max:500',
        ]);

        Payment::create([
            'worker_id' => $validated['worker_id'],
            'payment_amount' => $validated['payment_amount'],
            'payment_date' => $validated['payment_date'],
            'method' => $validated['method'],
            'notes' => $validated['notes'] ?? '',
        ]);

        return redirect()
            ->route('payments.index')
            ->with('success', 'تم تسجيل الدفعة بنجاح');
    }

    /**
     * Show the form for editing a payment.
     */
    public function edit(Payment $payment)
    {
        $workers = Worker::where('status', 'active')->get();

        return view('pages.payments.edit', compact('payment', 'workers'));
    }

    /**
     * Update the specified payment.
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'worker_id' => 'required|exists:workers,id',
            'payment_amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'method' => 'required|in:cash,bank_transfer,mobile_wallet',
            'notes' => 'nullable|string|max:500',
        ]);

        $payment->update([
            'worker_id' => $validated['worker_id'],
            'payment_amount' => $validated['payment_amount'],
            'payment_date' => $validated['payment_date'],
            'method' => $validated['method'],
            'notes' => $validated['notes'] ?? '',
        ]);

        return redirect()
            ->route('payments.index')
            ->with('success', 'تم تحديث الدفعة بنجاح');
    }

    /**
     * Remove the specified payment.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()
            ->route('payments.index')
            ->with('success', 'تم حذف الدفعة بنجاح');
    }

    /**
     * Calculate a worker's outstanding balance.
     */
    private function getWorkerBalance(string $workerId): float
    {
        $totalEarned = DailyLedger::where('worker_id', $workerId)
            ->sum('net_earned_amount');

        $totalPaid = Payment::where('worker_id', $workerId)
            ->sum('payment_amount');

        return $totalEarned - $totalPaid;
    }

    /**
     * Calculate total outstanding balance for all workers.
     */
    private function calculateOutstandingBalance(): float
    {
        $totalEarned = DailyLedger::sum('net_earned_amount');
        $totalPaid = Payment::sum('payment_amount');

        return max(0, $totalEarned - $totalPaid);
    }
}
