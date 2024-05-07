<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\View\View;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    public function index($id): View
    {
        $entity = Entity::find($id);
        return view('profile/entity/entity', ['entity' => $entity]);
    }

    public function rapport($id): View
    {
        $entity = Entity::find($id);
        return view('profile/entity/rapport', ['entity' => $entity]);
    }
}
