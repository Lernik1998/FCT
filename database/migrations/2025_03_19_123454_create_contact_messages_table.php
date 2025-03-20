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
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del remitente
            $table->string('email'); // Correo del remitente
            $table->text('message'); // Contenido del mensaje
            $table->string('trainer_id')->nullable(); // ID del trainer al que se le asigna el mensaje
            $table->enum('status', ['pending', 'assigned', 'completed'])->default('pending'); // Estado del mensaje lo controla el admin
            $table->timestamp('read_at')->nullable(); // Marcar si ha sido leído
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
