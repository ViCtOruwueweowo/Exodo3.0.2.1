@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Lista de Tiendas</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('store.create') }}" class="btn btn-primary mb-3">Crear Nueva Tienda</a>

    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Manager encargado</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stores as $store)
                            <tr>
                                <td>{{ $store->store_id }}</td>
                                <td>{{ $store->manager_staff }}</td>
                                <td>{{ $store->address_name }}</td>
                                <td>
                                    <!-- Enlace para editar la película -->
                                    <a href="{{ route('store.edit', $store->store_id) }}" class="btn btn-warning btn-sm">Editar</a>

                                    <!-- Formulario para eliminar la película -->
                                    <form action="{{ route('store.destroy', $store->store_id) }}"" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta película?')">Eliminar</button>
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
