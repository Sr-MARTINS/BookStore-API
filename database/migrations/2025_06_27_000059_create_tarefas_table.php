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
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();
            $table->string('title', 80);
            $table->foreignId('lista_id')->constrained('listas')->nullable();
            $table->foreignId('tarefa_status_id')->constrained('tarefa_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tarefas', function (Blueprint $table) {
            $table->dropForeign(['lista_id']);
            $table->dropForeign(['tarefa_status_id']);
        });

        Schema::dropIfExists('tarefas');
    }
};
