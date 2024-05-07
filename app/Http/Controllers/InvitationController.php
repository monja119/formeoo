<?php

namespace App\Http\Controllers;

use App\Mail\MailMessage;
use App\Models\Invitation;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class InvitationController extends Controller
{
    public function index()
    {
        return View('forms/invitation');
    }

    public function allInvitation(): View
    {
        $invitations = Invitation::all()->reverse();

        return view('users/invitations', ['invitations' => $invitations]);
    }

    public function sendInvitation(Request $request)
    {
        $data = [
            'email' =>$request->input('email'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'role' => $request->input('role')
        ];

        // creation des valeurs sur la table invitation
        $invitation = new Invitation();
        $invitation->email = $data['email'];
        $invitation->first_name = $data['first_name'];
        $invitation->last_name = $data['last_name'];
        $invitation->role = $data['role'];
        $invitation->status = 'pending';
        // creation du token
        $token = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 32);
        $invitation->token = $token;
        $invitation->save();

        // email acceptation url
        $url = 'http://localhost:8000/invitation/accept?token='.$invitation->token;

        $data['url'] = $url;

        // sendinga mail
        Mail::to($data['email'])->send(new MailMessage($data));

        // redirecting to mail controller
        return redirect()->route('users')->with(['message' => 'Invitation envoyée']);

    }
    public function accept(Request $request){
        $token = $request->query('token');

        $invitation = Invitation::where('token', $token)->first();

        if($invitation){
            $invitation->status = 'accepted';
            $invitation->save();

            // creation user
            $user = new User();
            $user->email = $invitation->email;
            $user->first_name = $invitation->first_name;
            $user->last_name = $invitation->last_name;
            $user->role = $invitation->role;
            // creation un simple mot de passe à 6 combinaisoon de chiffre et lettre aleatoire
            $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 6);

            $user->password = bcrypt($password);
            $user->save();

            // authentification
            auth()->login($user);
            session()->put('user', $user);


            // send email with password
            Mail ::send('emails/mot_de_passe', ['password' => $password, 'user' => $user], function($message) use ($user){
                $message->to($user->email);
                $message->subject('Mot de passe Formeoo');
            });

            // sending notification to admin
            $admin = User::where('role', 'admin')->first();
            $notification = new Notification();
            $notification->user_id = $admin->id;
            $notification->contenu = $user->first_name.' '.$user->last_name.' a accepté l\'invitation';
            $notification->type = 'user';
            $notification->date = date('Y-m-d');
            $notification->heure = date('H:i:s');
            $notification->statut = 'non lu';
            $notification->lien = '/user/'.$user->id;
            $notification->save();

            return redirect()->route('profile')->with(['message' => 'Invitation acceptée']);
        }else{
            return 'Invitation invalide';
        }
    }
}
