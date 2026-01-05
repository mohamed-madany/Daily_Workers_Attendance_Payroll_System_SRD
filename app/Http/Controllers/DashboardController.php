<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\DailyLedger;
use App\Models\Deduction;
use App\Models\Payment;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $today = Carbon::today();
        
        // Get all workers and today's attendances
        $workers = Worker::all();
        $attendances = Attendance::with('worker')->get();
        
        // Today's deductions
        $todayDeductions = Deduction::whereDate('date', $today)->sum('deduction_amount');
        $deductionCount = Deduction::whereDate('date', $today)->count();
        
        // Outstanding balance calculation
        $totalEarned = DailyLedger::sum('net_earned_amount');
        $totalPaid = Payment::sum('payment_amount');
        $outstandingBalance = max(0, $totalEarned - $totalPaid);
        
        // Count workers with pending balance
        $workersPending = Worker::whereHas('daily_ledger')
            ->get()
            ->filter(function ($worker) {
                $earned = DailyLedger::where('worker_id', $worker->id)->sum('net_earned_amount');
                $paid = Payment::where('worker_id', $worker->id)->sum('payment_amount');
                return ($earned - $paid) > 0;
            })
            ->count();
        
        // Recent payments
        $recentPayments = Payment::with('worker')
            ->orderBy('payment_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($payment) {
                $daysAgo = Carbon::parse($payment->payment_date)->diffInDays(Carbon::today());
                
                if ($daysAgo === 0) {
                    $dateLabel = 'اليوم';
                } elseif ($daysAgo === 1) {
                    $dateLabel = 'أمس';
                } else {
                    $dateLabel = "منذ {$daysAgo} أيام";
                }
                
                $methodLabels = [
                    'cash' => 'نقدي',
                    'bank_transfer' => 'تحويل بنكي',
                    'mobile_wallet' => 'محفظة إلكترونية',
                ];
                
                return [
                    'name' => $payment->worker->name ?? 'غير معروف',
                    'amount' => $payment->payment_amount,
                    'date' => $dateLabel,
                    'method' => $methodLabels[$payment->method] ?? $payment->method,
                ];
            });
        
        return view('pages.dashboard', [
            'workers' => $workers,
            'attendances' => $attendances,
            'todayDeductions' => $todayDeductions,
            'deductionCount' => $deductionCount,
            'outstandingBalance' => $outstandingBalance,
            'workersPending' => $workersPending,
            'recentPayments' => $recentPayments,
        ]);
    }
}
