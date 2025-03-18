@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">Crear Nuevo Cliente</h1>

    <a href="{{ route('customers.index') }}" class="btn btn-secondary mb-3">Volver a la Lista de Clientes</a>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="first_name">Nombre</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Apellido</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="store_id">Tienda</label>
                    <select class="form-control" id="store_id" name="store_id" required>
                        <option value="">Seleccione una Tienda</option>
                        @foreach($stores as $store)
                            <option value="{{ $store->store_id }}" {{ old('store_id') == $store->store_id ? 'selected' : '' }}>
                                {{ $store->store_id }} - {{ $store->managerStaff->first_name }} {{ $store->managerStaff->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="address_id">Dirección</label>
                    <select class="form-control" id="address_id" name="address_id" required>
                        <option value="">Seleccione una Dirección</option>
                        @foreach($addresses as $address)
                            <option value="{{ $address->address_id }}" {{ old('address_id') == $address->address_id ? 'selected' : '' }}>
                                {{ $address->address }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="active">Estado</label>
                    <select class="form-control" id="active" name="active" required>
                        <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Crear Cliente</button>
            </form>
        </div>
    </div>
</div>
@endsection
