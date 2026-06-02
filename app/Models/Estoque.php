<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $table = 'estoques';

    protected $primaryKey = 'id_estoque';

    protected $fillable = [
        'id_produto',
        'quantidade_atual',
        'tipo_movimentacao',
        'quantidade_movimentacao',
        'data_movimentacao',
    ];

    public $timestamps = true;

    // Relacionamento N:1
    // Um registro de estoque pertence a um produto
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto', 'id_produto');
    }
}