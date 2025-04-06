<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\ComponentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $components = Component::with('category')->get();
        return view('admin.components.index', compact('components'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ComponentCategory::where('active', true)->get();
        return view('admin.components.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:component_categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:components,sku',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'boolean',
        ]);
        
        $component = new Component();
        $component->name = $validated['name'];
        $component->category_id = $validated['category_id'];
        $component->description = $validated['description'] ?? null;
        $component->price = $validated['price'];
        $component->stock = $validated['stock'] ?? 0;
        $component->sku = $validated['sku'] ?? null;
        $component->slug = Str::slug($validated['name']);
        $component->active = $request->has('active');
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('components', 'public');
            $component->image = $imagePath;
        }
        
        $component->save();
        
        return redirect()->route('components.index')
            ->with('success', 'Componente criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Component $component)
    {
        $component->load('category');
        return view('admin.components.show', compact('component'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Component $component)
    {
        $categories = ComponentCategory::where('active', true)->get();
        return view('admin.components.edit', compact('component', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Component $component)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:component_categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:components,sku,' . $component->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'boolean',
        ]);
        
        $component->name = $validated['name'];
        $component->category_id = $validated['category_id'];
        $component->description = $validated['description'] ?? null;
        $component->price = $validated['price'];
        $component->stock = $validated['stock'] ?? 0;
        $component->sku = $validated['sku'] ?? null;
        $component->slug = Str::slug($validated['name']);
        $component->active = $request->has('active');
        
        if ($request->hasFile('image')) {
            // Remover imagem antiga se existir
            if ($component->image) {
                Storage::disk('public')->delete($component->image);
            }
            
            $imagePath = $request->file('image')->store('components', 'public');
            $component->image = $imagePath;
        }
        
        $component->save();
        
        return redirect()->route('components.index')
            ->with('success', 'Componente atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Component $component)
    {
        // Verificar se está em algum kit
        if ($component->kits()->count() > 0) {
            return redirect()->route('components.index')
                ->with('error', 'Não é possível excluir componente usado em kits.');
        }
        
        // Remover imagem se existir
        if ($component->image) {
            Storage::disk('public')->delete($component->image);
        }
        
        $component->delete();
        
        return redirect()->route('components.index')
            ->with('success', 'Componente excluído com sucesso.');
    }
}
