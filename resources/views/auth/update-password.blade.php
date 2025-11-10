@extends('layouts.app')

@section('title', 'Actualizar Contraseña')

@section('content')
<div class="container mt-4">
    <h2>Actualizar Contraseña</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="current_password" class="form-label">Contraseña Actual</label>
            <input type="password" name="current_password" id="current_password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label">Nueva Contraseña</label>
            <input type="password" name="new_password" id="new_password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
        <a href="{{ route('book.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
