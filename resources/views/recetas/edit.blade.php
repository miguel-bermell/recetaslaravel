@extends('layouts.app')

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('botones')

  <a href="{{route('recetas.index')}}" class="btn btn-primary mr-2 text-white">Volver</a>

@endsection

@section('content')

  <h2 class="text-center mb-5">Editar receta: <span class="text-primary">{{$receta->titulo}}</span></h2>
  
  <div class="row justify-content-center mt-5">
    <div class="col-md-8">
      <form method="POST" action="{{ route('recetas.update', $receta->id) }}" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="titulo">Titulo Receta</label>
          <input type="text" name="titulo" class="form-control @error('titulo') is-invalid
            @enderror" id="titulo" placeholder="Titulo de la receta"
            value="{{ $receta->titulo }}"/>

          @error('titulo')

            <div class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></div>

          @enderror

        </div>

        <div class="form-group mb-3">
          <label for="categoria">Categoría</label>
          <select name="categoria" class="form-control @error('categoria')
            is-invalid @enderror" id="categoria">
            
            <option selected disabled value="">Seleccione Receta</option>
            @foreach ($categorias as  $categoria)
              <option value="{{ $categoria->id }}" {{ $receta->categoria_id == $categoria->id ? 'selected' : '' }}>
                {{ $categoria->nombre }}
              </option>
            @endforeach
          </select>

          @error('categoria')

            <div class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></div>

          @enderror

        </div>

        <div class="form-group">
          <label for="preparacion"> Preparación </label>

          <input class="trix-content" id="preparacion" type="hidden" name="preparacion" value="{{$receta->preparacion}}">

          <trix-editor input="preparacion" class="form-control trix-content @error('preparacion') is-invalid @enderror"></trix-editor>

          @error('preparacion')

            <div class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></div>

          @enderror

        </div>

        <div class="form-group">
          <label for="ingredientes"> Ingredientes </label>

          <input class="trix-content" id="ingredientes" type="hidden" name="ingredientes" value="{{$receta->ingredientes}}">

          <trix-editor input="ingredientes" class="form-control trix-content @error('ingredientes') is-invalid @enderror"></trix-editor>

          @error('ingredientes')

            <div class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></div>

          @enderror

        </div>

        <div class="form-group">
          <label for="imagen"> Elige una imagen </label>

          <input 
          id="imagen" 
          type="file"
          name="imagen"
          class="form-control @error('imagen') is-invalid @enderror"
          >


            <div class="mt-4 imagen-receta">
              <p>Imagen actual</p>
              @if(strpos($receta->imagen, 'http') !== false)
              <img style="width: 300px" src="{{$receta->imagen}}" alt="Receta imagen">
              @else
              <img style="width: 300px" src="{{asset('storage/'.$receta->imagen)}}" alt="Receta imagen">
              @endif
            </div>


          @error('imagen')

            <div class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></div>

          @enderror

        </div>


        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Guardar Receta">
        </div>
      </form>
    </div>
  </div>


@endsection


@section('scripts')
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection