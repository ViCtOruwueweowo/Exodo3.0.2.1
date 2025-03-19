@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Crear Nuevo Renta</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('rentals.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="rental_date">Fecha de Renta:</label>
            <input type="datetime-local" name="rental_date" id="rental_date" class="form-control" value="{{ old('rental_date') }}" required>
            @error('rental_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inventory_id">Inventario:</label>
            <select name="inventory_id" id="inventory_id" class="form-control" required>
                <option value="">Seleccione un inventario</option>
                @foreach($inventories as $inventory)
                    <option value="{{ $inventory->inventory_id }}" {{ old('inventory_id') == $inventory->inventory_id ? 'selected' : '' }}>
                        {{ $inventory->inventory_id }}
                    </option>
                @endforeach
            </select>
            @error('inventory_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="customer_id">Cliente:</label>
            <select name="customer_id" id="customer_id" class="form-control" required>
                <option value="">Seleccione un cliente</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->customer_id }}" {{ old('customer_id') == $customer->customer_id ? 'selected' : '' }}>
                        {{ $customer->first_name }} {{ $customer->last_name }}
                    </option>
                @endforeach
            </select>
            @error('customer_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="return_date">Fecha de Devolución:</label>
            <input type="datetime-local" name="return_date" id="return_date" class="form-control" value="{{ old('return_date') }}">
            @error('return_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="staff_id">Empleado:</label>
            <select name="staff_id" id="staff_id" class="form-control" required>
                <option value="">Seleccione un empleado</option>
                @foreach($staffs as $staff)
                    <option value="{{ $staff->staff_id }}" {{ old('staff_id') == $staff->staff_id ? 'selected' : '' }}>
                        {{ $staff->full_name }}
                    </option>
                @endforeach
            </select>
            @error('staff_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Crear Staff</button>
    </form>
</div>
@endsection