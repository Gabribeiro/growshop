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
        // As colunas start_at e expired_at já foram adicionadas
        // na migração 2024_09_13_055057_create_discounts_table.php
        // Não precisamos adicioná-las novamente
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Não é necessária nenhuma ação para reverter
    }
};
