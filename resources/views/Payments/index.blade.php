@extends('layouts.app')

@section('content')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @php
        $role_id = request()->cookie('role_id');
    @endphp

    <div class="container mt-1">
        <h1>Lista de Pagos</h1>
        @if(in_array($role_id, [1, 2]))

        <a href="{{ route('Payment.create') }}" class="btn btn-primary mb-3">Agregar Pago</a>
        @endif

        <div class="card">
        <div class="card-body">
            <!-- Contenedor con desplazamiento vertical -->
        <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
        <!-- Mostrar los pagos en una tabla -->
        <table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>ID de Pago</th>
            <th>Cliente</th>
            <th>Empleado</th>
            <th>Alquiler</th>
            <th>Monto</th>
            <th>Fecha de Pago</th>
            <th>Última Actualización</th>
            @if(in_array($role_id, [1, 2]))
            <th>Opciones</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->payment_id }}</td>
                <td>{{ $payment->customer->first_name }} {{ $payment->customer->last_name  }}</td>
                <td>{{ $payment->staff->first_name }} {{ $payment->staff->last_name }}</td>
                <td>{{ $payment->rental ? $payment->rental->rental_date : 'N/A' }}</td>
                <td>{{ $payment->amount }}</td>
                <td>{{ $payment->payment_date }}</td>
                <td>{{ $payment->last_update }}</td>
                @if(in_array($role_id, [1, 2]))
                <td>
                    <!-- Botones de acción (editar, eliminar) -->
                    <a href="{{ route('Payment.edit', $payment->payment_id) }}" class="btn btn-warning btn-sm">Editar</a><br><br>
                    <form action="{{ route('Payment.destroy', $payment->payment_id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Paginación -->
<div class="d-flex justify-content-center">
    {{ $payments->links() }}
    </div>
            </div>
        </div>
    </div>  
</div>

@endsection