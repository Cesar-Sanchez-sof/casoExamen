@extends('layout.plantilla')

@section('title', 'Deudas Pagadas')

@section('css')
    <link rel="stylesheet" href="/recursos/css/home.css">
@endsection

@section('contenido')

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="deudas-container">
            <!-- Encabezado -->
            <div class="deudas-header">
                <h1 style="color: white"> Mis Deudas</h1>
            </div>
            <div class="deudas-table-container">
                <table class="deudas-table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Monto</th>
                            <th>Fecha de Vencimiento</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deuda as $deu)
                            <tr>
                                <td>{{ $deu->titulo }}</td>
                                <td><span class="categoria-badge servicios">{{ $deu->categoria->nombre ?? 'Sin categoría' }}
                                </td>
                                <td class="monto">S/ {{ number_format($deu->monto, 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($deu->fecha_vencimiento)->format('d/m/Y') }}</td>
                                <td>Pagada
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
