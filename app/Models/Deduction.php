<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;
    protected $tabel = 'deductions';
    protected $fillable = [
        'date',
        'deduction_amount',
        'reason',
        'worker_id',
    ];
    public static function totalDeductionsThisWeek()
    {
        return Deduction::where('date', '>=', now()->subDays(6)->toDateString())->sum('deduction_amount');
    }
    public static function totalDeductionsThisMonth()
    {
        return Deduction::where('date', '>=', now()->subMonths(1)->toDateString())->sum('deduction_amount');
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}
