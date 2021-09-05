<a href="{{route('recetas.create')}}" class="btn btn-outline-primary mr-2 text-dark">Crear receta</a>
{{-- <a href="{{route('perfiles.edit', Auth::user()->id)}}" class="btn btn-dark mr-2 text-white">Editar perfil</a> --}}
@if (count($user->meGusta) > 0)
<button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalCenter">
  Recetas favoritas
</button>
@endif