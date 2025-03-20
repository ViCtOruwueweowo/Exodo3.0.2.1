@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Lista de Actores</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('actors.create') }}" class="btn btn-primary mb-3">Crear Nuevo Actor</a>

    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div style="max-height: 700px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Última actualización</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($actors as $actor)
                            <tr>
                                <td>{{ $actor->actor_id }}</td>
                                <td>{{ $actor->first_name }}</td>
                                <td>{{ $actor->last_name }}</td>
                                <td>{{ $actor->last_update }}</td>
                                <td>
                                    <a href="{{ route('actors.edit', $actor->actor_id) }}" class="btn btn-warning btn-sm">Editar</a>

                                    <form action="{{ route('actors.destroy', $actor->actor_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este actor?')">Eliminar</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
    {{ $actors->links() }}
</div>
        </div>
    </div>
</div>
@endsection
