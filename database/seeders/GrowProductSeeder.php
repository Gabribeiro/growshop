<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GrowProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar ou criar a categoria "Grows Completos"
        $category = Category::firstOrCreate(
            ['name' => 'Grows Completos'],
            [
                'description' => 'Grows completos e prontos para uso, com todos os equipamentos necessários para o cultivo.',
                'is_active' => true,
                'sort_order' => 1
            ]
        );

        // Array com os dados dos produtos
        $products = [
            [
                'name' => 'Grow Iniciante',
                'description' => 'Essa é a iniciante um modelo desenvolvido para levar de 1 plantas em vaso de 9 litros. A expectativa de colheita é de 40g podendo chegar a 60g com experiência.
Todos o os grows além do móvel feito em:
- mdf resistente a agua
- isolamento de cheiro e luz.
- tranca com duas chaves
- pés em silicone para não arranhar o piso,
- acabamento para os fios.
- EXTENSÃO de energia de 5 tomadas com proteção contra descarga de energia,
- iluminação quantum board 65w samsung compatível com o espaço.
- exaustão de entrada e saída ativos, respeitando o CFM do espaço.
- filtro de carvão para evitar q o cheiro saia do grow,
- temporizador para controle da Luz controlado por app,
- termohigrometro para medir te. Peratura é humidade.
- consultoria de cultivo do inicio ao fim..

Além disso você pode escolher a cor que quiser dentro do nosso, catálogo.',
                'price' => 1500.00,
                'type' => 'Preserved',
                'is_featured' => true,
                'sold_amount' => 12,
                'quantity' => 5,
                'category_id' => $category->id,
                'box_material' => 'MDF',
                'box_content' => 'Grow completo',
                'box_dimension_inner' => '60x60x120 cm',
                'box_dimension_outer' => '65x65x125 cm',
            ],
            [
                'name' => 'Grow Basic',
                'description' => 'Essa é a basic um modelo desenvolvido para levar de 1 plantas em vaso de 9 litros. A expectativa de colheita é de 60g podendo chegar a 90g com experiência.
Todos o os grows além do móvel feito em:
- mdf resistente a agua
- isolamento de cheiro e luz.
- tranca com duas chaves
- pés em silicone para não arranhar o piso,
- acabamento para os fios.
- EXTENSÃO de energia de 5 tomadas com proteção contra descarga de energia,
- iluminação quantum board samsung compatível com o espaço.
- exaustão de entrada e saída ativos, respeitando o CFM do espaço.
- filtro de carvão para evitar q o cheiro saia do grow,
- temporizador para controle da Luz controlado por app,
- termohigrometro para medir te. Peratura é humidade.
- consultoria de cultivo do inicio ao fim..

Além disso você pode escolher a cor que quiser dentro do nosso, catálogo.',
                'price' => 2700.00,
                'type' => 'Preserved',
                'is_featured' => true,
                'sold_amount' => 25,
                'quantity' => 3,
                'category_id' => $category->id,
                'box_material' => 'MDF',
                'box_content' => 'Grow completo',
                'box_dimension_inner' => '80x80x160 cm',
                'box_dimension_outer' => '85x85x165 cm',
            ],
            [
                'name' => 'Grow Sustein',
                'description' => 'Essa é a sustein um modelo desenvolvido para levar de 4 plantas em vaso de 9 litros. A expectativa de colheita é de 120g podendo chegar a 150g com experiência.
Todos o os grows além do móvel feito em:
- mdf resistente a agua
- isolamento de cheiro e luz.
- tranca com duas chaves
- pés em silicone para não arranhar o piso,
- acabamento para os fios.
- EXTENSÃO de energia de 5 tomadas com proteção contra descarga de energia,
- iluminação quantum board samsung compatível com o espaço.
- exaustão de entrada e saída ativos, respeitando o CFM do espaço.
- filtro de carvão para evitar q o cheiro saia do grow,
- temporizador para controle da Luz controlado por app,
- termohigrometro para medir te. Peratura é humidade.
- consultoria de cultivo do inicio ao fim..

Além disso você pode escolher a cor que quiser dentro do nosso, catálogo.',
                'price' => 3500.00,
                'type' => 'Preserved',
                'is_featured' => true,
                'sold_amount' => 18,
                'quantity' => 2,
                'category_id' => $category->id,
                'box_material' => 'MDF',
                'box_content' => 'Grow completo',
                'box_dimension_inner' => '100x100x200 cm',
                'box_dimension_outer' => '105x105x205 cm',
            ],
        ];

        // Inserir os produtos no banco de dados
        foreach ($products as $productData) {
            Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'type' => $productData['type'],
                'is_featured' => $productData['is_featured'],
                'sold_amount' => $productData['sold_amount'],
                'quantity' => $productData['quantity'],
                'category_id' => $productData['category_id'],
                'box_material' => $productData['box_material'],
                'box_content' => $productData['box_content'],
                'box_dimension_inner' => $productData['box_dimension_inner'],
                'box_dimension_outer' => $productData['box_dimension_outer'],
                'SKU' => 'GROW-' . strtoupper(substr(str_replace(' ', '-', $productData['name']), 0, 10)) . '-' . uniqid(),
                'hasMessage' => 0,
            ]);
        }
    }
} 