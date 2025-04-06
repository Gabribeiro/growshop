<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class TestProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Encontrando ou criando uma categoria
        $category = Category::firstOrCreate(['name' => 'Vasos'], [
            'name' => 'Vasos',
            'description' => 'Vasos para cultivo',
        ]);

        // Criando um produto de teste
        Product::create([
            'name' => 'Vaso de Cultivo 10L',
            'description' => 'Vaso de plástico resistente para cultivo indoor, capacidade 10 litros',
            'price' => 99.99,
            'quantity' => 100,
            'sold_amount' => 0,
            'SKU' => 'VASO-10L-' . uniqid(),
            'box_material' => 'Plástico resistente',
            'box_content' => 'Vaso de cultivo',
            'box_dimension_inner' => '30x30x30 cm',
            'box_dimension_outer' => '32x32x32 cm',
            'hasMessage' => 0,
            'category_id' => $category->id,
            'is_featured' => true,
            'image' => null,
            'type' => 'Preserved'
        ]);

        // Criando outro produto de teste
        Product::create([
            'name' => 'Kit Nutrientes Básicos',
            'description' => 'Kit com nutrientes essenciais para o cultivo de plantas',
            'price' => 149.99,
            'quantity' => 50,
            'sold_amount' => 0,
            'SKU' => 'NUTRI-KIT-' . uniqid(),
            'box_material' => 'Plástico',
            'box_content' => 'Frascos com nutrientes',
            'box_dimension_inner' => '20x15x10 cm',
            'box_dimension_outer' => '22x17x12 cm',
            'hasMessage' => 0,
            'category_id' => $category->id,
            'is_featured' => true,
            'image' => null,
            'type' => 'Fresh'
        ]);
    }
}
