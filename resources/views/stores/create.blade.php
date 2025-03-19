@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Crear Nueva Tienda</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('store.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="manager_staff_id">Encargado del Staff:</label>
            <select name="manager_staff_id" id="manager_staff_id" class="form-control" required>
                <option value="">Seleccione un encargado</option>
                @foreach($staff as $member)
                    <option value="{{ $member->staff_id }}" {{ old('manager_staff_id') == $member->staff_id ? 'selected' : '' }}>
                        {{ $member->full_name }}
                    </option>
                @endforeach
            </select>
            @error('manager_staff_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address_id">Dirección:</label>
            <select name="address_id" id="address_id" class="form-control" required>
                <option value="">Seleccione una dirección</option>
                @foreach($addresses as $address)
                    <option value="{{ $address->address_id }}" {{ old('address_id') == $address->address_id ? 'selected' : '' }}>
                        {{ $address->address_name }}
                    </option>
                @endforeach
            </select>
            @error('address_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Crear Tienda</button>
    </form>
</div>
@endsection
