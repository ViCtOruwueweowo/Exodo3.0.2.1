@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Lista de Clientes</h1>

    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Crear Nuevo Cliente</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div style="max-height: 700px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Tienda</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th>Última Actualización</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->customer_id }}</td>
                                <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                <td>{{ $customer->email ?? 'N/A' }}</td>
                                <td>{{ $customer->store->store_id ?? 'N/A' }}</td>
                                <td>{{ $customer->address->address ?? 'N/A' }}</td>
                                <td>{{ $customer->active ? 'Activo' : 'Inactivo' }}</td>
                                <td>{{ $customer->last_update }}</td>
                                <td>
                                    <a href="{{ route('customers.edit', $customer->customer_id) }}" class="btn btn-warning btn-sm">Actualizar</a>

                                    <form action="{{ route('customers.destroy', $customer->customer_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Paginación -->
<div class="d-flex justify-content-center">
    {{ $customers->links() }}
</div>
    </div>
</div>
@endsection
