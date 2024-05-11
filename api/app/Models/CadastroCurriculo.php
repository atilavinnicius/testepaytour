<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroCurriculo extends Model
{
    use HasFactory;

    protected $table = 'cadastro_curriculos';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cargoDesejado',
        'escolaridade',
        'dataEnvio',
        'horaEnvio',
        'observacoes',
        'ipCliente',
        'caminhoArquivo',
    ];

}
