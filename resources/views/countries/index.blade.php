@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Lista de Continentes</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('countries.create') }}" class="btn btn-primary mb-3">Crear Nuevo Continente</a>

    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Continente</th>
                            <th>Última actualización</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($countries as $countries)
                            <tr>
                                <td>{{ $countries->country_id }}</td>
                                <td>{{ $countries->country }}</td>
                                <td>{{ $countries->last_update }}</td>
                                <td>
                                    <a href="{{ route('countries.edit', $countries->country_id) }}" class="btn btn-warning btn-sm">Editar</a>

                                    <form action="{{ route('countries.destroy', $countries->country_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este continente?')">Eliminar</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
