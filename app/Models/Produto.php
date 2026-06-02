<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'id_produto';

    protected $fillable =[
        'id_usuario','nome', 'codigo','fabricante_fornecedor','preco', 'localizacao','numero_serie', 'compatibilidade_robo','vida_util_hr','estoque_minimo',
    ];

    // Método booted: executa ações automáticas em eventos da Model
    protected static function booted()
{
    static::created(function ($produto) {
        $produto->estoque()->create([
            'quantidade_atual' => 0,
        ]);
    });
}
     // Relacionamento N:1
    // Produto pertence a um usuário
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    // Relacionamento 1:1
    // Produto tem um estoque
    public function estoque()
    {
        return $this->hasOne(Estoque::class, 'id_produto');
    }
}
