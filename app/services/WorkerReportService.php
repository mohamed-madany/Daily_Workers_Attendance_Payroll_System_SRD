<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\DailyLedger;
use App\Models\Deduction;
use App\Models\Payment;

class WorkerReportService
{
    public function generateReportForWorker(string $workerId, string $startDate, string $endDate): array
    {
        // Fetch attendances within the date range
        $attendances = Attendance::where('worker_id', $workerId)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        // Detailed breakdown by status
        $fullDaysCount = $attendances->where('status', 'present')->count();
        $halfDaysCount = $attendances->where('status', 'half_day')->count();
        $lateDaysCount = $attendances->where('status', 'late')->count();
        $absentDaysCount = $attendances->where('status', 'absent')->count();

        $totalDaysWorked = $attendances->whereIn('status', ['present', 'half_day', 'late'])->count();
        $totalWorkedHours = $attendances->sum('worked_hours');

        // Calculate total payments and deductions from DailyLedger
        $DailyLedger = DailyLedger::where('worker_id', $workerId)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        $deductions_amount = $DailyLedger->sum('deductions_amount');
        $net_earned_amount = $DailyLedger->sum('net_earned_amount');

        $total_net_earned_amount = DailyLedger::where('worker_id', $workerId)
            ->sum('net_earned_amount');

        // Sum the payment_amount from the payments collection
        $total_payment_amount = Payment::where('worker_id', $workerId)
            ->sum('payment_amount');

        $payment_amount_between = Payment::where('worker_id', $workerId)
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->sum('payment_amount');

        $current_balance = $total_net_earned_amount - $total_payment_amount;

        return [
            'total_days_worked' => $totalDaysWorked,
            'total_worked_hours' => $totalWorkedHours,

            // Detailed day breakdown
            'full_days' => $fullDaysCount,
            'half_days' => $halfDaysCount,
            'late_days' => $lateDaysCount,
            'absent_days' => $absentDaysCount,

            'total_deductions' => $deductions_amount,
            'net_earned_amount' => $net_earned_amount,
            'payments_between' => $payment_amount_between,

            'current_balance' => $current_balance,
            'total_net_earned_amount' => $total_net_earned_amount,
            'total_payment_amount' => $total_payment_amount,

            // Detailed data for tables
            'attendance_records' => $attendances->sortByDesc('date')->values()->all(),
            'deduction_records' => Deduction::where('worker_id', $workerId)
                ->whereBetween('date', [$startDate, $endDate])
                ->orderByDesc('date')
                ->get()
                ->all(),
            'payment_records' => Payment::where('worker_id', $workerId)
                ->whereBetween('payment_date', [$startDate, $endDate])
                ->orderByDesc('payment_date')
                ->get()
                ->all(),
        ];
    }
}
