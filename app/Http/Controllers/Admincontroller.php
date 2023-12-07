<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Admincontroller extends Controller
{
    // mostrar la vista de iniciar session
    public function showlogin()
    {
        return view('login');
    }

    // abrir la session como administrador
    public function login(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');

        // Busca al usuario por su email
        $user = Admin::where('correo', $email)->first();

        // Si se encontró un usuario y la contraseña es correcta
        if ($user && password_verify($password, $user->contrasena)) {
            // Autenticar al usuario
            Auth::login($user);

            // Regenerar la sesión para evitar ataques de sesión fija
            $request->session()->regenerate();

            // Redirigir a la página de inicio
            return redirect()->intended('/mostrarViajes');
        }

        // Si no se encontró un usuario o la contraseña es incorrecta, mostrar un error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    // cerrar la session
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }





}
