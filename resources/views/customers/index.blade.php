@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Lista de Clientes</h1>

    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Activo</th>
                            <th>Fecha Creación</th>
                            <th>Fecha de actualizacion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->customer_id }}</td>
                                <td>{{ $customer->first_name }}</td>
                                <td>{{ $customer->last_name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->active ? 'Sí' : 'No' }}</td>
                                <td>{{ $customer->create_date }}</td>
                                <td>{{ $customer->last_update}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
