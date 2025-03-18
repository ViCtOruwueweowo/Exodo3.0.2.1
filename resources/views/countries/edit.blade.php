@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Editar Contiente</h1>

    <!-- Mostrar mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('countries.update', $country->country_id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Usamos el método PUT para actualizar -->

        <div class="form-group">
            <label for="first_name">Continente:</label>
            <input type="text" name="country" id="country" class="form-control" value="{{ old('country', $country->country) }}" required>
            @error('first_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar Continente</button>
    </form>
</div>
@endsection
