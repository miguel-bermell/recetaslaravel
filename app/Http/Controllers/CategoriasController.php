<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function show(CategoriaReceta $categoriaReceta)
    {
        $recetas = Receta::where('categoria_id', $categoriaReceta->id)->paginate(2);
        return view('categorias.show', compact('recetas', 'categoriaReceta'));
    }
}
