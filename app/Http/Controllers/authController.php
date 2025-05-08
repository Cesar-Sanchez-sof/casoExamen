<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Carbon\Carbon;

class authController extends Controller
{
    //
    public function showLogin(Request $request)
    {
        return view('welcome');
    }

    public function register(){
        return view('register');
    }

    public function registeUser(Request $request){
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'userName' => 'required',
            'contrasena' => 'required',
            'confirmacion_contrasena' => 'required|same:contrasena',
            'correo' => 'required|email',
            'telefono' => 'required',
        ], [
            'nombre' => 'El nombre es obligatorio.',
            'apellidos' => 'El apellido es obligatorio.',
            'userName' => 'El usuario es obligatorio.',
            'contrasena' => 'La contraseña es obligatoria.',
            'confirmacion_contrasena' => 'Las contraseñas no coinciden.',
            'correo' => 'El correo debe ser una dirección de correo válida.',
            'telefono' => 'El telefono es obligatoria por cada usuario.',
        ]);

        $usuario = new usuario();
        $usuario->nombre= $request->nombre;
        $usuario->apellido= $request->apellidos;
        $usuario->userName= $request->userName;
        $usuario->correo= $request->correo;
        $usuario->telefono= $request->telefono;
        $usuario->contrasena = Hash::make($request->contrasena);
        $usuario->create_count = Carbon::today()->toDateString(); // "Y-m-d"
        $usuario->save();

        return redirect()->route('register');
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
