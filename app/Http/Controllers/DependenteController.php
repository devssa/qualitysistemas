<?php

namespace App\Http\Controllers;

use App\Http\Resources\DependenteResource;
use App\Http\Resources\DependentesResource;
use App\Models\CadastroDependente;
use App\Models\CadastroPessoa;
use Illuminate\Http\Request;

class DependenteController extends Controller
{

    public function getAll($id)
    {
        return DependentesResource::collection(CadastroDependente::where('pessoa_id', '=', $id)->get());
    }

    public function store(Request $request)
    {
        $dependente = new CadastroDependente([
            'nome' => $request->nome,
            'data_nascimento' => dateToUS($request->data_nascimento)
        ]);
        $pessoa = CadastroPessoa::findOrFail($request->id);

        $pessoa->dependentes()->save($dependente);

        return new DependenteResource(CadastroDependente::where('id','=',$dependente->id)->first());
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CadastroDependente $id)
    {
        $id->delete();

        return response()->json(null, 204);
    }
}
