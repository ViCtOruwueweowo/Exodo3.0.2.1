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

    @if(in_array($role_id, [1, 2]))
    <a href="{{ route('films.create') }}" class="btn btn-primary mb-3">Crear Nueva Película</a>
    @endif

    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Año de Estreno</th>
                            <th>Idioma</th>
                            <th>Duración de Renta</th>
                            <th>Precio de Renta</th>
                            <th>Duración</th>
                            <th>Costo de Reposición</th>
                            <th>Clasificación</th>
                            <th>Especiales</th>
                            @if(in_array($role_id, [1, 2]))
                            <th>Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($films as $film)
                            <tr>
                                <td>{{ $film->film_id }}</td>
                                <td>{{ $film->title }}</td>
                                <td>{{ Str::limit($film->description, 50) }}</td>
                                <td>{{ $film->release_year }}</td>
                                <td>{{ $film->language_name }}</td>
                                <td>{{ $film->rental_duration }}</td>
                                <td>{{ $film->rental_rate }}</td>
                                <td>{{ $film->length }}</td>
                                <td>{{ $film->replacement_cost }}</td>
                                <td>{{ $film->rating }}</td>
                                <td>{{ $film->special_features }}</td>
                                @if(in_array($role_id, [1, 2]))
                                <td>
                                    <!-- Enlace para editar la película -->
                                    <a href="{{ route('films.edit', $film->film_id) }}" class="btn btn-warning btn-sm">Editar</a>

                                    <!-- Formulario para eliminar la película -->
                                    <form action="{{ route('films.destroy', $film->film_id) }}"" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta película?')">Eliminar</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                    <div class="d-flex justify-content-center">
                    {{ $films->links() }}
                    </div>
            </div>
        </div>
    </div>  
</div>
@endsection
