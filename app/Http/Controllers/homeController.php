<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use App\Models\Deuda;
use Carbon\Carbon;
use DateTime;

class homeController extends Controller
{
    //
    //Validar autenticación
    public function __construct()
    {
        $this->middleware('auth'); // Aplicar el middleware de autenticación
    }

    public function index(Request $request)
    {

        $usuarioId = Auth::id(); // obtiene el ID del usuario autenticado

        $buscarpor = $request->get('buscarpor');

        // Traer todas las deudas del usuario, con su categoría
        $deudas = Categoria::join('deudas', 'deudas.categoria_id', 'categorias.categoria_id')
            ->where('usuario_id', $usuarioId)
            ->where('deudas.estado_deuda', 0)
            ->orderBy('fecha_vencimiento', 'asc')
            ->where(function ($query) use ($buscarpor) {
                $query->where('categorias.nombre', 'like', '%' . $buscarpor . '%');
            })
            ->get();


        return view('home', compact('buscarpor', 'deudas'));
    }

    public function pagos()
    {
        $usuarioId = Auth::id(); // obtiene el ID del usuario autenticado
        $deuda = Deuda::join('categorias', 'deudas.categoria_id', 'categorias.categoria_id')
            ->where('usuario_id', $usuarioId)
            ->where('deudas.estado_deuda', 1)
            ->orderBy('fecha_vencimiento', 'asc')
            ->get();
        return view('pagos', compact('deuda'));
    }

    public function deudas()
    {
        $categoria = Categoria::all();
        return view('deudas', compact('categoria'));
    }

    // En HomeController.php
    public function registarDeuda(Request $request)
    {
        // Validación básica para verificar que los datos llegan
        $request->validate([
            'titulo' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0',
            'fecha_vencimiento' => 'required|date',
            'categoria_id' => 'required|exists:categorias,categoria_id'
        ]);

        $usuarioId = Auth::id(); // obtiene el ID del usuario autenticado

        $deuda = new deuda();
        $deuda->usuario_id = $usuarioId;
        $deuda->categoria_id = $request->categoria_id;
        $deuda->titulo = $request->titulo;
        $deuda->descripcion = $request->descripcion;
        $deuda->monto = $request->monto;
        $deuda->fecha_vencimiento = $request->fecha_vencimiento;
        $deuda->estado_deuda = 0;
        $deuda->creado_en = (new DateTime())->format("Y-m-d H:i:s"); // Fecha y hora actual
        $deuda->save();


        return redirect()->route('deudas');
    }

    public function pagarDeuda(Request $request)
    {
        $estadoDeuda = $request->input('estado_deuda');

        // Aquí puedes actualizar la deuda en tu base de datos, por ejemplo:
        Deuda::where('deuda_id', $request->input('id_deuda'))->update(['estado_deuda' => $estadoDeuda]);

        return redirect()->back()->with('mensaje', 'Deuda pagada correctamente');
    }

    
}
