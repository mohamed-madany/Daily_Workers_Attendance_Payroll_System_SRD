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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('status');
            $table->time('check_in_time');
            $table->time('check_out_time');
            $table->decimal('worked_hours', 4, 2)->default(0);
            $table->timestamps();
            $table->foreignId('worker_id')->constrained('workers')->cascadeOnDelete();
            $table->unique(['worker_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
