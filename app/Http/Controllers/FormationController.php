<?php

namespace App\Http\Controllers;

use App\Mail\MailSender;
use App\Models\Competence;
use App\Models\Formation;
use App\Models\InscriptionModule;
use App\Models\Module;
use App\Models\Notification;
use App\Models\Objectif;
use App\Models\participation;
use App\Models\Prerequis;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use Illuminate\View\View;


class FormationController extends Controller
{
    public function index()
    {
        return view('formation/index');
    }

    public function all(): View
    {
        $formations = Formation::join('modules', 'formations.module_id', '=', 'modules.id')
            ->join('users', 'formations.formateur_id', '=', 'users.id')
            ->select('formations.*', 'users.first_name', 'users.last_name')
            ->get()
            ->reverse();

        return view('formation/all', ['formations' => $formations]);

    }

    public function modules(): RedirectResponse
    {
        return redirect()->route('index.modules');
    }

    public function create()
    {
        return view('formation/planifier');
    }

    public function createFormation(Request $request): RedirectResponse
    {
        $module_id = $request->input('module_id');
        $module = $request->input('module');
        $formateur_id = $request->input('formateur_id');
        $date = $request->input('date');
        $heure_debut = $request->input('heure-debut');
        $heure_fin = $request->input('heure-fin');
        $lieu = $request->input('lieu');

        $formation = new Formation();
        $formation->module_id = $module_id;
        $formation->formateur_id = $formateur_id;
        $formation->date = $date;
        $formation->heure_debut = $heure_debut;
        $formation->heure_fin = $heure_fin;
        $formation->lieu = $lieu;
        $formation->titre = $module;
        $formation->save();

        // sending notificaitons and email to apprenants
        $apprenants = InscriptionModule::where('module_id', '=', $module_id)
            ->join('users', 'users.id', '=', 'inscription_modules.apprenant_id')
            ->select('users.id as user_id', 'users.email as apprenant_email')
            ->get();

        foreach ($apprenants as $apprenant) {
            $notification = new Notification();
            $notification->user_id = $apprenant->user_id;
            $notification->type = 'formation';
            $notification->contenu =
                $formation->titre . ' : une nouvelle formtion aura lieu le '
                . $formation->date . ' à ' . $formation->heure_debut . ' à ' . $formation->lieu;

            $notification->lien = '/formation/' . $formation->id;
            $notification->date = date('Y-m-d');
            $notification->heure = date('H:i:s');
            $notification->statut = 'non lu';
            $notification->save();

            $data = [
                'formateur' => $apprenant,
                'titre' => $formation->titre,
                'date' => $formation->date,
                'heure_debut' => $formation->heure_debut,
                'heure_fin' => $formation->heure_fin,
                'lieu' => $formation->lieu,
                'lien' => 'http://formeoo.test/formation/' . $formation->id
            ];

            Mail::to($apprenant->apprenant_email)
                ->send(new MailSender(
                    'Formeoo - Nouvelle formation - '.$data['titre'],
                    'nouvelle_formation',
                    $data
                ));

        }

        // sending notification and email to formateur
        $notification = new Notification();
        $notification->user_id = $formateur_id;
        $notification->type = 'formation';
        $notification->contenu =
            $formation->titre . ' : une nouvelle formtion aura lieu le '
            . $formation->date . ' à ' . $formation->heure_debut . ' à ' . $formation->lieu;

        $notification->lien = '/formation/' . $formation->id;
        $notification->date = date('Y-m-d');
        $notification->heure = date('H:i:s');
        $notification->statut = 'non lu';
        $notification->save();

        // sending mail to formateur
        $formateur = User::find($formateur_id);
        $data = [
            'formateur' => $formateur,
            'titre' => $formation->titre,
            'date' => $formation->date,
            'heure_debut' => $formation->heure_debut,
            'heure_fin' => $formation->heure_fin,
            'lieu' => $formation->lieu,
            'lien' => 'http://formeoo.test/formation/' . $formation->id
        ];

        Mail::to($formateur->email)
            ->send(new MailSender(
                'Formeoo - Nouvelle formation - '.$data['titre'],
                'nouvelle_formation',
                $data
        ));

        return redirect()->route('show.formation', ['id' => $formation->id]);
    }


    public function show($id): View
    {
        $formation = Formation::join('modules', 'formations.module_id', '=', 'modules.id')
            ->join('users', 'formations.formateur_id', '=', 'users.id')
            ->select('formations.*', 'users.first_name', 'users.last_name')
            ->where('formations.id', '=', $id)
            ->first();

        $objectifs = Objectif::all()->where('module_id', '=', $formation->module_id);
        $competences = Competence::all()->where('module_id', '=', $formation->module_id);
        $prerequis = Prerequis::all()->where('module_id', '=', $formation->module_id);
        $apprenants = InscriptionModule::where('module_id', '=', $formation->module_id)
            ->join('users', 'users.id', '=', 'inscription_modules.apprenant_id')
            ->leftJoin('participations', 'participations.apprenant_id', '=', 'inscription_modules.apprenant_id')
            ->select('users.first_name', 'users.last_name', 'users.id', 'users.email', 'participations.apprenant_id as participant_id')
            ->get();

        $participant_apprenants = participation::all()->where('formation_id', '=', $id)->count();

        return view('formation/show', [
            'formation' => $formation,
            'objectifs' => $objectifs,
            'competences' => $competences,
            'prerequis' => $prerequis,
            'apprenants' => $apprenants,
            'participant_apprenants' => $participant_apprenants
        ]);
    }

}
