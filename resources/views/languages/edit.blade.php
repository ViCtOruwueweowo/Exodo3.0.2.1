@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Editar Idioma</h1>

    <!-- Mostrar mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('languages.update', $language->language_id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Usamos el método PUT para actualizar -->

        <div class="form-group">
            <label for="name">Idioma:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $language->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar Idioma</button>
    </form>
</div>
@endsection
