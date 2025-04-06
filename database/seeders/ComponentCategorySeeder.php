<?php

namespace Database\Seeders;

use App\Models\ComponentCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ComponentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Iluminação',
                'description' => 'Lâmpadas e painéis LED para o cultivo indoor. A iluminação é um dos componentes mais importantes para o sucesso do seu cultivo.',
                'active' => true,
            ],
            [
                'name' => 'Ventilação',
                'description' => 'Exaustores, ventiladores e sistemas de circulação de ar para manter o ambiente ideal para suas plantas.',
                'active' => true,
            ],
            [
                'name' => 'Filtragem de Ar',
                'description' => 'Filtros de carvão ativado e purificadores para eliminar odores e manter a discrição do seu cultivo.',
                'active' => true,
            ],
            [
                'name' => 'Vasos e Recipientes',
                'description' => 'Vasos, smart pots e recipientes para cultivo em solo, coco ou hidroponia.',
                'active' => true,
            ],
            [
                'name' => 'Controle de Clima',
                'description' => 'Termostatos, higrômetros e controladores automáticos para monitorar e manter o clima ideal.',
                'active' => true,
            ],
            [
                'name' => 'Timer e Automação',
                'description' => 'Temporizadores e sistemas de automação para controlar o fotoperíodo e outras variáveis do cultivo.',
                'active' => true,
            ],
        ];

        foreach ($categories as $category) {
            ComponentCategory::create([
                'name' => $category['name'],
                'description' => $category['description'],
                'slug' => Str::slug($category['name']),
                'active' => $category['active'],
            ]);
        }
    }
} 