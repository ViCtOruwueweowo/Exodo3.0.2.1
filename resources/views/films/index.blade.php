@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Lista de Películas</h1>

    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped" id="films-table">
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
                            <th>Última Actualización</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($films as $film)
                            <tr>
                                <td>{{ $film->film_id }}</td>
                                <td>{{ $film->title }}</td>
                                <td>{{ Str::limit($film->description, 50) }}</td>
                                <td>{{ $film->release_year }}</td>
                                <td>{{ $film->language_id }}</td>
                                <td>{{ $film->rental_duration }}</td>
                                <td>{{ $film->rental_rate }}</td>
                                <td>{{ $film->length }}</td>
                                <td>{{ $film->replacement_cost }}</td>
                                <td>{{ $film->rating }}</td>
                                <td>{{ $film->special_features }}</td>
                                <td>{{ $film->last_update }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
