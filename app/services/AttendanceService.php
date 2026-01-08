<?php

namespace App\Services;

use App\Models\Attendance;
use Carbon\Carbon;
use DomainException;

class AttendanceService
{
    public function record(array $data): void
    {
        // Reject future dates
        $date = Carbon::parse($data['date'])->startOfDay();
        if ($date->gt(Carbon::today())) {
            throw new DomainException('لا يمكن أن يكون تاريخ الحضور في المستقبل.');
        }

        if (Attendance::where('worker_id', $data['worker_id'])
            ->where('date', $data['date'])
            ->exists()
        ) {

            throw new DomainException('تم تسجيل الحضور بالفعل لهذا العامل اليوم.');
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

    public function recordAbsent(array $data): void
    {
        // Reject future dates
        $date = Carbon::parse($data['date'])->startOfDay();
        if ($date->gt(Carbon::today())) {
            throw new DomainException('Attendance date cannot be in the future.');
        }

        if (Attendance::where('worker_id', $data['worker_id'])
            ->where('date', $data['date'])
            ->exists()
        ) {
            throw new DomainException('Attendance already recorded for this worker today.');
        }

        $workedHours = 0.0;
        Attendance::create([
            'worker_id' => $data['worker_id'],
            'date' => $data['date'],
            'check_in_time' => null,
            'check_out_time' => null,
            'status' => $data['status'],
            'worked_hours' => $workedHours,
        ]);
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

    private function calculateWorkedHours(?string $checkIn, ?string $checkOut): float
    {
        // If either time is null (e.g., absent status), return 0 hours
        if (empty($checkIn) || empty($checkOut)) {
            return 0.0;
        }

        $start = Carbon::createFromFormat('H:i', $checkIn);
        $end = Carbon::createFromFormat('H:i', $checkOut);

        return $start->floatDiffInHours($end);
    }
}
