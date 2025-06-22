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
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel meal_plans
            $table->foreignId('meal_plan_id')->constrained()->onDelete('cascade');
            // Tipe makanan, hanya bisa diisi dengan nilai yang ada di dalam array.
            $table->enum('type', ['sarapan', 'makan_siang', 'makan_malam', 'camilan']);
            $table->string('food_name'); // Contoh: "Dada Ayam Bakar dan Nasi Merah"
            $table->integer('calories')->nullable(); // Jumlah kalori
            $table->text('description')->nullable(); // Bisa untuk info makro (protein, karbo, lemak)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
