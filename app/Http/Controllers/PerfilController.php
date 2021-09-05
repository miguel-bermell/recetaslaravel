<?php

namespace App\Http\Controllers;

use App\User;
use App\Perfil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Receta;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        $recetas = Receta::where('user_id', $perfil->user_id)->orderBy('created_at', 'desc')->paginate(6);

        return view('perfiles.show', compact('perfil', 'recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        $this->authorize('view', $perfil);

        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        $this->authorize('update', $perfil);

        $data = $request->validate([
            'nombre' => 'required',
            'url' => 'required|url',
            'biografia' => 'required|string',
        ]);;

        if (request('imagen')) {

            $request->validate([
                'imagen' => 'image'
            ]);

            $imageRoute = $request['imagen']->store('upload-perfiles', 'public');
            $img = Image::make(public_path("storage/{$imageRoute}"))->fit(600, 600);
            $img->save();

            $array_image = ['imagen' => $imageRoute];
        }

        // Asignar nombre y url
        Auth::user()->url = $data['url'];
        Auth::user()->name = $data['nombre'];
        Auth::user()->save();

        // Asignar biografia e imagen
        $perfil->biografia = $data['biografia'];
        $perfil->imagen = $array_image['imagen'] ?? $perfil->imagen;
        $perfil->save();


        return redirect()->route('perfiles.show', $perfil);
    }


}
