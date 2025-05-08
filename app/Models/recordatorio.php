<?php

// app/Models/Recordatorio.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recordatorio extends Model
{
    protected $table = 'recordatorios';
    protected $primaryKey = 'id'; // 👈 Especifica la clave primaria
    public $timestamps = false;

    protected $fillable = [
        'deuda_id',
        'fecha_recordar',
        'enviado',
        'creado_en'
    ];

    public function deuda()
    {
        return $this->belongsTo(Deuda::class, 'deuda_id');
    }
    
}
