<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use App\Models\InscriptionModule;
use App\Models\Module;
use App\Models\Objectif;
use App\Models\Prerequis;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ModuleController extends Controller
{
    public function index(): View
    {
        $modules = Module::all()->reverse();
        return view('modules/index', ['modules' => $modules]);
    }

    public function create(): View
    {
        return view('modules/create');
    }

    public function all(): View
    {
        $modules = Module::all();
        return view('modules/all', ['modules' => $modules]);
    }

    public function show($id): View
    {
        $module = Module::find($id);
        $objectifs = Objectif::where('module_id', $id)->get();
        $competeces = Competence::where('module_id', $id)->get();
        $prerequis = Prerequis::where('module_id', $id)->get();
        $is_signed = db::table('inscription_modules')
            ->where('module_id', '=',$module->id)
            ->where('apprenant_id', '=', session()->get('user')->id)
            ->exists();

        $apprenant_count = db::table('inscription_modules')
            ->where('module_id', '=',$module->id)
            ->count('apprenant_id');

        return view('modules/show', [
            'module' => $module,
            'objectifs' => $objectifs,
            'competences' => $competeces,
            'prerequis' => $prerequis,
            'is_signed' => $is_signed,
            'apprenant_count' => $apprenant_count
        ]);
    }

    public function getByTitre(Request $request): JsonResponse
    {
        $titre = $request->input('titre');

        $modules = DB::table('modules')->where('titre', 'like', '%'.$titre.'%')->get()->reverse()->take(5);

        return response()->json($modules, 201, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);

    }

    public function createModule(Request $request): JsonResponse
    {
        $titre = $request->input('titre');
        $description = $request->input('description');

        // Validation des données si nécessaire
        $validator = Validator::make($request->all(), [
            'titre' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Création du module
        $module = new Module();
        $module->titre = $titre;
        $module->description = $description;
        $module->save();

        // envoi des notifications aux apprenants
        $users = DB::table('users')->where('role', '=', 'apprenant')->get();
        foreach ($users as $user) {
            $notification = new NotificationController();
            $notification->create(
                'module',
                'Un nouveau module est disponible : ' . $titre,
                '/module/'.$module->id,
                date('Y-m-d'),
                date('H:i:s'),
                'non lu',
                $user->id
            );
        }

        $response = [
            'message' => 'Module créé avec succès',
            'module' => [
                'id' => $module->id,
                'titre' => $titre,
                'description' => $description,
            ]
        ];

        // returning json response utf-8
        return response()->json($response, 201, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }


    public function inscription ($module_id, $apprenant_id): JsonResponse
    {

        // verifying if apprenant id is already in table
        $is_already = db::table('inscription_modules')
            ->where('apprenant_id', '=', $apprenant_id)
            ->where('module_id', '=', $module_id)
            ->exists();

        if(!$is_already) {
            $inscription_module = new InscriptionModule();
            $inscription_module->module_id = $module_id;
            $inscription_module->apprenant_id = $apprenant_id;
            $inscription_module->save();

            $message = 'Vous êtes inscrits sur le module ' . $module_id;

            // envoi des notifications au admin
            $admin = DB::table('users')->where('role', '=', 'admin')->get()->first();
            $module = DB::table('modules')->where('id', '=', $module_id)->get()->first();
            $user = DB::table('users')->where('id', '=', $apprenant_id)->get()->first();
            $notification = new NotificationController();
            $notification->create(
                'module',
                'L\'apprenant ' . $user->first_name . ' ' . $user->last_name . ' s\'est inscrit sur le module ' . $module->titre,
                '/module/'.$module_id,
                date('Y-m-d'),
                date('H:i:s'),
                'non lu',
                $admin->id
            );


        }
        else
        {
            $message = 'Vous y êtes déja inscrit sur le module' . $module_id;
        }
        $response = [
            'message' => $message,
            'is there' => $is_already
        ];
        return response()->json($response, 201, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

    public function quitter ($module_id, $apprenant_id): JsonResponse
    {

        // verifying if apprenant id is already in table
        $is_already = db::table('inscription_modules')
            ->where('apprenant_id', '=', $apprenant_id)
            ->where('module_id', '=', $module_id)
            ->exists();

        if(!$is_already) {
            $message = "vous n'êtes pas inscrit sur le module " . $module_id;
        }
        else
        {
            $is_already = db::table('inscription_modules')
                ->where('apprenant_id', '=', $apprenant_id)
                ->where('module_id', '=', $module_id)
                ->delete();
            $message = 'Vous avez quitter le module' . $module_id;

            // envoi des notifications au admin
            $admin = DB::table('users')->where('role', '=', 'admin')->get()->first();
            $module = DB::table('modules')->where('id', '=', $module_id)->get()->first();
            $user = DB::table('users')->where('id', '=', $apprenant_id)->get()->first();
            $notification = new NotificationController();
            $notification->create(
                'module',
                'L\'apprenant ' . $user->first_name . ' ' . $user->last_name . ' a quitté le module ' . $module->titre,
                '/module/'.$module_id,
                date('Y-m-d'),
                date('H:i:s'),
                'non lu',
                $admin->id
            );

        }
        $response = [
            'message' => $message,
            'is there' => $is_already
        ];
        return response()->json($response, 201, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

}
