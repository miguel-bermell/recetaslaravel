@extends('layouts.app')

@section('styles')

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('hero')
  <div class="hero-categorias">
    <form class="container h-100" action="{{ route('buscar.show') }}">
      <div class="row h-100 align-items-center">
        <div class="col-md-4 texto-buscar">
          <p class="display-2">Encuentra una receta para tu próxima comida</p>
        
          <input type="search" name="buscar" class="form-control" placeholder="Buscar receta">
        </div>
      </div>
    </form>
  </div>

@endsection


@section('content')

  {{-- <img src="{{ asset('/images/bgimagen.jpg') }}" alt="Imagen de fondo"> --}}
  
  <div class="container nuevas-recetas">
    <h2 class="titulo-categoria text-uppercase mb-4 mt-2">Últimas recetas</h2>

    <div class="owl-carousel owl-theme">
      @foreach($nuevas as $nueva)
        <div class="card ">
          @if(strpos($nueva->imagen, 'http') !== false)
          <img class="w-100 card-img-top" src="{{$nueva->imagen}}" alt="Receta imagen">
          @else
          <img class="w-100 card-img-top" src="{{asset('storage/'.$nueva->imagen)}}" alt="Receta imagen">
        @endif
          <div class="card-body">
            <h3>{{ Str::title($nueva->titulo) }}</h3>

            <p> {{ Str::words( strip_tags( $nueva->preparacion ), 20 ) }} </p>

            <a href="{{ route('recetas.show', $nueva->id) }}" class="btn btn-primary d-block font-weigth text-uppercase">
              Ver receta
            </a>
          </div>
        </div>
      @endforeach
    </div>

  </div>

  <div class="container">
    <h2 class="titulo-categoria text-uppercase mt-5 mb-4">
      Recetas más votadas
    </h2>
    
    <div class="row">
        @foreach($likes as $receta)
          @include('ui.receta')
        @endforeach
    </div>
  </div>
  

  @foreach($recetas as $key => $grupo)
    
    <div class="container">
      <h2 class="titulo-categoria text-uppercase mt-5 mb-4">
        {{ str_replace('-', ' ', $key) }}
      </h2>
      
      <div class="row">
        @foreach($grupo as $recetas)
          @foreach($recetas as $receta)
            @include('ui.receta')
          @endforeach
        @endforeach
      </div>
    </div>

  @endforeach

@endsection