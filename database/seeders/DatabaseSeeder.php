<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'firstName' => 'Test',
            'lastName' => 'User',
            'email' => 'test@example.com',
        ]);
        
        // Executar seeders para componentes e categorias
        $this->call([
            ComponentCategorySeeder::class,
            ComponentSeeder::class,
            KitSeeder::class,
        ]);
    }
}
