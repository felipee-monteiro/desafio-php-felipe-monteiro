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
       Schema::create('categoria_chamados', function (Blueprint $table) {
           $table->id();
           $table->string('name')->unique();
           $table->timestamps();
       });

        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('titulo');
            $table->text('descricao');
            $table->foreignId('categoria_chamado_id')->constrained()->onDelete('cascade');
            $table->enum('prioridade', ['Baixa', 'Média', 'Alta']);
            $table->enum('status', ['Aberto', 'Em atendimento', 'Resolvido', 'Fechado'])->default('Aberto');
            $table->string('anexo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamados');
        Schema::dropIfExists('categoria_chamados');
    }
};
