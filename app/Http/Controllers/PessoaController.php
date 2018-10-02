<?php

namespace App\Http\Controllers;


use App\Http\Requests\ImageRequest;
use App\Http\Requests\UpdatePessoaRequest;
use App\Rules\AgeRule;
use Storage;
use App\Models\CadastroPessoa;
use Illuminate\Http\Request;
use App\Http\Resources\PessoaResource;

class PessoaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return PessoaResource::collection(CadastroPessoa::with('dependentes')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PessoaResource
     */
    public function store(Request $request)
    {
        $pessoa = CadastroPessoa::create([
            'nome' => $request->nome,
            'data_nascimento' => dateToUS($request->data_nascimento),
            'email' => $request->email
        ]);
        return new PessoaResource($pessoa);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new PessoaResource(CadastroPessoa::with( 'dependentes')->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePessoaRequest $request, $id)
    {
        $pessoa = CadastroPessoa::find($id);
        $dataNascimento = dateToUS($request->data_nascimento);
        $request->merge(['data_nascimento' => $dataNascimento]);
        $pessoa->update($request->only(['nome', 'data_nascimento', 'email']));
        return new PessoaResource($pessoa);

    }

    public function uploadImage(ImageRequest $request, $id)
    {
        $pessoa = CadastroPessoa::findOrFail($id);
        if ($pessoa->foto) {
            if (!validateURL($pessoa->foto)) {
                Storage::disk('public')->delete($pessoa->foto);
            }
        }

        if ($fileName = Storage::disk('public')->putFile('photos', $request->file('foto'))) {
            $pessoa->foto = $fileName;
            $pessoa->save();
            return new PessoaResource($pessoa);
        } else {
            return response()->json(['error' => true, 'message' => 'Upload file error!'], 422);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pessoa = CadastroPessoa::find($id);

        if(Storage::disk('public')->delete($pessoa->foto)) {
            $pessoa->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(['error' => true, 'message' => 'Ocorreu um error a deletar o arquivo!'], 500);
        }



    }
}
