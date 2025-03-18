@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Editar Categoría</h1>

    <!-- Formulario de edición de categoría -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.update', $category->category_id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Usamos PUT para la actualización -->
                
                <div class="form-group">
                    <label for="name">Nombre de la Categoría</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success mt-3">Actualizar Categoría</button>
            </form>
        </div>
    </div>

</div>
@endsection
