<div class="col-md-4 mt-2 mb-2">
  <div class="tooltip">Hover over me
    <span class="tooltiptext">Tooltip text</span>
  </div>
  <div class="card shadow">
    @if(strpos($receta->imagen, 'http') !== false)
    <a href="{{ route('recetas.show', $receta->id) }}">
    <img class="w-100 card-img-top" src="{{$receta->imagen}}" alt="Receta imagen">
    </a>
    @else
    <a href="{{ route('recetas.show', $receta->id) }}">
    <img class="w-100 card-img-top" src="{{asset('storage/'.$receta->imagen)}}" alt="Receta imagen">
    </a>
  @endif
    <div class="card-body">
      <h3 class="card-title">{{ $receta->titulo }}</h3>

      <div class="meta-receta d-flex justify-content-between">
        <p class="text-primary fecha font-weight-bold">
          {{$receta->created_at->format('d/m/Y')}}
        </p>
        <p> {{ count( $receta->likes ) }} <i class="far fa-heart text-danger"></i>  </p>
      </div>

      <p> {{ Str::words( strip_tags( $receta->preparacion ), 20, '...') }} </p>
    </div>
  </div>
</div>