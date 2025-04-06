<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\ComponentCategory;
use App\Models\Kit;
use Illuminate\Http\Request;

class GrowBuildController extends Controller
{
    /**
     * Exibe a página para montar o Grow
     */
    public function index()
    {
        // Buscar todas as categorias de componentes ativas
        $categories = ComponentCategory::where('active', true)
            ->with(['components' => function($query) {
                $query->where('active', true);
            }])
            ->get();
        
        // Obter componentes selecionados da sessão (se existirem)
        $selectedComponents = session()->get('grow_builder', []);
        
        return view('grow.builder.index', [
            'categories' => $categories,
            'selectedComponents' => $selectedComponents
        ]);
    }

    /**
     * Seleciona um componente para a montagem
     */
    public function selectComponent(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:component_categories,id',
            'component_id' => 'required|exists:components,id'
        ]);
        
        // Obter o componente selecionado
        $component = Component::findOrFail($request->component_id);
        
        // Verificar se o componente pertence à categoria informada
        if ($component->category_id != $request->category_id) {
            return redirect()->back()->with('error', 'Componente não pertence à categoria informada.');
        }
        
        // Obter a montagem atual da sessão
        $growBuilder = session()->get('grow_builder', []);
        
        // Adicionar/substituir o componente na categoria
        $growBuilder[$request->category_id] = [
            'id' => $component->id,
            'name' => $component->name,
            'image' => $component->image,
            'price' => $component->price,
            'quantity' => 1
        ];
        
        // Salvar na sessão
        session()->put('grow_builder', $growBuilder);
        
        return redirect()->back()->with('success', 'Componente selecionado com sucesso!');
    }

    /**
     * Remove um componente da montagem
     */
    public function removeComponent(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:component_categories,id'
        ]);
        
        // Obter a montagem atual da sessão
        $growBuilder = session()->get('grow_builder', []);
        
        // Remover o componente da categoria
        if (isset($growBuilder[$request->category_id])) {
            unset($growBuilder[$request->category_id]);
        }
        
        // Salvar na sessão
        session()->put('grow_builder', $growBuilder);
        
        return redirect()->back()->with('success', 'Componente removido com sucesso!');
    }

    /**
     * Adiciona o grow montado ao carrinho como um kit personalizado
     */
    public function addToCart(Request $request)
    {
        // Obter a montagem atual da sessão
        $growBuilder = session()->get('grow_builder', []);
        
        // Verificar se há pelo menos um componente selecionado
        if (empty($growBuilder)) {
            return redirect()->back()->with('error', 'Selecione pelo menos um componente para o seu Grow.');
        }
        
        // Calcular o preço total do kit
        $totalPrice = 0;
        $componentIds = [];
        $quantities = [];
        
        foreach ($growBuilder as $categoryId => $component) {
            $totalPrice += $component['price'] * $component['quantity'];
            $componentIds[] = $component['id'];
            $quantities[$component['id']] = $component['quantity'];
        }
        
        // Criar um kit personalizado temporário
        $customKit = new Kit();
        $customKit->name = 'Grow Personalizado';
        $customKit->description = 'Grow montado pelo cliente no montador';
        $customKit->price = $totalPrice;
        $customKit->active = true;
        $customKit->stock = 1; // Definir um estoque mínimo
        $customKit->sku = 'GROW-CUSTOM-' . time(); // SKU temporário baseado no timestamp
        $customKit->slug = 'grow-personalizado-' . time(); // Slug temporário baseado no timestamp
        
        // Não é necessário salvar este kit no banco de dados, pois é temporário para o carrinho

        // Obter o carrinho da sessão
        $cart = session()->get('cart', []);
        
        // Adicionar o kit ao carrinho
        $cartItemId = 'custom-kit-' . time(); // ID único para o item de carrinho
        $cart[$cartItemId] = [
            'id' => $cartItemId,
            'name' => $customKit->name,
            'price' => $customKit->price,
            'quantity' => 1,
            'image' => isset($growBuilder[array_key_first($growBuilder)]['image']) ? $growBuilder[array_key_first($growBuilder)]['image'] : null,
            'is_custom_kit' => true,
            'components' => $growBuilder
        ];
        
        // Atualizar o carrinho na sessão
        session()->put('cart', $cart);
        
        // Limpar o montador na sessão
        session()->forget('grow_builder');
        
        return redirect()->route('grow.cart')->with('success', 'Grow personalizado adicionado ao carrinho!');
    }

    /**
     * Limpa a seleção de componentes
     */
    public function clearBuilder()
    {
        session()->forget('grow_builder');
        return redirect()->back()->with('success', 'Montagem limpa com sucesso!');
    }
} 