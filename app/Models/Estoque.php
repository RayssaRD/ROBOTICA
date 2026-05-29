<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $table = 'estoques';
    protected $primaryKey = 'id_estoque';

    protected $fillable= [
        'id_produto','quantidade_atual', 'tipo_movimentacao','data_movimentacao'
    ];

     
        
    
      
    
      
        // Relacionamento 1:1
        // Estoque pertence a um Produto
    public function estoque()
        {
            return $this->hasOne(Estoque::class, 'id_produto');
        }
}
