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
        // A coluna user_email já existe na tabela orders
        // Não precisamos adicioná-la novamente
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Não é necessária nenhuma ação para reverter
    }
};
