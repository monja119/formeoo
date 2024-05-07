<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalculController extends Controller
{
    public function frequentationSessionByModule($module_id): JsonResponse
    {
        // getting all sessions for formation
        $formations = db::table('formations')
            ->where('module_id', '=', $module_id)
            ->select('formations.id', 'formations.date', 'formations.module_id')
            ->get();

        // getting total inscription for formation
        $total_inscription = db::table('inscription_modules')
            ->where('module_id', '=', $module_id)
            ->count();

        // getting all participants for each session
        $participants = [];
        $date = [];
        foreach ($formations as $formation) {
            $date[] = $formation->date;
            $participants[] = db::table('participations')
                ->where('participations.formation_id', '=', $formation->id)
                ->count();
        }

        $participants [] = $total_inscription ;

        $reponse = [
            'date' => $date,
            'participants' => $participants,
            'total_inscription' => $total_inscription,
        ];
        return response()->json($reponse, 201, [], JSON_UNESCAPED_UNICODE);
    }
}
