<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    // Guardar la categoría en la base de datos
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'name' => 'required|string|max:25',
        ]);

        // Crear la nueva categoría
        Category::create([
            'name' => $request->name,
        ]);

        // Redirigir a la lista de categorías con un mensaje de éxito
        return redirect()->route('categories.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit($category_id) {
        // Cambiar `category.id` por `category.category_id`
        $category = Category::findOrFail($category_id);
    
        return view('categories.edit', compact('category'));
    }
    
    public function update(Request $request, $category_id) {
        // Cambiar `category.id` por `category.category_id`
        $category = Category::findOrFail($category_id);
        $category->update([
            'name' => $request->name,
        ]);
    
        return redirect()->route('categories.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy($categoryId)
    {
        // Buscar la categoría por su ID
        $category = Category::findOrFail($categoryId);

        // Eliminar la categoría
        $category->delete();

        // Redirigir a la lista de categorías con un mensaje de éxito
        return redirect()->route('categories.index')->with('success', 'Categoría eliminada con éxito.');
    }
}
