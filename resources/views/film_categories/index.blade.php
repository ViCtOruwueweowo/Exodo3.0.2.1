@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Relación Películas - Categorías</h1>

    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div style="max-height: 700px; overflow-y: auto;">
                <table class="table table-striped" id="film-categories-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Film</th>
                            <th>Categoría</th>
                            <th>Última Actualización</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filmCategories as $filmCategory)
                            <tr>
                                <td>{{ $filmCategory->film->film_id  }} {{ "=" }}  {{ $filmCategory->film->title }}</td>
                                <td>{{ $filmCategory->category->name}}</td>
                                <td>{{ $filmCategory->last_update }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                    {{ $filmCategories->links() }}
                    </div>
        </div>
    </div>
</div>
@endsection
