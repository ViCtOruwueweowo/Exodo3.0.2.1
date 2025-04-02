@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Lista de Películas</h1>

    @php
        $role_id = request()->cookie('role_id');
    @endphp

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    @if(in_array($role_id, [1, 2]))

    <a href="{{ route('films.create') }}" class="btn btn-primary">Agregar</a>
    @endif
    <br><br>
    <!-- Contenedor con desplazamiento vertical -->

    <div class="card">
        <div class="card-body">
             <!-- Contenedor con desplazamiento vertical -->
             <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                
<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descripción</th>
            @if(in_array($role_id, [1, 2]))
            <th>Opciones</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($films as $film)
            <tr id="film-{{ $film->film_id }}">
                <td>{{ $film->film_id }}</td>
                <td>{{ $film->title }}</td>
                <td>{{ $film->description }}</td>
                @if(in_array($role_id, [1, 2]))
                <td>
                    <!-- Botón de editar (aún sin acción) -->
                    <a type="button" href="{{ route('films.edit', $film->film_id) }}" class="btn btn-warning">Editar</a><br><br>

                    <!-- Formulario para eliminar la película -->
                    <form action="{{ route('films.destroy', $film->film_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta película?')">Eliminar</button>
                    </form>
                </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Paginación -->
<div class="d-flex justify-content-center">
    {{ $films->links() }}
</div>

             </div>
        </div>
    </div>

</div>

<!-- Script de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

@endsection
