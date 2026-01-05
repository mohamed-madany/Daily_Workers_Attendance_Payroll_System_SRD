<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\DailyLedger;
use App\Models\Deduction;
use App\Models\Payment;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create workers
        $workers = [
            ['name' => 'أحمد محمد حسن', 'role' => 'عامل بناء', 'daily_fee' => 350.00, 'phone' => '01012345678'],
            ['name' => 'محمد علي إبراهيم', 'role' => 'نجار', 'daily_fee' => 400.00, 'phone' => '01023456789'],
            ['name' => 'خالد يوسف أحمد', 'role' => 'سباك', 'daily_fee' => 380.00, 'phone' => '01034567890'],
            ['name' => 'عمر فاروق محمود', 'role' => 'كهربائي', 'daily_fee' => 420.00, 'phone' => '01045678901'],
            ['name' => 'محمود سمير عبدالله', 'role' => 'عامل بناء', 'daily_fee' => 350.00, 'phone' => '01056789012'],
            ['name' => 'حسن أحمد علي', 'role' => 'دهان', 'daily_fee' => 300.00, 'phone' => '01067890123'],
            ['name' => 'إبراهيم خالد محمد', 'role' => 'حداد', 'daily_fee' => 450.00, 'phone' => '01078901234'],
            ['name' => 'يوسف عمر حسين', 'role' => 'عامل نظافة', 'daily_fee' => 250.00, 'phone' => '01089012345'],
        ];

        $createdWorkers = [];
        foreach ($workers as $workerData) {
            $createdWorkers[] = Worker::create([
                'name' => $workerData['name'],
                'role' => $workerData['role'],
                'daily_fee' => $workerData['daily_fee'],
                'status' => 'active',
                'phone' => $workerData['phone'],
            ]);
        }

        // Create attendance for the past 7 days
        $statuses = ['present', 'present', 'present', 'present', 'late', 'half_day', 'absent'];
        
        for ($daysAgo = 0; $daysAgo <= 6; $daysAgo++) {
            $date = Carbon::today()->subDays($daysAgo)->format('Y-m-d');
            
            foreach ($createdWorkers as $index => $worker) {
                // Skip some workers randomly (simulate absent)
                if ($daysAgo > 0 && rand(0, 10) < 2) {
                    continue;
                }
                
                $status = $statuses[array_rand($statuses)];
                
                // Set check-in/out times based on status
                if ($status === 'absent') {
                    $checkIn = null;
                    $checkOut = null;
                    $workedHours = 0;
                } elseif ($status === 'half_day') {
                    $checkIn = '08:00';
                    $checkOut = '12:00';
                    $workedHours = 4;
                } elseif ($status === 'late') {
                    $checkIn = '09:30';
                    $checkOut = '17:00';
                    $workedHours = 7.5;
                } else {
                    $checkIn = '08:00';
                    $checkOut = '17:00';
                    $workedHours = 9;
                }
                
                Attendance::create([
                    'worker_id' => $worker->id,
                    'date' => $date,
                    'check_in_time' => $checkIn,
                    'check_out_time' => $checkOut,
                    'status' => $status,
                    'worked_hours' => $workedHours,
                ]);
            }
        }

        // Create deductions
        $deductionReasons = [
            'تأخير عن العمل',
            'غياب بدون إذن',
            'إتلاف معدات',
            'سلفة',
            'خصم تأميني',
        ];

        foreach ($createdWorkers as $worker) {
            // Add 0-2 deductions per worker
            $numDeductions = rand(0, 2);
            for ($i = 0; $i < $numDeductions; $i++) {
                $daysAgo = rand(0, 6);
                Deduction::create([
                    'worker_id' => $worker->id,
                    'date' => Carbon::today()->subDays($daysAgo)->format('Y-m-d'),
                    'deduction_amount' => rand(1, 5) * 10, // 10, 20, 30, 40, or 50
                    'reason' => $deductionReasons[array_rand($deductionReasons)],
                ]);
            }
        }

        // Generate daily ledgers for all attendance records
        $attendances = Attendance::all();
        foreach ($attendances as $attendance) {
            $dailyFee = $attendance->worker->daily_fee;
            
            // Calculate fee based on status
            if ($attendance->status === 'absent') {
                $grossAmount = 0;
            } elseif ($attendance->status === 'half_day') {
                $grossAmount = $dailyFee / 2;
            } else {
                $grossAmount = $dailyFee;
            }
            
            $deductions = Deduction::where('worker_id', $attendance->worker_id)
                ->where('date', $attendance->date)
                ->sum('deduction_amount');
            
            DailyLedger::updateOrCreate(
                [
                    'worker_id' => $attendance->worker_id,
                    'date' => $attendance->date,
                ],
                [
                    'gross_earned_amount' => $grossAmount,
                    'deductions_amount' => $deductions,
                    'net_earned_amount' => max(0, $grossAmount - $deductions),
                ]
            );
        }

        // Create payments
        $paymentMethods = ['cash', 'bank_transfer', 'mobile_wallet'];
        $paymentNotes = [
            'دفعة أسبوعية',
            'تسوية جزئية',
            'دفعة نهاية الأسبوع',
            'تحويل بنكي',
            'فودافون كاش',
            '',
        ];

        foreach ($createdWorkers as $index => $worker) {
            // Add 1-3 payments per worker
            $numPayments = rand(1, 3);
            for ($i = 0; $i < $numPayments; $i++) {
                $daysAgo = rand(0, 6);
                Payment::create([
                    'worker_id' => $worker->id,
                    'payment_date' => Carbon::today()->subDays($daysAgo)->format('Y-m-d'),
                    'payment_amount' => rand(1, 10) * 100, // 100 to 1000
                    'method' => $paymentMethods[array_rand($paymentMethods)],
                    'notes' => $paymentNotes[array_rand($paymentNotes)],
                ]);
            }
        }

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('   - ' . Worker::count() . ' workers');
        $this->command->info('   - ' . Attendance::count() . ' attendance records');
        $this->command->info('   - ' . Deduction::count() . ' deductions');
        $this->command->info('   - ' . DailyLedger::count() . ' ledger entries');
        $this->command->info('   - ' . Payment::count() . ' payments');
    }
}
