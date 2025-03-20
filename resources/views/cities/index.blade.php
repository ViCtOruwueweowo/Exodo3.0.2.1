@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Lista de Ciudades</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('cities.create') }}" class="btn btn-primary mb-3">Crear Nueva Ciudad</a>

    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div style="max-height: 700px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Ciudad</th>
                            <th>Continente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cities as $citie)
                        <tr>
                <td>{{ $citie->city_id }}</td>
                <td>{{ $citie->city }}</td>
                <td>{{ $citie->country->country }}</td>
                <td>
                                    <a href="{{ route('cities.edit', $citie->city_id) }}" class="btn btn-warning btn-sm">Editar</a>

                                    <form action="{{ route('cities.destroy', $citie->city_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta ciudad?')">Eliminar</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                    {{ $cities->links() }}
                    </div>
        </div>
    </div>
</div>
@endsection
