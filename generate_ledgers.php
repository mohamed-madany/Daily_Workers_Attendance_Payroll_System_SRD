<?php

use App\Models\Attendance;
use App\Models\DailyLedger;
use App\Services\Attendance\DailyLedgerService;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$service = app(DailyLedgerService::class);

$count = 0;
foreach (Attendance::all() as $attendance) {
    $service->generateForWorker($attendance->worker_id, $attendance->date);
    $count++;
}

echo "Processed {$count} attendance records.\n";
echo "Total ledger entries: " . DailyLedger::count() . "\n";
