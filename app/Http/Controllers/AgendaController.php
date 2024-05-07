<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function all()
    {
        return view('agenda/index');
    }
}
