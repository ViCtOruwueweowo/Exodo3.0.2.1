@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Editar Película</h1>

    <!-- Formulario de edición de película -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('films.update', $film->film_id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Usamos PUT para la actualización -->

                <div class="form-group">
                    <label for="title">Título:</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $film->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Descripción:</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $film->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="release_year">Año de Estreno:</label>
                    <input type="number" name="release_year" id="release_year" class="form-control @error('release_year') is-invalid @enderror" value="{{ old('release_year', $film->release_year) }}" required>
                    @error('release_year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="language_id">Idioma:</label>
                    <select name="language_id" id="language_id" class="form-control @error('language_id') is-invalid @enderror" required>
                        @foreach ($languages as $language)
                            <option value="{{ $language->language_id }}" {{ old('language_id', $film->language_id) == $language->language_id ? 'selected' : '' }}>{{ $language->name }}</option>
                        @endforeach
                    </select>
                    @error('language_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rental_duration">Duración de Renta:</label>
                    <input type="number" name="rental_duration" id="rental_duration" class="form-control @error('rental_duration') is-invalid @enderror" value="{{ old('rental_duration', $film->rental_duration) }}" required>
                    @error('rental_duration')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rental_rate">Precio de Renta:</label>
                    <input type="number" step="0.01" name="rental_rate" id="rental_rate" class="form-control @error('rental_rate') is-invalid @enderror" value="{{ old('rental_rate', $film->rental_rate) }}" required>
                    @error('rental_rate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="length">Duración:</label>
                    <input type="number" name="length" id="length" class="form-control @error('length') is-invalid @enderror" value="{{ old('length', $film->length) }}" required>
                    @error('length')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="replacement_cost">Costo de Reposición:</label>
                    <input type="number" step="0.01" name="replacement_cost" id="replacement_cost" class="form-control @error('replacement_cost') is-invalid @enderror" value="{{ old('replacement_cost', $film->replacement_cost) }}" required>
                    @error('replacement_cost')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rating">Clasificación:</label>
                    <select name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror" required>
                        <option value="G" {{ old('rating', $film->rating) == 'G' ? 'selected' : '' }}>G</option>
                        <option value="PG" {{ old('rating', $film->rating) == 'PG' ? 'selected' : '' }}>PG</option>
                        <option value="PG-13" {{ old('rating', $film->rating) == 'PG-13' ? 'selected' : '' }}>PG-13</option>
                        <option value="R" {{ old('rating', $film->rating) == 'R' ? 'selected' : '' }}>R</option>
                        <option value="NC-17" {{ old('rating', $film->rating) == 'NC-17' ? 'selected' : '' }}>NC-17</option>
                    </select>
                    @error('rating')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="special_features">Características Especiales:</label>
                    <textarea name="special_features" id="special_features" class="form-control @error('special_features') is-invalid @enderror" rows="4">{{ old('special_features', $film->special_features) }}</textarea>
                    @error('special_features')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success mt-3">Actualizar Película</button>
            </form>
        </div>
    </div>

</div>
@endsection
