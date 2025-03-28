@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Inventarios</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<div class="container mt-5">
<a href="{{ route('inventario.create') }}" class="btn btn-primary">Agregar</a>
<br><br>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
    <!-- Contenedor con desplazamiento vertical -->
    <div style="max-height: 600px; overflow-y: auto;">
    <table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Película</th>
            <th>Tienda</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($inventories as $inventory)
            <tr>
                <td>{{ $inventory->inventory_id }}</td>
                <td>{{ $inventory->film->title }}</td>
                <td>{{ $inventory->store_id }}</td>
                <td>
                    <!-- Formulario para eliminar la película -->
                    <form action="{{ route('inventarios.destroy', $inventory->inventory_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este elemento del inventario?')">Eliminar</button>
                    </form>
                    <a type="button" href="{{ route('inventory.edit', $inventory->inventory_id) }}" class="btn btn-warning">Editar</a><br><br>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Paginación -->
<div class="d-flex justify-content-center">
    {{ $inventories->links() }}
    </div>
            </div>
        </div>
    </div>  
</div>


@endsection   