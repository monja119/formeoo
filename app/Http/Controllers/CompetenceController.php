<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $items = $request->input('items');
        $module_id = $request->input('module_id');

        foreach ($items as $item) {
            $competence = new Competence();
            $competence->module_id = $module_id;
            $competence->competence = $item;

            // return response()->json(['error' => $competence], 400);
            $competence->save();
        }

        $response = [
            'message' => 'Compétences créées avec succès',
            'competences' => $items
        ];

        // returning json response utf-8
        return response()->json($response, 201, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }
}
