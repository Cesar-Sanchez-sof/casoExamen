<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class authController extends Controller
{
    //
    public function showLogin(Request $request)
    {
        return view('welcome');
    }

    public function login(Request $request)
    {
        
    // Validar los campos
    $credentials = $request->validate([
        'usuario' => 'required|string',
        'password' => 'required|string'
    ]);

    // Intentar autenticar al usuario usando 'userName' como nombre de usuario
    if (Auth::attempt(['userName' => $credentials['usuario'], 'password' => $credentials['password']])) {

        // Obtener al usuario autenticado
        $usuario = Auth::user();

        // Redirigir si todo está correcto
        return redirect()->route('principal');
    }

    // Si la autenticación falla
    $usuario = Usuario::where('userName', $credentials['usuario'])->first();
    
    if (!$usuario) {
        return redirect()->back()->withErrors([
            'usuario' => 'El usuario no existe.'
        ]);
    } else {
        return redirect()->back()->withErrors([
            'password' => 'La contraseña ingresada es incorrecta.'
        ]);
    }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
