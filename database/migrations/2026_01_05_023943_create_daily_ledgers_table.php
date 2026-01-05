<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daily_ledgers', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('gross_earned_amount', 10, 2);
            $table->decimal('deductions_amount', 10, 2);
            $table->decimal('net_earned_amount', 10, 2);
            $table->foreignId('worker_id')->constrained('workers')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['worker_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_ledgers');
    }
};
