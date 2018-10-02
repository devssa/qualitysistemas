<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CadastroPessoa extends Model
{

    protected $table = 'cadastro_pessoas';

    protected $fillable = ['nome', 'data_nascimento', 'email', 'foto', 'is_active'];

    public function dependentes()
    {
        return $this->hasMany(CadastroDependente::class, 'pessoa_id', 'id');
    }
}
