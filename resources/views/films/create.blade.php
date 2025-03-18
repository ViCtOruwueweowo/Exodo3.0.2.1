@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Crear Nueva Película</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('films.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Título:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="release_year">Año de Estreno:</label>
            <input type="number" name="release_year" id="release_year" class="form-control" value="{{ old('release_year') }}" required>
            @error('release_year')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="language_id">Idioma:</label>
            <select name="language_id" id="language_id" class="form-control" required>
                @foreach ($languages as $language)
                    <option value="{{ $language->language_id }}" {{ old('language_id') == $language->language_id ? 'selected' : '' }}>{{ $language->name }}</option>
                @endforeach
            </select>
            @error('language_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="rental_duration">Duración de Renta:</label>
            <input type="number" name="rental_duration" id="rental_duration" class="form-control" value="{{ old('rental_duration') }}" required>
            @error('rental_duration')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="rental_rate">Precio de Renta:</label>
            <input type="number" step="0.01" name="rental_rate" id="rental_rate" class="form-control" value="{{ old('rental_rate') }}" required>
            @error('rental_rate')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="length">Duración:</label>
            <input type="number" name="length" id="length" class="form-control" value="{{ old('length') }}" required>
            @error('length')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="replacement_cost">Costo de Reposición:</label>
            <input type="number" step="0.01" name="replacement_cost" id="replacement_cost" class="form-control" value="{{ old('replacement_cost') }}" required>
            @error('replacement_cost')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="rating">Clasificación:</label>
            <select name="rating" id="rating" class="form-control" required>
                <option value="G" {{ old('rating') == 'G' ? 'selected' : '' }}>G</option>
                <option value="PG" {{ old('rating') == 'PG' ? 'selected' : '' }}>PG</option>
                <option value="PG-13" {{ old('rating') == 'PG-13' ? 'selected' : '' }}>PG-13</option>
                <option value="R" {{ old('rating') == 'R' ? 'selected' : '' }}>R</option>
                <option value="NC-17" {{ old('rating') == 'NC-17' ? 'selected' : '' }}>NC-17</option>
            </select>
            @error('rating')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="special_features">Características Especiales:</label>
            <textarea name="special_features" id="special_features" class="form-control" rows="4">{{ old('special_features') }}</textarea>
            @error('special_features')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Crear Película</button>
    </form>
</div>
@endsection
