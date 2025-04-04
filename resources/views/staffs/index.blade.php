@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Lista de Staff</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @php
        $role_id = request()->cookie('role_id');
    @endphp

    @if(in_array($role_id, [1, 2]))
    <a href="{{ route('staff.create') }}" class="btn btn-primary mb-3">Crear Nuevo Staff</a>
    @endif

    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Dirección</th>
                            <th>Imagen</th>
                            <th>Email</th>
                            <th>Tienda</th>
                            <th>Estado</th>
                            <th>Nombre de usuario</th>
                            <th>Contraseña</th>
                            @if(in_array($role_id, [1, 2]))
                            <th>Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staffs as $staff)
                            <tr>
                                <td>{{ $staff->staff_id }}</td>
                                <td>{{ $staff->first_name }}</td>
                                <td>{{ $staff->last_name }}</td>
                                <td>{{ $staff->address_name }}</td>
                                <td>{{ $staff->picture }}</td>
                                <td>{{ $staff->email }}</td>
                                <td>{{ $staff->store_id }}</td>
                                <td>{{ $staff->active }}</td>
                                <td>{{ $staff->username }}</td>
                                <td>{{ $staff->password }}</td>
                                @if(in_array($role_id, [1, 2]))
                                <td>
                                    <!-- Enlace para editar la película -->
                                    <a href="{{ route('staff.edit', $staff->staff_id) }}" class="btn btn-warning btn-sm">Editar</a>

                                    <!-- Formulario para eliminar la película -->
                                    <form action="{{ route('staff.destroy', $staff->staff_id) }}"" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este empleado?')">Eliminar</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
