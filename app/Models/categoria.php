<?php

// app/Models/Categoria.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'categoria_id'; // 👈 Especifica la clave primaria
    public $timestamps = false;

    protected $fillable = ['nombre'];

    public function deudas()
    {
        return $this->hasMany(Deuda::class, 'categoria_id');
    }
}
