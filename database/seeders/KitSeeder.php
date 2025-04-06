<?php

namespace Database\Seeders;

use App\Models\Component;
use App\Models\Kit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar kits predefinidos
        $kits = [
            [
                'name' => 'Kit Iniciante 60x60',
                'description' => 'Kit completo para iniciantes com espaço limitado. Ideal para um grow de 60x60cm com capacidade para 1-2 plantas.',
                'price' => 1299.90,
                'stock' => 5,
                'sku' => 'KIT-INI-60',
                'active' => true,
                'components' => [
                    'Painel LED Quantum Board 120W' => 1,
                    'Exaustor Axial 15cm 220V' => 1,
                    'Filtro de Carvão 10cm 180m³/h' => 1,
                    'Smart Pot 11L (3 galões)' => 2,
                    'Termo-Higrômetro Digital com Sonda' => 1,
                    'Timer Analógico 10A' => 1,
                ]
            ],
            [
                'name' => 'Kit Profissional 100x100',
                'description' => 'Kit completo para cultivo de média escala. Ideal para um grow de 100x100cm com capacidade para 4 plantas.',
                'price' => 2499.90,
                'stock' => 3,
                'sku' => 'KIT-PRO-100',
                'active' => true,
                'components' => [
                    'Painel LED Quantum Board 240W' => 1,
                    'Exaustor Axial 15cm 220V' => 1,
                    'Ventilador Clip 15cm Oscilante' => 1,
                    'Filtro de Carvão 15cm 330m³/h' => 1,
                    'Smart Pot 20L (5 galões)' => 4,
                    'Controlador de Temperatura Digital' => 1,
                    'Timer Digital Programável' => 1,
                ]
            ],
            [
                'name' => 'Kit Básico Automático',
                'description' => 'Kit básico com automação inteligente. Ideal para quem deseja praticidade e controle remoto do cultivo.',
                'price' => 1199.90,
                'stock' => 5,
                'sku' => 'KIT-BAS-AUTO',
                'active' => true,
                'components' => [
                    'Painel LED Quantum Board 120W' => 1,
                    'Exaustor Axial 15cm 220V' => 1,
                    'Smart Pot 11L (3 galões)' => 2,
                    'Termo-Higrômetro Digital com Sonda' => 1,
                    'Smart Plug Wi-Fi' => 2,
                ]
            ],
        ];

        // Salvar os kits e suas relações
        foreach ($kits as $kitData) {
            // Extrair a lista de componentes
            $componentsList = $kitData['components'];
            unset($kitData['components']);
            
            // Criar o kit
            $kit = Kit::create([
                'name' => $kitData['name'],
                'description' => $kitData['description'],
                'price' => $kitData['price'],
                'stock' => $kitData['stock'],
                'sku' => $kitData['sku'],
                'slug' => Str::slug($kitData['name']),
                'active' => $kitData['active'],
            ]);
            
            // Associar os componentes ao kit
            foreach ($componentsList as $componentName => $quantity) {
                $component = Component::where('name', $componentName)->first();
                
                if ($component) {
                    $kit->components()->attach($component->id, ['quantity' => $quantity]);
                }
            }
        }
    }
} 