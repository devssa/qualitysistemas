<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class DependentesResource extends Resource
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
            'pessoa_id' => $this->pessoa_id
        ];
    }
}
