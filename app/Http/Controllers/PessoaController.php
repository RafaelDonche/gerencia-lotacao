<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PessoaController extends Controller
{
    public function index()
    {
        try {

            return view('scr.pessoas');

        } catch (\Exception $ex) {
            return Alert::error('Erro!', $ex->getMessage());
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Pessoa $pessoa)
    {
        //
    }

    public function destroy(Pessoa $pessoa)
    {
        //
    }
}
