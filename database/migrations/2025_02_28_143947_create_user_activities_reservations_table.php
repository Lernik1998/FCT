<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_activities_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('activity_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['reserved', 'confirmed', 'cancelled'])->default('reserved');
            $table->decimal('price', 10, 2)->default(0.00);
            $table->string('payment_method')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_url')->nullable();
            $table->text('payment_description')->nullable();
            $table->timestamp('payment_date')->nullable(); // Mayor precisión que date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activities_reservations');
    }
};
