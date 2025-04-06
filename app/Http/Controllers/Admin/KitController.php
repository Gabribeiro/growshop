<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\Kit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kits = Kit::all();
        return view('admin.kits.index', compact('kits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $components = Component::where('active', true)->with('category')->get();
        return view('admin.kits.create', compact('components'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:kits,sku',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'boolean',
            'components' => 'required|array',
            'components.*.id' => 'required|exists:components,id',
            'components.*.quantity' => 'required|integer|min:1',
        ]);
        
        $kit = new Kit();
        $kit->name = $validated['name'];
        $kit->description = $validated['description'] ?? null;
        $kit->price = $validated['price'];
        $kit->stock = $validated['stock'] ?? 0;
        $kit->sku = $validated['sku'] ?? null;
        $kit->slug = Str::slug($validated['name']);
        $kit->active = $request->has('active');
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('kits', 'public');
            $kit->image = $imagePath;
        }
        
        // Salva o kit para obter o ID
        $kit->save();
        
        // Salva os componentes do kit na tabela pivot
        $componentsData = [];
        foreach ($validated['components'] as $component) {
            $componentsData[$component['id']] = [
                'quantity' => $component['quantity'],
            ];
        }
        
        $kit->components()->attach($componentsData);
        
        return redirect()->route('kits.index')
            ->with('success', 'Kit criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kit $kit)
    {
        $kit->load('components');
        return view('admin.kits.show', compact('kit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kit $kit)
    {
        $components = Component::where('active', true)->with('category')->get();
        $kit->load('components');
        return view('admin.kits.edit', compact('kit', 'components'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kit $kit)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:kits,sku,' . $kit->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'boolean',
            'components' => 'required|array',
            'components.*.id' => 'required|exists:components,id',
            'components.*.quantity' => 'required|integer|min:1',
        ]);
        
        $kit->name = $validated['name'];
        $kit->description = $validated['description'] ?? null;
        $kit->price = $validated['price'];
        $kit->stock = $validated['stock'] ?? 0;
        $kit->sku = $validated['sku'] ?? null;
        $kit->slug = Str::slug($validated['name']);
        $kit->active = $request->has('active');
        
        if ($request->hasFile('image')) {
            // Remover imagem antiga se existir
            if ($kit->image) {
                Storage::disk('public')->delete($kit->image);
            }
            
            $imagePath = $request->file('image')->store('kits', 'public');
            $kit->image = $imagePath;
        }
        
        $kit->save();
        
        // Atualiza os componentes do kit (remove todos e adiciona novamente)
        $componentsData = [];
        foreach ($validated['components'] as $component) {
            $componentsData[$component['id']] = [
                'quantity' => $component['quantity'],
            ];
        }
        
        $kit->components()->sync($componentsData);
        
        return redirect()->route('kits.index')
            ->with('success', 'Kit atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kit $kit)
    {
        DB::beginTransaction();
        
        try {
            // Remover relações com componentes
            $kit->components()->detach();
            
            // Remover imagem se existir
            if ($kit->image) {
                Storage::disk('public')->delete($kit->image);
            }
            
            $kit->delete();
            
            DB::commit();
            
            return redirect()->route('kits.index')
                ->with('success', 'Kit excluído com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->route('kits.index')
                ->with('error', 'Erro ao excluir kit: ' . $e->getMessage());
        }
    }
}
