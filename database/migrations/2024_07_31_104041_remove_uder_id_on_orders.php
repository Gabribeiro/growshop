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
        // A coluna user_id parece não existir na tabela orders
        // Então não precisamos remover
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Não é necessária nenhuma ação para reverter
    }
};
