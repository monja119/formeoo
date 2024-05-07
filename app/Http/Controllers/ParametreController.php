<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParametreController extends Controller
{
    public function all()
    {
        return view('parametres/index');
    }
}
