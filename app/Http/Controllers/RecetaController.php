<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class RecetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'search']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Auth::user()->recetas->dd();
        // $recetas = Auth::user()->recetas;
        // $recetas = $recetas->sortByDesc('created_at');
        $user = Auth::user();
        $recetas = Receta::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);

        return view('recetas.index')->with('recetas', $recetas)->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // DB::table('categoria_receta')->get()->pluck('nombre', 'id')->dd();

        // Obtener las categorías sin modelo
        // $categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id');

        // Con modelo
        $categorias = CategoriaReceta::all(['id', 'nombre']);

        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request['imagen']->store('upload-recetas', 'public'));

        $data = $request->validate([
            'titulo' => 'required|min:5',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'categoria' => 'required',
            'imagen' => 'image'
        ]);

        // Image route
        $imageRoute = $request['imagen']->store('upload-recetas', 'public');

        // Resice de la imagen

        $img = Image::make(public_path("storage/{$imageRoute}"))->fit(1000, 550);
        $img->save();

        // DB::table('recetas')->insert([
        // 'titulo' => $data['titulo'],
        // 'preparacion' => $data['preparacion'],
        // 'ingredientes' => $data['ingredientes'],
        // 'categoria_id' => $data['categoria'],
        // 'imagen' => $imageRoute,
        // 'user_id' => Auth::user()->id
        // ]);

        // Almacenar con modelo

        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $imageRoute,
            'categoria_id' => $data['categoria'],
        ]);


        return redirect()->action('RecetaController@index');


        // dd($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        // Obtener si el usuario actual le ha dado me gusta a la receta y esta autenticado
        $like = (auth()->user()) ? auth()->user()->meGusta->contains($receta->id) : false;

        // Cantidad de likes
        $likes = $receta->likes->count();

        return view('recetas.show', compact('receta', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $this->authorize('view', $receta);

        $categorias = CategoriaReceta::all(['id', 'nombre']);

        return view('recetas.edit', compact('categorias', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        // Policy
        $this->authorize('update', $receta);


        $data = $request->validate([
            'titulo' => 'required|min:5',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'categoria' => 'required',
        ]);

        $receta->titulo = $data['titulo'];
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->categoria_id = $data['categoria'];

        if (request('imagen')) {

            $request->validate([
                'imagen' => 'image'
            ]);

            $imageRoute = $request['imagen']->store('upload-recetas', 'public');
            $img = Image::make(public_path("storage/{$imageRoute}"))->fit(1000, 550);
            $img->save();

            $receta->imagen = $imageRoute;
        }

        $receta->save();

        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        $this->authorize('delete', $receta);
        $receta->delete();
        return redirect()->action('RecetaController@index');
    }

    public function search(Request $request) 
    {
        $busqueda = $request['buscar'];

        $recetas = Receta::where('titulo', 'LIKE', '%'.$busqueda.'%')->paginate(2);
        $recetas->appends(['buscar' => $busqueda]);

        return view('busquedas.show', compact('recetas', 'busqueda'));
    }
}
