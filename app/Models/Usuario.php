<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{   // cria a tabela e a primary Key
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
   // identifica os campos da tabela
    protected $fillable=[
        'nome', 'login', 'tipo_usuario'
    ];

    // relacionamento 1:N
    public function usuarios(){
        return $this->hasMany(Usuario::class, 'id_usuario');
    }
}
