@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Lista de Rental</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @php
        $role_id = request()->cookie('role_id');
    @endphp

    @if(in_array($role_id, [1, 2]))

    <a href="{{ route('rentals.create') }}" class="btn btn-primary mb-3">Crear Nuevo Rental</a>
    @endif

    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div style="max-height: 700px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th># Inventario</th>
                            <th>Cliente</th>
                            <th>Fecha regreso</th>
                            <th>Encargado del staff</th>
                            @if(in_array($role_id, [1, 2]))
                            <th>Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rentals as $rental)
                            <tr>
                                <td>{{ $rental->rental_id }}</td>
                                <td>{{ $rental->rental_date }}</td>
                                <td>{{ $rental->inventory_id }}</td>
                                <td>{{ $rental->customer_name }}</td>
                                <td>{{ $rental->return_date }}</td>
                                <td>{{ $rental->staff_name }}</td>
                                @if(in_array($role_id, [1, 2]))
                                <td>
                                    <!-- Enlace para editar la película -->
                                    <a href="{{ route('rentals.edit', $rental->rental_id) }}" class="btn btn-warning btn-sm">Editar</a>

                                    <!-- Formulario para eliminar la película -->
                                    <form action="{{ route('rentals.destroy', $rental->rental_id) }}"" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta renta?')">Eliminar</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                    {{ $rentals->links() }}
                    </div>
        </div>
    </div>
</div>
@endsection
