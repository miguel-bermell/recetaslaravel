<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index() 
    {
        // Mostrar las recetas por cantidad de likes
        // $likes = Receta::has('likes', '>', 1)->get();
        $likes = Receta::withCount('likes')->orderBy('likes_count', 'DESC')->take(3)->get();

        // Obtener las recetas mas nuevas
        $nuevas = Receta::latest()->take(10)->get();

        // Obtener todas las categorías
        $categorias = CategoriaReceta::all();
        
        // Agrupar las recetas por categoría
        $recetas = [];

        // Por Id
        // foreach($categorias as $categoria) {
        //     $recetas[ $categoria->id ][] = Receta::where('categoria_id', $categoria->id)->get();
        // }
        

        // Por nombre de receta
        foreach($categorias as $categoria) {
            $recetas[ Str::slug( $categoria->nombre )][] = Receta::where('categoria_id', $categoria->id)->take(3)->get();
        }

        return view('inicio.index', compact('nuevas', 'recetas', 'likes'));
    }
}
