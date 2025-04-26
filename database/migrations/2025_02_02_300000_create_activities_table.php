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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->decimal('price', 10, 2);
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['pending', 'active', 'inactive'])->default('pending'); // El admin lo activa
            $table->date('date'); // Podría moverse a otra tabla si hay más fechas por actividad
            $table->integer('slots')->nullable();
            // Relación actividad - usuario(Instructor)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Relación actividad - categoría
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities'); // Primero elimina la tabla activities
    }
};
