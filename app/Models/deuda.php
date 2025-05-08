<?php

// app/Models/Deuda.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deuda extends Model
{
    protected $table = 'deudas';
    protected $primaryKey = 'deuda_id'; // 👈 Especifica la clave primaria
    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'categoria_id',
        'titulo',
        'descripcion',
        'monto',
        'fecha_vencimiento',
        'estado_deuda',
        'creado_en',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function recordatorios()
    {
        return $this->hasMany(Recordatorio::class, 'deuda_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }
}
