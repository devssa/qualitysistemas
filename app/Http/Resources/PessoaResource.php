<?php

namespace App\Http\Resources;

use Storage;
use Illuminate\Http\Resources\Json\Resource;

class PessoaResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'data_nascimento' => dateToBR($this->data_nascimento),
            'email' => $this->email,
            'foto' => $this->foto,
            'is_active' => $this->is_active
        ];
    }
}
