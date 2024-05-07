<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RechercherController extends Controller
{
    public function all()
    {
        return view('rechercher/index');
    }
}
