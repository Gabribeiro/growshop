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
        // A coluna 'type' não existe na tabela products
        // Não precisamos renomear para 'flower_type'
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Não é necessária nenhuma ação para reverter
    }
};
