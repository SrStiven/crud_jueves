@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h2>Registro</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" placeholder="Nombre" class="form-control mb-2" required>
        <input type="email" name="email" placeholder="Correo" class="form-control mb-2" required>
        <input type="password" name="password" placeholder="Contraseña" class="form-control mb-2" required>
        <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" class="form-control mb-3" required>
        <button class="btn btn-primary w-100">Registrarse</button>
    </form>
</div>
@endsection
