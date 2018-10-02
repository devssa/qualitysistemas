<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CadastroDependente extends Model
{
    protected $table = 'cadastro_dependentes';

    protected $fillable = ['pessoa_id', 'nome', 'data_nascimento'];

    public function pessoa()
    {
        return $this->belongsTo(\CadastroPessoas::class, 'pessoa_id', 'id');
    }
}
