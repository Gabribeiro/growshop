<?php

namespace Database\Seeders;

use App\Models\Component;
use App\Models\ComponentCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar as categorias da base de dados
        $categories = ComponentCategory::all();
        
        // Definir componentes para cada categoria
        $components = [
            'Iluminação' => [
                [
                    'name' => 'Painel LED Quantum Board 120W',
                    'description' => 'Painel de LED Samsung LM301H de alta eficiência, espectro completo, ideal para crescimento e floração. Cobertura de aproximadamente 60x60cm.',
                    'price' => 689.90,
                    'stock' => 10,
                    'sku' => 'LED-QB120',
                    'active' => true,
                ],
                [
                    'name' => 'Painel LED Quantum Board 240W',
                    'description' => 'Painel de LED Samsung LM301H de alta eficiência, espectro completo, ideal para crescimento e floração. Cobertura de aproximadamente 100x100cm.',
                    'price' => 1289.90,
                    'stock' => 10,
                    'sku' => 'LED-QB240',
                    'active' => true,
                ],
                [
                    'name' => 'Lâmpada LED Grow 50W',
                    'description' => 'Lâmpada LED com espectro específico para cultivo, soquete E27, baixo consumo e pouco calor.',
                    'price' => 129.90,
                    'stock' => 20,
                    'sku' => 'LED-E27-50',
                    'active' => true,
                ],
            ],
            'Ventilação' => [
                [
                    'name' => 'Exaustor Axial 15cm 220V',
                    'description' => 'Exaustor de 15cm para renovação do ar dentro do grow, 220V, silencioso, com fluxo de 180m³/h.',
                    'price' => 149.90,
                    'stock' => 15,
                    'sku' => 'EXA-15-220',
                    'active' => true,
                ],
                [
                    'name' => 'Ventilador Clip 15cm Oscilante',
                    'description' => 'Ventilador pequeno com clip para fixação, ideal para circulação interna de ar, 3 velocidades.',
                    'price' => 89.90,
                    'stock' => 12,
                    'sku' => 'VENT-CLIP15',
                    'active' => true,
                ],
                [
                    'name' => 'Kit Insuflador e Exaustor 10cm',
                    'description' => 'Kit completo para renovação de ar com exaustor e insuflador de 10cm, ideal para grows pequenos.',
                    'price' => 249.90,
                    'stock' => 8,
                    'sku' => 'KIT-INEX-10',
                    'active' => true,
                ],
            ],
            'Filtragem de Ar' => [
                [
                    'name' => 'Filtro de Carvão 15cm 330m³/h',
                    'description' => 'Filtro de carvão ativado para eliminação de odores, diâmetro de 15cm, suporta até 330m³/h.',
                    'price' => 349.90,
                    'stock' => 5,
                    'sku' => 'FILT-15-330',
                    'active' => true,
                ],
                [
                    'name' => 'Filtro de Carvão 10cm 180m³/h',
                    'description' => 'Filtro de carvão ativado para eliminação de odores, diâmetro de 10cm, suporta até 180m³/h.',
                    'price' => 249.90,
                    'stock' => 10,
                    'sku' => 'FILT-10-180',
                    'active' => true,
                ],
                [
                    'name' => 'Ionizador de Ar Portátil',
                    'description' => 'Ionizador e purificador de ar compacto, remove odores e partículas sem necessidade de instalação.',
                    'price' => 199.90,
                    'stock' => 7,
                    'sku' => 'ION-PORT',
                    'active' => true,
                ],
            ],
            'Vasos e Recipientes' => [
                [
                    'name' => 'Smart Pot 11L (3 galões)',
                    'description' => 'Vaso de tecido respirável que proporciona aeração das raízes e evita o enovelamento, 11 litros.',
                    'price' => 49.90,
                    'stock' => 30,
                    'sku' => 'SMART-11L',
                    'active' => true,
                ],
                [
                    'name' => 'Smart Pot 20L (5 galões)',
                    'description' => 'Vaso de tecido respirável que proporciona aeração das raízes e evita o enovelamento, 20 litros.',
                    'price' => 79.90,
                    'stock' => 25,
                    'sku' => 'SMART-20L',
                    'active' => true,
                ],
                [
                    'name' => 'Kit 6 Vasos Plásticos 1L',
                    'description' => 'Kit com 6 vasos plásticos de 1 litro, ideais para mudas e início de vegetação.',
                    'price' => 39.90,
                    'stock' => 20,
                    'sku' => 'KIT-VP-1L',
                    'active' => true,
                ],
            ],
            'Controle de Clima' => [
                [
                    'name' => 'Termo-Higrômetro Digital com Sonda',
                    'description' => 'Medidor de temperatura e umidade digital com memória de máxima e mínima, sonda externa para medição dentro do grow.',
                    'price' => 79.90,
                    'stock' => 15,
                    'sku' => 'TH-DIG-SONDA',
                    'active' => true,
                ],
                [
                    'name' => 'Controlador de Umidade Digital',
                    'description' => 'Controlador que liga/desliga automaticamente umidificadores ou desumidificadores baseado na umidade programada.',
                    'price' => 189.90,
                    'stock' => 8,
                    'sku' => 'CONT-UMID',
                    'active' => true,
                ],
                [
                    'name' => 'Controlador de Temperatura Digital',
                    'description' => 'Controlador que liga/desliga automaticamente ventiladores ou aquecedores baseado na temperatura programada.',
                    'price' => 189.90,
                    'stock' => 8,
                    'sku' => 'CONT-TEMP',
                    'active' => true,
                ],
            ],
            'Timer e Automação' => [
                [
                    'name' => 'Timer Analógico 10A',
                    'description' => 'Temporizador analógico com intervalos de 15 minutos, 10A de capacidade, ideal para controle do fotoperíodo.',
                    'price' => 59.90,
                    'stock' => 20,
                    'sku' => 'TIM-ANALOG-10A',
                    'active' => true,
                ],
                [
                    'name' => 'Timer Digital Programável',
                    'description' => 'Temporizador digital com 8 programações diferentes, display LCD e bateria de backup.',
                    'price' => 89.90,
                    'stock' => 15,
                    'sku' => 'TIM-DIG-PROG',
                    'active' => true,
                ],
                [
                    'name' => 'Smart Plug Wi-Fi',
                    'description' => 'Tomada inteligente controlada por aplicativo via Wi-Fi, permite programação e controle remoto dos equipamentos.',
                    'price' => 129.90,
                    'stock' => 10,
                    'sku' => 'SMART-PLUG',
                    'active' => true,
                ],
            ],
        ];
        
        // Adicionar componentes ao banco de dados
        foreach ($components as $categoryName => $categoryComponents) {
            // Encontrar a categoria pelo nome
            $category = $categories->where('name', $categoryName)->first();
            
            if ($category) {
                foreach ($categoryComponents as $component) {
                    Component::create([
                        'category_id' => $category->id,
                        'name' => $component['name'],
                        'description' => $component['description'],
                        'price' => $component['price'],
                        'stock' => $component['stock'],
                        'sku' => $component['sku'],
                        'slug' => Str::slug($component['name']),
                        'active' => $component['active'],
                    ]);
                }
            }
        }
    }
} 