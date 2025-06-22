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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel workout_plans.
            // onDelete('cascade') berarti jika sebuah workout_plan dihapus,
            // semua exercise yang terhubung dengannya juga akan ikut terhapus.
            $table->foreignId('workout_plan_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Contoh: "Bench Press", "Squat"
            $table->integer('sets'); // Contoh: 3, 4
            $table->string('reps'); // Contoh: "10-12", "15", "Sampai Gagal"
            $table->text('instructions')->nullable(); // Instruksi cara melakukan gerakan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
