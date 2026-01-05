<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';
    protected $fillable = [
        'worker_id',
        'date',
        'status',
        'check_in_time',
        'check_out_time',
        'worked_hours'
    ];
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}
