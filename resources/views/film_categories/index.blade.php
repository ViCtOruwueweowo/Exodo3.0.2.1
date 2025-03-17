@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Relación Películas - Categorías</h1>

    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped" id="film-categories-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Film ID</th>
                            <th>Categoría ID</th>
                            <th>Última Actualización</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filmCategories as $filmCategory)
                            <tr>
                                <td>{{ $filmCategory->film_id }}</td>
                                <td>{{ $filmCategory->category_id }}</td>
                                <td>{{ $filmCategory->last_update }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
