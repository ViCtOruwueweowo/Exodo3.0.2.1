@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Crear Nuevo Idioma</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('languages.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Idioma:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Crear Idioma</button>
    </form>
</div>
@endsection
