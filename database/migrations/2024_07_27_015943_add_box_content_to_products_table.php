<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Esta migração será ignorada completamente
        // A coluna box_content já existe na migração original (create_products_table)
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Esta migração pode ser ignorada durante o rollback
        // já que a coluna já existe na migração original
    }
};
