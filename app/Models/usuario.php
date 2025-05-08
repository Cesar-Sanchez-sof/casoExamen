<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    // Nombre de la tabla si no sigue la convención (opcional si se llama "usuarios")
    protected $table = 'usuario';

    // Clave primaria
    protected $primaryKey = 'id_usuario';

    // Laravel no usa timestamps por defecto (created_at y updated_at)
    public $timestamps = false;

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'apellido',
        'userName',
        'correo',
        'contrasena',
        'create_count',
        'telefono',
    ];

    // Para definir qué campo se usará como contraseña
    protected $hidden = [
        'contrasena',
    ];

    // Si deseas que el campo 'contrasena' se use para login en lugar de 'password'
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}
