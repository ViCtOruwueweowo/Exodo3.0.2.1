@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Editar Dirección</h1>

    <!-- Mostrar mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('address.update', $address->address_id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Usamos el método PUT para actualizar -->

        <!-- Campo Dirección -->
        <div class="form-group">
            <label for="address">Dirección:</label>
            <input 
                type="text" 
                name="address" 
                id="address" 
                class="form-control @error('address') is-invalid @enderror" 
                value="{{ old('address', $address->address) }}" 
                required>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Dirección 2 -->
        <div class="form-group">
            <label for="address2">Dirección 2 (opcional):</label>
            <input 
                type="text" 
                name="address2" 
                id="address2" 
                class="form-control @error('address2') is-invalid @enderror" 
                value="{{ old('address2', $address->address2) }}">
            @error('address2')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Distrito -->
        <div class="form-group">
            <label for="district">Distrito:</label>
            <input 
                type="text" 
                name="district" 
                id="district" 
                class="form-control @error('district') is-invalid @enderror" 
                value="{{ old('district', $address->district) }}" 
                required>
            @error('district')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Ciudad -->
        <div class="form-group">
            <label for="city_id">Ciudad:</label>
            <select 
                name="city_id" 
                id="city_id" 
                class="form-control @error('city_id') is-invalid @enderror" 
                required>
                <option value="">Seleccione una ciudad</option>
                @foreach($cities as $city)
                    <option 
                        value="{{ $city->city_id }}" 
                        {{ old('city_id', $address->city_id) == $city->city_id ? 'selected' : '' }}>
                        {{ $city->city }}
                    </option>
                @endforeach
            </select>
            @error('city_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Código Postal -->
        <div class="form-group">
            <label for="postal_code">Código Postal:</label>
            <input 
                type="text" 
                name="postal_code" 
                id="postal_code" 
                class="form-control @error('postal_code') is-invalid @enderror" 
                value="{{ old('postal_code', $address->postal_code) }}" 
                required>
            @error('postal_code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Teléfono -->
        <div class="form-group">
            <label for="phone">Teléfono:</label>
            <input 
                type="text" 
                name="phone" 
                id="phone" 
                class="form-control @error('phone') is-invalid @enderror" 
                value="{{ old('phone', $address->phone) }}">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botón Actualizar -->
        <button type="submit" class="btn btn-primary mt-3">Actualizar Dirección</button>
    </form>
</div>
@endsection
