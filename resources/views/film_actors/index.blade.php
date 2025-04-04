@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Relación Películas - Actores</h1>

    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div style="max-height: 700px; overflow-y: auto;">
                <table class="table table-striped" id="film-actors-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Pelicula</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filmActors as $filmActor)
                            <tr>
                                <td>{{ $filmActor->actor_id }}</td>
                                <td>{{ $filmActor->Nombre }}</td>
                                <td>{{ $filmActor->Apellido }}</td>
                                <td>{{ $filmActor->Pelicula }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                    {{ $filmActors->links() }}
                    </div>
        </div>
    </div>
</div>
@endsection
