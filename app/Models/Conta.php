<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    // Indicar qual é a tabela no banco de dados
    protected $table = 'contas';

    // Indicar quais são as colunas podem ser cadastradas
    protected $fillable = [
        'nome',
        'valor',
        'vencimento',
        'situacao_conta_id'
    ];

    public function situacaoConta(){
        return $this->belongsTo(SituacaoConta::class);
    }

}