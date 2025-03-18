@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Editar Elemento del inventario</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">
        <h1>Editar Inventario</h1>

        <form action="{{ route('inventory.update', $inventory->inventory_id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Para indicar que la solicitud es PUT -->

            <!-- Campo para seleccionar la película -->
            <div class="form-group">
                <label for="film_id">Película:</label>
                <select name="film_id" id="film_id" class="form-control" required>
                    <option value="">Seleccione una película</option>
                    @foreach($films as $film)
                        <option value="{{ $film->film_id }}" {{ $film->film_id == old('film_id', $inventory->film_id) ? 'selected' : '' }}>
                            {{ $film->title }}
                        </option>
                    @endforeach
                </select>
                @error('film_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo para seleccionar la tienda -->
            <div class="form-group">
                <label for="store_id">Tienda:</label>
                <select name="store_id" id="store_id" class="form-control" required>
                    <option value="">Seleccione una tienda</option>
                    @foreach($stores as $store)
                        <option value="{{ $store->store_id }}" {{ $store->store_id == old('store_id', $inventory->store_id) ? 'selected' : '' }}>
                            {{ $store->store_id }}
                        </option>
                    @endforeach
                </select>
                @error('store_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Actualizar Inventario</button>
        </form>

        <a href="{{ route('inventarios.show') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
    </div>


@endsection 