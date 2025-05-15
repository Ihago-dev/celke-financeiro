<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituacaoConta extends Model
{
    use HasFactory;

    // Indicar qual é a tabela no banco de dados
    protected $table = 'situacoes_contas';

    // Indicar quais são as colunas podem ser cadastradas
    protected $fillable = [
        'nome',
        'cor',
    ];
}