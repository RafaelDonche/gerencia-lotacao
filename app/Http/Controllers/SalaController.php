<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalaEtapa1FormRequest;
use App\Models\Sala;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SalaController extends Controller
{
    public function index()
    {
        try {

            $salas = Sala::get();

            return view('scr.salas', compact('salas'));

        } catch (\Exception $ex) {
            return Alert::error('Erro!', $ex->getMessage());
        }
    }

    public function store(SalaEtapa1FormRequest $request)
    {
        try {

            Sala::create($request->validated());

            Alert::toast('Cadastro realizado com sucesso!', 'success');
            return redirect()->back();

        } catch (\Exception $ex) {
            return Alert::error('Erro!', $ex->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request, $id)
    {
        //
    }
}
