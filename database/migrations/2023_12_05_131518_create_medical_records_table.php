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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('doctor_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('pharmacist_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('drug_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('diagnosis');
            $table->string('action');
            $table->date('tgl_berobat');
            $table->enum('status', ['Diberi Obat', 'Menunggu Obat']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
