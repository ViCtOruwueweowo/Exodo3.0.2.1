@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Agregar Elemento al inventario</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<form action="{{ route('inventory.store') }}" method="POST">

@csrf <!-- Asegura que el token CSRF se incluya en el formulario -->

<div class="form-group">
    <label for="film_id">Película:</label>
    <select name="film_id" id="film_id" class="form-control" required>
        <option value="">Seleccione una película</option>
        @if ($films->isEmpty())
            <option disabled>No hay películas disponibles</option>
        @else
            @foreach($films as $film)
                <option value="{{ $film->film_id }}" {{ old('film_id') == $film->film_id ? 'selected' : '' }}>
                    {{ $film->title }} <!-- Asegúrate de usar el campo correcto -->
                </option>
            @endforeach
        @endif
    </select>
    @error('film_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="store_id">Tienda:</label>
    <select name="store_id" id="store_id" class="form-control" required>
        <option value="">Seleccione una tienda</option>
        @if ($stores->isEmpty())
            <option disabled>No hay tiendas disponibles</option>
        @else
            @foreach($stores as $store)
                <option value="{{ $store->store_id }}" {{ old('store_id') == $store->store_id ? 'selected' : '' }}>
                    {{ $store->store_id }} <!-- Asegúrate de usar el campo correcto -->
                </option>
            @endforeach
        @endif
    </select>
    @error('store_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-primary mt-3">Agregar</button>
</form>

<a href="{{ route('inventarios.show') }}" class="btn btn-secondary mt-3">Volver a la lista</a>


@endsection   
