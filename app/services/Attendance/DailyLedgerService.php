<?php

namespace App\Services\Attendance;

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

        $dailyFee = Worker::findOrFail($workerId)->daily_fee;

        $deductions = Deduction::where('worker_id', $workerId)
            ->where('date', $date)
            ->sum('deduction_amount');

        DailyLedger::updateOrCreate(
            [
                'worker_id' => $workerId,
                'date' => $date,
            ],
            [
                'gross_earned_amount' => $dailyFee,
                'deductions_amount' => $deductions,
                'net_earned_amount' => $dailyFee - $deductions,
            ]
        );
    }
}
