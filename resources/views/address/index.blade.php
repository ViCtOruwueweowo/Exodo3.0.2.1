@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Lista de Direcciones</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('address.create') }}" class="btn btn-primary mb-3">Crear Nueva Dirección</a>

    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Dirección</th>
                            <th>Dirección 2</th> <!-- Agregado para mostrar el campo address2 -->
                            <th>Distrito</th> <!-- Agregado para mostrar distrito -->
                            <th>Ciudad</th>
                            <th>Código Postal</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($addresses as $address)
                            <tr>
                                <td>{{ $address->address_id }}</td>
                                <td>{{ $address->address }}</td>
                                <td>{{ $address->address2 ?? 'N/A' }}</td> <!-- Muestra 'N/A' si el valor es nulo -->
                                <td>{{ $address->district }}</td> <!-- Ahora mostramos el distrito -->
                                <td>{{ $address->city_name }}</td>
                                <td>{{ $address->postal_code }}</td>
                                <td>{{ $address->phone ?? 'N/A' }}</td> <!-- Manejo de valores nulos -->
                                <td>
                                    <a href="{{ route('address.edit', $address->address_id) }}" class="btn btn-warning btn-sm">Editar</a>

                                    <form action="{{ route('address.destroy', $address->address_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta dirección?')">Eliminar</button>
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
