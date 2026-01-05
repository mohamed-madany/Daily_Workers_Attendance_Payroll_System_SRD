<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deductions extends Model
{
    use HasFactory;
    protected $tabel = 'deductions';
    protected $fillable = [
        'date',
        'deduction_amount',
        'reason',
        'worker_id',
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}
