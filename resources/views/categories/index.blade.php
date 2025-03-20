
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Lista de Categorías</h1>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Crear Nueva Categoría</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div style="max-height: 700px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Última actualización</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->category_id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->last_update }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category->category_id) }}" class="btn btn-warning btn-sm">Actualizar</a>

                                    <form action="{{ route('categories.destroy', $category->category_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')">Eliminar</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Paginación -->
<div class="d-flex justify-content-center">
    {{ $categories->links() }}
</div>
        </div>
    </div>
</div>
@endsection
