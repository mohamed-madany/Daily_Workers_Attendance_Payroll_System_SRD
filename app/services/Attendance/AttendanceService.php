<?php

namespace App\Services\Attendance;

use App\Models\Attendance;
use Carbon\Carbon;
use DomainException;

class AttendanceService
{
    public function record(array $data): void
    {
        if (Attendance::where('worker_id', $data['worker_id'])
            ->where('date', $data['date'])
            ->exists()) {
            throw new DomainException('Attendance already recorded for this worker today.');
        }

        $workedHours = $this->calculateWorkedHours(
            $data['check_in_time'],
            $data['check_out_time']
        );

        Attendance::create([
            'worker_id' => $data['worker_id'],
            'date' => $data['date'],
            'check_in_time' => $data['check_in_time'],
            'check_out_time' => $data['check_out_time'],
            'status' => $data['status'],
            'worked_hours' => $workedHours,
        ]);

        app(DailyLedgerService::class)
            ->generateForWorker($data['worker_id'], $data['date']);
    }

    public function update(array $data, string $id): void
    {
        $attendance = Attendance::findOrFail($id);

        $workedHours = $this->calculateWorkedHours(
            $data['check_in_time'],
            $data['check_out_time']
        );

        $attendance->update([
            'worker_id' => $data['worker_id'],
            'date' => $data['date'],
            'check_in_time' => $data['check_in_time'],
            'check_out_time' => $data['check_out_time'],
            'status' => $data['status'],
            'worked_hours' => $workedHours,
        ]);

        app(DailyLedgerService::class)
            ->generateForWorker($data['worker_id'], $data['date']);
    }

    private function calculateWorkedHours(string $checkIn, string $checkOut): float
    {
        $start = Carbon::createFromFormat('H:i', $checkIn);
        $end = Carbon::createFromFormat('H:i', $checkOut);

        return $start->floatDiffInHours($end);
    }
}
