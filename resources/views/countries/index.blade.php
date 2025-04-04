@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Lista de Continentes</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @php
        $role_id = request()->cookie('role_id');
    @endphp


    @if(in_array($role_id, [1, 2]))
    <a href="{{ route('countries.create') }}" class="btn btn-primary mb-3">Crear Nuevo Continente</a>
    @endif

    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div style="max-height: 700px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Continente</th>
                            <th>Última actualización</th>
                            @if(in_array($role_id, [1, 2]))
                            <th>Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($countries as $country)
                            <tr>
                                <td>{{ $country->country_id }}</td>
                                <td>{{ $country->country }}</td>
                                <td>{{ $country->last_update }}</td>
                                @if(in_array($role_id, [1, 2]))
                                <td>
                                    <a href="{{ route('countries.edit', $country->country_id) }}" class="btn btn-warning btn-sm">Editar</a>

                                    <form action="{{ route('countries.destroy', $country->country_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este continente?')">Eliminar</button>
                                    </form>

                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                    {{ $countries->links() }}
                    </div>
        </div>
    </div>
</div>
@endsection
