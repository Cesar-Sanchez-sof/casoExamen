@extends('layout.plantilla')

@section('title', 'Registrar')

@section('css')
    <link rel="stylesheet" href="/recursos/css/deudas.css">
@endsection

@section('contenido')
    <div class="deuda-form-container">
        <h2 class="form-title">Registro de Nueva Deuda</h2>

        <form method="POST" action="{{ route('registarDeuda') }}" id="form-crear-deuda" class="deuda-form">
            @csrf
            <div class="form-group">
                <label for="titulo">Título*</label>
                <input type="text" id="titulo" name="titulo" class="form-control" maxlength="255" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="monto">Monto*</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span style="color: black" class="input-group-text">$</span>
                        </div>
                        <input type="number" id="monto" name="monto" class="form-control" step="0.01"
                            min="0" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="fecha_vencimiento">Fecha de Vencimiento*</label>
                    <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="categoria_id">Categoría*</label>
                    <select id="categoria_id" name="categoria_id" class="form-control" required>
                        <option value="" disabled selected>Seleccione una categoría</option>
                        @foreach ($categoria as $item)
                            <option value="{{ $item->categoria_id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Guardar Deuda</button>
            </div>
        </form>
    </div>
@endsection
