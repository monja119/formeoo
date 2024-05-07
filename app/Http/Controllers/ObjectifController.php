<?php

namespace App\Http\Controllers;

use App\Models\Objectif;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ObjectifController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $items = $request->input('items');
        $module_id = $request->input('module_id');

        foreach ($items as $item) {
            $objectif = new Objectif();
            $objectif->module_id = $module_id;
            $objectif->objectif = $item;

            // return response()->json(['error' => $competence], 400);
            $objectif->save();
        }


        $response = [
            'message' => 'Compétences créées avec succès',
            'competences' => $items
        ];

        // returning json response utf-8
        return response()->json($response, 201, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }
}
