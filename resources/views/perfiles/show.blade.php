@extends('layouts.app')

@section('botones')

  <a href="{{route('recetas.index')}}" class="btn btn-primary mr-2 text-white">Volver</a>

@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-5">
              @if($perfil->imagen)
                @if(strpos($perfil->imagen, 'http') !== false)
                  <img class="w-100" src="{{$perfil->imagen}}" alt="Perfil imagen">
                  @else
                  <img class="w-100 rounded-circle" src="{{asset('storage/'.$perfil->imagen)}}" alt="Perfil imagen">
                @endif
              @endif
            </div>
            <div class="col-md-7 mt-5 mt-md-0">
              <h2 class="text-center mb-2 text-primary">{{$perfil->usuario->name}}</h2>
              <a href="{{$perfil->usuario->url}}">Sitio web</a>
              <div class="biografia">
                {!! $perfil->biografia !!}
              </div>
            </div>
        </div>
    </div>

    <h2 class="text-center my-5">Recetas creadas por: {{$perfil->usuario->name}}</h2>
    <div class="container">
        <div class="row mx-auto p-3">
          @if(count($recetas) > 0)
            @foreach($recetas as $receta)
              <div class="col-md-4 mb-3">
                <div class="card">
                  @if(strpos($receta->imagen, 'http') !== false)
                  <img class="w-100 card-img-top" src="{{$receta->imagen}}" alt="Receta imagen">
                  @else
                  <img class="w-100 card-img-top" src="{{asset('storage/'.$receta->imagen)}}" alt="Receta imagen">
                @endif
                  <div class="card-body">
                    <h4 class="card-title">{{$receta->titulo}}</h4>
                    <a href="{{route('recetas.show', $receta->id)}}" class="btn btn-dark w-100">Ver receta</a>
                  </div>
                </div>
              </div>
            @endforeach
            @else
          <p class="text-center w-100">No hay recetas aún...</p>
          @endif
        </div> 
      <div class="d-flex justify-content-center">
        {{$recetas->links()}}
      </div>
    </div>
      

@endsection