@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Lista de Idiomas</h1>

    @php
        $role_id = request()->cookie('role_id');
    @endphp

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(in_array($role_id, [1, 2]))
    <a href="{{ route('languages.create') }}" class="btn btn-primary mb-3">Crear Nuevo Idioma</a>
    @endif

    <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
            <div style="max-height: 700px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Idioma</th>
                            @if(in_array($role_id, [1, 2]))
                            <th>Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($languages as $language)
                            <tr>
                                <td>{{ $language->language_id }}</td>
                                <td>{{ $language->name }}</td>
                                @if(in_array($role_id, [1, 2]))
                                <td>
                                    <!-- Enlace para editar el idioma -->
                                    <a href="{{ route('languages.edit', $language->language_id) }}" class="btn btn-warning btn-sm">Editar</a>

                                    <!-- Formulario para eliminar el idioma -->
                                    <form action="{{ route('languages.destroy', $language->language_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este idioma?')">Eliminar</button>
                                    </form>

                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
    {{ $languages->links() }}
</div>
        </div>
        <!-- Paginación -->

    </div>
</div>
@endsection
