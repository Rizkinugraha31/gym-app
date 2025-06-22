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
        Schema::create('memberships', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->date('start_date')->nullable();
    $table->date('end_date')->nullable();
    $table->string('duration_type'); // 'daily', 'monthly'
    $table->decimal('price', 10, 2);
    $table->string('payment_method'); // 'cash', 'transfer'
    $table->enum('payment_status', ['pending', 'paid'])->default('pending');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
