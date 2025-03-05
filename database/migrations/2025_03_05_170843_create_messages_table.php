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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            // Asegura integridad referencial y elimina mensajes si el usuario se elimina.
            $table->unsignedBigInteger('sender_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('recipient_id')->constrained('users')->onDelete('cascade');

            // Para evitrar hacer consultar adicionales para conocer el tipo de usuario
            $table->enum('sender_role', ['admin', 'user', 'trainer']);
            $table->enum('recipient_role', ['admin', 'user', 'trainer']);

            $table->text('message');

            // Facilita el seguimiento de cuándo el destinatario leyó el mensaje.
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            // $table->foreign('sender_id')->references('id')->on('users');
            // $table->foreign('recipient_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};