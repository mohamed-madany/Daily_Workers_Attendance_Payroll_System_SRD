<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory , HasUuids;

    protected $table = 'workers';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'role',
        'daily_fee',
        'status',
        'phone',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function daily_ledger()
    {
        return $this->hasMany(DailyLedger::class);
    }

    public function deductions()
    {
        return $this->hasMany(Deduction::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
