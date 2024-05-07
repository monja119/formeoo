<?php

namespace App\Http\Controllers;

use App\Models\Prerequis;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrerequisController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $items = $request->input('items');
        $module_id = $request->input('module_id');

        foreach ($items as $item) {
            $prerequis = new Prerequis();
            $prerequis->module_id = $module_id;
            $prerequis->prerequis = $item;

            // return response()->json(['error' => $prerequis], 400);
            $prerequis->save();
        }

        $response = [
            'message' => 'Prérequis créés avec succès',
            'prerequis' => $items
        ];

        // returning json response utf-8
        return response()->json($response, 201, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

}
