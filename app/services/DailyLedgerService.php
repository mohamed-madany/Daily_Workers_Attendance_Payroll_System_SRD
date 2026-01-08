<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\DailyLedger;
use App\Models\Deduction;
use App\Models\Worker;

class DailyLedgerService
{
    public function generateForWorker(string $workerId, string $date): void
    {
        $attendance = Attendance::where('worker_id', $workerId)
            ->where('date', $date)
            ->first();

        if (! $attendance) {
            return;
        }

        $worker = Worker::findOrFail($workerId);
        $dailyFee = $worker->daily_fee;

        // Calculate gross amount based on attendance status
        $grossAmount = $this->calculateGrossAmount($attendance->status, $dailyFee);

        $deductions = Deduction::where('worker_id', $workerId)
            ->where('date', $date)
            ->sum('deduction_amount');

        DailyLedger::updateOrCreate(
            [
                'worker_id' => $workerId,
                'date' => $date,
            ],
            [
                'gross_earned_amount' => $grossAmount,
                'deductions_amount' => $deductions,
                'net_earned_amount' => max(0, $grossAmount - $deductions),
            ]
        );
    }

    /**
     * Calculate gross earned amount based on attendance status
     */
    private function calculateGrossAmount(string $status, float $dailyFee): float
    {
        return match ($status) {
            'present', 'late' => $dailyFee,           // Full fee for present or late
            'half_day' => $dailyFee / 2,              // Half fee for half day
            'absent' => 0.0,                          // No fee for absent
            default => $dailyFee,                     // Default to full fee
        };
    }
}
