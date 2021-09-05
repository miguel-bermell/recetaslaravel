@extends('layouts.app')


@section('content')

  {{-- {{$receta}} --}}



  <article class="contenido-receta bg-white p-5 shadow">
    <h1 class="text-center mb-4">{{$receta->titulo}}</h1>

    <div class="d-flex justify-content-center gap">

      @php
        $recetas = $receta::all();
        $recetasSize = $recetas->count();
        $current = $recetas->pluck('id')->search($receta->id);
        $last = $recetasSize - 1;
        $next = $current + 1 > $last ? $receta->id : $recetas->pluck('id')[$current + 1];  
        $previous = $current - 1 < 0 ? $receta->id : $recetas->pluck('id')[$current - 1];
      @endphp
      <a href="{{route('recetas.show', $previous)}}"><i class="fas fa-backward"></i></a>
      <a href="{{route('recetas.show', $next)}}"><i class="fas fa-forward"></i></a>
    </div>

    <div class="imagen-receta">

      @if(strpos($receta->imagen, 'http') !== false)
      <img class="w-100" src="{{$receta->imagen}}" alt="Receta imagen">
      @else
      <img class="w-100" src="{{asset('storage/'.$receta->imagen)}}" alt="Receta imagen">
      @endif
      

    </div>

    <div class="receta-meta">
      <div class="d-flex gap-1">
      <p>
        <span class="font-weigth-bold text-primary">Escrito en: </span>
        <a class="text-dark" href="{{ route('categorias.show', $receta->categoria->id) }}">
          {{$receta->categoria->nombre}}
        </a>
      </p>

      <p class="text-capitalize">
        <span class="ml-2"><strong>|</strong></span>
        <span class="font-weigth-bold text-primary ml-2">Fecha:</span>
        {{-- {{$receta->created_at->format('d/m/Y')}} --}}
        @php
          $fecha = $receta->created_at
        @endphp
        <fecha-receta fecha="{{$fecha}}"></fecha-receta>
      </p>

      <p>
        <span class="ml-2"><strong>|</strong></span>
        <span class="font-weigth-bold text-primary ml-2">Autor:</span>
        <a class="text-dark" href="{{ route('perfiles.show', $receta->autor->id) }}">
          {{$receta->autor->name}}
        </a>
      </p>

      </div>


      <div class="ingredientes">
        <h2 class="my-3 text-primary">Ingredientes</h2>
        {!! $receta->ingredientes !!}
      </div>

      <div class="preparacion">
        <h2 class="my-3 text-primary">Preparación</h2>
        {!! $receta->preparacion !!}
      </div>

      <like-button receta-id="{{$receta->id}}" likes="{{$like}}" likes-number="{{$likes}}"></like-button>
      

    </div>

@endsection