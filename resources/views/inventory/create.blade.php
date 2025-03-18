@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Agregar Elemento al inventario</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('cities.store') }}" method="POST">

    <div class="form-group">
            <label for="film_id">Pelicula:</label>
            <select name="film_id" id="film_id" class="form-control" required>
                <option value="">Seleccione una pelicula</option>
                @foreach($films as $film)
                    <option value="{{ $film->film_id}}" {{ old('film_id') == $film->film_id ? 'selected' : '' }}>
                        {{ $film->film }}
                    </option>
                @endforeach
            </select>
            @error('film_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

    <button type="submit" class="btn btn-primary mt-3">Crear Ciudad</button>
    </form>

@endsection   
