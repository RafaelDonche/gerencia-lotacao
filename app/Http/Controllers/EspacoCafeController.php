<?php

namespace App\Http\Controllers;

use App\Models\EspacoCafe;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EspacoCafeController extends Controller
{

    public function index()
    {
        try {

            return view('scr.espacoCafes');

        } catch (\Exception $ex) {
            return Alert::error('Erro!', $ex->getMessage());
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, EspacoCafe $espacoCafe)
    {
        //
    }

    public function destroy(EspacoCafe $espacoCafe)
    {
        //
    }
}
