<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComponentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ComponentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ComponentCategory::all();
        return view('admin.component-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.component-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'boolean',
        ]);
        
        $category = new ComponentCategory();
        $category->name = $validated['name'];
        $category->description = $validated['description'] ?? null;
        $category->slug = Str::slug($validated['name']);
        $category->active = $request->has('active');
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('component-categories', 'public');
            $category->image = $imagePath;
        }
        
        $category->save();
        
        return redirect()->route('component-categories.index')
            ->with('success', 'Categoria criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ComponentCategory $componentCategory)
    {
        return view('admin.component-categories.show', compact('componentCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComponentCategory $componentCategory)
    {
        return view('admin.component-categories.edit', compact('componentCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ComponentCategory $componentCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'boolean',
        ]);
        
        $componentCategory->name = $validated['name'];
        $componentCategory->description = $validated['description'] ?? null;
        $componentCategory->slug = Str::slug($validated['name']);
        $componentCategory->active = $request->has('active');
        
        if ($request->hasFile('image')) {
            // Remover imagem antiga se existir
            if ($componentCategory->image) {
                Storage::disk('public')->delete($componentCategory->image);
            }
            
            $imagePath = $request->file('image')->store('component-categories', 'public');
            $componentCategory->image = $imagePath;
        }
        
        $componentCategory->save();
        
        return redirect()->route('component-categories.index')
            ->with('success', 'Categoria atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComponentCategory $componentCategory)
    {
        // Verificar se existem componentes associados
        if ($componentCategory->components()->count() > 0) {
            return redirect()->route('component-categories.index')
                ->with('error', 'Não é possível excluir categoria com componentes associados.');
        }
        
        // Remover imagem se existir
        if ($componentCategory->image) {
            Storage::disk('public')->delete($componentCategory->image);
        }
        
        $componentCategory->delete();
        
        return redirect()->route('component-categories.index')
            ->with('success', 'Categoria excluída com sucesso.');
    }
}
