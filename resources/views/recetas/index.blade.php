@extends('layouts.app')

@section('botones')

  @include('ui.navigation')

@endsection

@section('content')

  <h2 class="text-center mb-5">Administra tus recetas</h2>

  <div class="col-md-10 mx-auto bg-white p-3">
    <table class="table">
      <thead class="bg-primary text-light">
        <tr>
          <th scole="col">Título</th>
          <th scope="col">Categoría</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($recetas as $receta)
          <tr>
            <td>{{$receta->titulo}}</td>
            <td>{{$receta->categoria->nombre}}</td>
            <td>
              {{-- <form action="{{route('recetas.destroy', $receta->id)}}" method="POST">
                  @csrf
                  @method('DELETE')
                <input type="submit" class="btn btn-danger mb-2 d-block w-100" value="Eliminar &times;">
              </form> --}}
              <a href="{{route('recetas.show', $receta->id)}}" class="btn btn-dark mb-2 d-block">Mostrar</a>
              <a href="{{route('recetas.edit', $receta->id)}}" class="btn btn-primary mb-2 d-block">Editar</a>
              <eliminar-receta receta={{$receta->id}}></eliminar-receta>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div>
      {{$recetas->links()}}
    </div>

      <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Recetas que te gustan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-md-10 mx-auto bg-white p-3">
              <ul class="list-group">
                @foreach($user->meGusta as $receta)
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <p>{{$receta->titulo}}</p>
                    <a class="btn btn-outline-dark" href="{{ route('recetas.show', $receta->id) }}">Mostrar</a>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

  </div>


@endsection