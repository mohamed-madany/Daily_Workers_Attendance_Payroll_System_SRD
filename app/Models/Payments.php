<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'payment_date',
        'payment_amount',
        'method',
        'notes',
        'worker_id',
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}
