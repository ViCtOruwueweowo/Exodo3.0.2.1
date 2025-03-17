@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Editar Actor</h1>

    <!-- Mostrar mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('actors.update', $actor->actor_id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Usamos el método PUT para actualizar -->

        <div class="form-group">
            <label for="first_name">Nombre:</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $actor->first_name) }}" required>
            @error('first_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name">Apellido:</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $actor->last_name) }}" required>
            @error('last_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar Actor</button>
    </form>
</div>
@endsection
