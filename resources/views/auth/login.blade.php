@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Iniciar Sesión</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Correo" class="form-control mb-3" required>
        <input type="password" name="password" placeholder="Contraseña" class="form-control mb-3" required>
        <button class="btn btn-success w-100 mb-3">
            <i class="fas fa-sign-in-alt"></i> Ingresar
        </button>
    </form>

    <div class="text-center">
        <a href="{{ route('register.form') }}" class="btn btn-link">
            <i class="fas fa-user-plus"></i> Registrar nuevo usuario
        </a>
    </div>
</div>
@endsection
