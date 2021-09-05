@extends('layouts.app')

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('botones')

  <a href="{{route('recetas.index')}}" class="btn btn-primary mr-2 text-white">Volver</a>

@endsection


@section('content')
    <h1 class="text-center">Editar mi perfil</h1>
    <div class="row justify-content-center mt-5">
      <div class="col-md-10 bg-white p-3">
        <form action="{{ route('perfiles.update', $perfil->id)}}"
          method="POST"
          enctype="multipart/form-data"
          >
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="nombre">Nombre</label>

            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid
              @enderror" id="nombre" placeholder="Tu nombre"
              value="{{ $perfil->usuario->name }}"
              />

                @error('nombre')

                  <div class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></div>

                @enderror

          </div>

          <div class="form-group">
            <label for="url">Sitio Web</label>

            <input type="text" name="url" class="form-control @error('url') is-invalid
              @enderror" id="url" placeholder="Tu sitio web"
              value="{{ $perfil->usuario->url}}"
              />

                @error('url')

                  <div class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></div>

                @enderror

          </div>

          <div class="form-group">
            <label for="biografia"> Biografia </label>

            <input class="trix-content" id="biografia" type="hidden" name="biografia" value="{{$perfil->biografia}}" >

            <trix-editor input="biografia" class="form-control trix-content @error('biografia') is-invalid @enderror"></trix-editor>

            @error('biografia')

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

              @if($perfil->imagen)
                <div class="mt-4">
                  <p>Imagen actual</p>
                  @if(strpos($perfil->imagen, 'http') !== false)
                  <img style="width: 300px" src="{{$perfil->imagen}}" alt="perfil imagen">
                  @else
                  <img style="width: 300px" src="{{asset('storage/'.$perfil->imagen)}}" alt="perfil imagen">
                  @endif
                </div>


                @error('imagen')

                  <div class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></div>

                @enderror
              @endif

        </div>

          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Actualizar Perfil">
          </div>

        </form>
      </div>
    </div>

  

@endsection


@section('scripts')
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection