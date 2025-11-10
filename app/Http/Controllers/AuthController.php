<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    // 🔹 Mostrar formulario de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // 🔹 Iniciar sesión
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('book.index');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // 🔹 Mostrar formulario de registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // 🔹 Registrar nuevo usuario
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.form')->with('success', 'Usuario creado exitosamente. Inicia sesión.');
    }

    // 🔹 Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.form');
    }

    // 🔹 Mostrar formulario de actualizar contraseña
    // Mostrar formulario para actualizar contraseña
public function showUpdatePasswordForm()
{
    return view('auth.update-password');
}

// Procesar la actualización de contraseña
public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
    }

    $user->update([
        'password' => Hash::make($request->new_password),
    ]);

    return redirect()->route('book.index')->with('success', 'Contraseña actualizada correctamente.');
}
}
