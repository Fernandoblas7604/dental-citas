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
    Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        $table->string('patient_name', 120);
        $table->string('patient_email')->nullable();
        $table->string('patient_phone', 20);
        $table->foreignId('service_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->date('appointment_date');
        $table->time('appointment_time');

        $table->string('status')->default('pendiente');
        $table->text('notes')->nullable();
        $table->timestamps();

        $table->index([
            'appointment_date',
            'appointment_time',
            'status'
        ]);
    });
}
};
