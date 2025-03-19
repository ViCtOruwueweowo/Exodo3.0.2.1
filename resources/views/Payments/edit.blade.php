@extends('layouts.app')

@section('content')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="container mt-5">
        <h1>Editar Pago</h1>
        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver a la lista</a><br><br>

        <!-- Formulario para editar el pago -->
        <form action="{{ route('Payment.update', $payment->payment_id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Indica que esta es una solicitud PUT para la actualización -->

            <div class="form-group">
                <label for="customer_id">Cliente:</label>
                <select name="customer_id" id="customer_id" class="form-control" required>
                    <option value="">Seleccione un cliente</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->customer_id }}" 
                            {{ old('customer_id', $payment->customer_id) == $customer->customer_id ? 'selected' : '' }}>
                            {{ $customer->first_name }} {{ $customer->last_name }}
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="staff_id">Empleado:</label>
                <select name="staff_id" id="staff_id" class="form-control" required>
                    <option value="">Seleccione un empleado</option>
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->staff_id }}" 
                            {{ old('staff_id', $payment->staff_id) == $staff->staff_id ? 'selected' : '' }}>
                            {{ $staff->first_name }} {{ $staff->last_name }}
                        </option>
                    @endforeach
                </select>
                @error('staff_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="rental_id">Alquiler:</label>
                <select name="rental_id" id="rental_id" class="form-control">
                    <option value="">Seleccione un alquiler</option>
                    @foreach($rentals as $rental)
                        <option value="{{ $rental->rental_id }}" 
                            {{ old('rental_id', $payment->rental_id) == $rental->rental_id ? 'selected' : '' }}>
                            {{ $rental->rental_id }} <!-- Cambia esto por la descripción adecuada -->
                        </option>
                    @endforeach
                </select>
                @error('rental_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="amount">Monto:</label>
                <input type="number" step="0.01" name="amount" id="amount" class="form-control" 
                       value="{{ old('amount', $payment->amount) }}" required>
                @error('amount')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="payment_date">Fecha de pago:</label>
                <input type="datetime-local" name="payment_date" id="payment_date" class="form-control" 
                       value="{{ old('payment_date', $payment->payment_date) }}" required>
                @error('payment_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-4">Actualizar Pago</button>
        </form>
    </div>

@endsection  