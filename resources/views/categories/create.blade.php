
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Crear Nueva Categoría</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre de la Categoría</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">Guardar Categoría</button>
            </form>
        </div>
    </div>
</div>
@endsection
