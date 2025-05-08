@extends('layout.plantilla')

@section('title', 'Home')

@section('css')
    <link rel="stylesheet" href="/recursos/css/home.css">
@endsection

@section('contenido')
    <div class="deudas-container">
        <!-- Encabezado -->
        <div class="deudas-header">
            <h1 style="color: white"> Mis Deudas</h1>

            <!-- Barra de búsqueda mejorada -->
            <div class="search-bar">
                <form method="GET" class="search-form">
                    <div class="search-box">
                        <input type="text" name="buscarpor" placeholder="Buscar deudas por categoría..."
                            value="{{ $buscarpor }}" aria-label="Buscar por categoría">
                        <button type="submit" class="search-btn">Buscar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de deudas -->
        <div class="deudas-table-container">
            <table class="deudas-table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Monto</th>
                        <th>Vencimiento</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deudas as $deuda)
                        <tr>
                            <td>{{ $deuda->titulo }}</td>
                            <td>{{ $deuda->descripcion }}</td>
                            <td><span class="categoria-badge servicios">{{ $deuda->nombre ?? 'Sin categoría' }}
                            </td>
                            <td class="monto">S/ {{ number_format($deuda->monto, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($deuda->fecha_vencimiento)->format('d/m/Y') }}</td>
                            <td><span class="estado-badge pendiente">
                                    @if ($deuda->estado_deuda)
                                        <span class="badge bg-success">Pagada</span>
                                    @else
                                        <span class="badge bg-danger">Pendiente</span>
                                    @endif
                            </td>
                            <td>
                                <!--Aqui va el boton-->
                                <button class="pagar-btn"
                                    onclick="window.location='{{ route('pagarDeuda', ['estado_deuda' => 1, 'id_deuda' => $deuda->deuda_id]) }}'">Pagar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
