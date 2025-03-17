@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Relación Películas - Actores</h1>

    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped" id="film-actors-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Actor ID</th>
                            <th>Film ID</th>
                            <th>Última Actualización</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filmActors as $filmActor)
                            <tr>
                                <td>{{ $filmActor->actor_id }}</td>
                                <td>{{ $filmActor->film_id }}</td>
                                <td>{{ $filmActor->last_update }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
