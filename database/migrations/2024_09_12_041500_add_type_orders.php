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
        // Removendo todas as colunas que já foram adicionadas anteriormente
        // (não há novas colunas para adicionar)
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Não há nada para remover
    }
};
