@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Crear Nuevo Continente</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('countries.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="first_name">Continente:</label>
            <input type="text" name="country" id="country" class="form-control" value="{{ old('country') }}" required>
            @error('country')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Crear Continente</button>
    </form>
</div>
@endsection
