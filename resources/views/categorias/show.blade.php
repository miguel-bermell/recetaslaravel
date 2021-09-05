@extends('layouts.app')

@section('content')

    <div class="container">
        <h2 class="titulo-categoria text-uppercase  mb-3">{{ $categoriaReceta->nombre }}</h2>

        <div class="row">

          @if(count($recetas) > 0)
          @foreach ($recetas as $receta)
            @include('ui.receta')
          @endforeach
          @else
          <h3>Todavía no hay recetas creadas</h3>
          @endif
        </div>

        

        <div class="d-flex justify-content-center mt-5">
          {{ $recetas->links() }}
        </div>

    </div>

@endsection


