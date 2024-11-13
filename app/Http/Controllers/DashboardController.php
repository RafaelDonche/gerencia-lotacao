<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        try {

            return view('scr.dashboard');

        } catch (\Exception $ex) {
            return Alert::error('Erro!', $ex->getMessage());
        }
    }
}
