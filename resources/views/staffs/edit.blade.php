@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Editar Staff</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('staff.update', $staff->staff_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="first_name">Nombre(s):</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $staff->first_name) }}" required>
            @error('first_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name">Apellidos:</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $staff->last_name) }}" required>
            @error('last_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address_id">Dirección:</label>
            <select name="address_id" id="address_id" class="form-control" required>
                <option value="">Seleccione una dirección</option>
                @foreach($addresses as $address)
                    <option value="{{ $address->address_id }}" {{ old('address_id', $staff->address_id) == $address->address_id ? 'selected' : '' }}>
                        {{ $address->address_name }}
                    </option>
                @endforeach
            </select>
            @error('address_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $staff->email) }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="store_id">Tienda:</label>
            <select name="store_id" id="store_id" class="form-control" required>
                <option value="">Seleccione un # de tienda</option>
                @foreach($stores as $store)
                    <option value="{{ $store->store_id }}" {{ old('store_id', $staff->store_id) == $store->store_id ? 'selected' : '' }}>
                        {{ $store->store_id }}
                    </option>
                @endforeach
            </select>
            @error('store_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="active">Activo:</label>
            <select name="active" id="active" class="form-control" required>
                <option value="1" {{ old('active', $staff->active) == '1' ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ old('active', $staff->active) == '0' ? 'selected' : '' }}>No</option>
            </select>
            @error('active')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="username">Nombre de usuario:</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $staff->username) }}" required>
            @error('username')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo para seleccionar el rol -->
        <div class="form-group">
    <label for="role_id">Rol:</label>
    <select name="role_id" id="role_id" class="form-control" required>
        <option value="">Seleccione un rol</option>
        @foreach($roles as $index => $role)
            <option value="{{ $role->id }}" 
                {{ old('role_id', $staff->role_id) == $role->id ? 'selected' : '' }}>
                {{ $index + 1 }} {{ $role->name }}
            </option>
        @endforeach
    </select>
    @error('role_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>



        <button type="submit" class="btn btn-primary mt-3">Actualizar Staff</button>
    </form>
</div>
@endsection
