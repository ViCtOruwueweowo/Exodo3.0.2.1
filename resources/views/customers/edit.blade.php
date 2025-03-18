@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Actualizar Cliente</h1>

    <a href="{{ route('customers.index') }}" class="btn btn-secondary mb-3">Volver a la lista</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('customers.update', $customer->customer_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="store_id">Tienda</label>
            <select name="store_id" id="store_id" class="form-control" required>
                @foreach($stores as $store)
                    <option value="{{ $store->store_id }}" {{ $store->store_id == $customer->store_id ? 'selected' : '' }}>
                        {{ $store->store_id }} - {{ $store->managerStaff->first_name }} {{ $store->managerStaff->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="first_name">Primer Nombre</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $customer->first_name) }}" required>
        </div>

        <div class="form-group">
            <label for="last_name">Apellido</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $customer->last_name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $customer->email) }}">
        </div>

        <div class="form-group">
            <label for="address_id">Dirección</label>
            <select name="address_id" id="address_id" class="form-control" required>
                @foreach($addresses as $address)
                    <option value="{{ $address->address_id }}" {{ $address->address_id == $customer->address_id ? 'selected' : '' }}>
                        {{ $address->address }} - {{ $address->district }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="active">Estado</label>
            <select name="active" id="active" class="form-control" required>
                <option value="1" {{ $customer->active == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ $customer->active == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
    </form>
</div>
@endsection
