<?php

namespace App\Http\Controllers;

use App\Models\participation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParticipationController extends Controller
{
    public function participer($formation_id, $apprenant_id): JsonResponse
    {
        //verifier si appurtenant a deja participé
        $is_participed = db::table('participations')
            ->where('formation_id', '=',$formation_id)
            ->where('apprenant_id', '=', $apprenant_id)
            ->exists();

        if(!$is_participed){
            $participation = new Participation();
            $participation->formation_id = $formation_id;
            $participation->apprenant_id = $apprenant_id;
            $participation->save();
            $message = "L'apprenant a participé à la formation avec succès";
        }else{
            $message = "L'apprenant a déjà participé à la formation";
        }

        $reponse = [
            'message' => $message
        ];

        return response()->json($reponse, 201, [], JSON_UNESCAPED_UNICODE);

    }

    public function annuler($formation_id, $apprenant_id): JsonResponse
    {
        //verifier si appurtenant a deja participé
        $is_participed = db::table('participations')
            ->where('formation_id', '=',$formation_id)
            ->where('apprenant_id', '=', $apprenant_id)
            ->exists();

        if($is_participed){
            $participation = Participation::where('formation_id', $formation_id)
                ->where('apprenant_id', $apprenant_id)
                ->first();
            $participation->delete();
            $message = "Vous avez annulé la participation à la formation avec succès";
        }else{
            $message = "L'apprenant n'a pas participé à la formation";
        }

        $reponse = [
            'message' => $message
        ];

        return response()->json($reponse, 201, [], JSON_UNESCAPED_UNICODE);

    }
}
