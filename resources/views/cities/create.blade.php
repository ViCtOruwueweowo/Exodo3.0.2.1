@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Crear Nueva Ciudad</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('cities.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="city">Nombre de la Ciudad:</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" required>
            @error('city')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="country_id">País:</label>
            <select name="country_id" id="country_id" class="form-control" required>
                <option value="">Seleccione un país</option>
                @foreach($countries as $country)
                    <option value="{{ $country->country_id }}" {{ old('country_id') == $country->country_id ? 'selected' : '' }}>
                        {{ $country->country }}
                    </option>
                @endforeach
            </select>
            @error('country_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Crear Ciudad</button>
    </form>
</div>
@endsection
