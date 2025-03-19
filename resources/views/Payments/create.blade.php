@extends('layouts.app')

@section('content')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">
        <h1>Agregar Nuevo Pago</h1>

        <!-- Formulario para agregar un nuevo pago -->
        <form action="{{ route('Payment.store') }}" method="POST">
            @csrf <!-- Asegura que el token CSRF se incluya en el formulario -->

            <!-- Selección de Cliente -->
            <div class="form-group">
                <label for="customer_id">Cliente:</label>
                <select name="customer_id" id="customer_id" class="form-control" required>
                    <option value="">Seleccione un cliente</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->customer_id }}" {{ old('customer_id') == $customer->customer_id ? 'selected' : '' }}>
                        {{ $customer->customer_id}} {{ $customer->first_name}} {{ $customer->last_name}} <!-- Asume que 'name' es el campo en el modelo 'Customer' -->
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Selección de Empleado -->
            <div class="form-group mt-3">
                <label for="staff_id">Empleado:</label>
                <select name="staff_id" id="staff_id" class="form-control" required>
                    <option value="">Seleccione un empleado</option>
                    @foreach($staff as $staffMember)
                        <option value="{{ $staffMember->staff_id }}" {{ old('staff_id') == $staffMember->staff_id ? 'selected' : '' }}>
                            {{ $staffMember->staff_id }} {{ $staffMember->first_name }} {{ $staffMember->last_name }}<!-- Asume que 'name' es el campo en el modelo 'Staff' -->
                        </option>
                    @endforeach
                </select>
                @error('staff_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Selección de Alquiler -->
            <div class="form-group mt-3">
                <label for="rental_id">Alquiler:</label>
                <select name="rental_id" id="rental_id" class="form-control">
                    <option value="">Seleccione un alquiler (opcional)</option>
                    @foreach($rentals as $rental)
                        <option value="{{ $rental->rental_id }}" {{ old('rental_id') == $rental->rental_id ? 'selected' : '' }}>
                            Numero:{{ $rental->rental_id}} Fecha:{{ $rental->rental_date}}
                        </option>
                    @endforeach
                </select>
                @error('rental_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Monto del Pago -->
            <div class="form-group mt-3">
                <label for="amount">Monto:</label>
                <input type="number" name="amount" id="amount" class="form-control" step="0.01" required value="{{ old('amount') }}">
                @error('amount')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success mt-3">Guardar Pago</button>
        </form>
    </div>
    <a href="{{ route('Payments.show') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
@endsection