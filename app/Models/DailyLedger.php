<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyLedger extends Model
{
    use HasFactory;

    protected $table = 'daily_ledgers';

    protected $fillable = [
        'date',
        'gross_earned_amount',
        'deductions_amount',
        'net_earned_amount',
        'worker_id',
    ];  

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}
