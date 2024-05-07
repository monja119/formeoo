<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = DB::table('notifications')
            ->where('user_id', '=', session()->get('user')->id)
            ->orderBy('id', 'desc')
            ->get();

        // make all notifications read
        DB::table('notifications')
            ->where('user_id', '=', session()->get('user')->id)
            ->update(['statut' => 'lu']);

        // return view
        return view(
            'notifications/index',
            [
                'notifications' => $notifications
            ]
        );
    }

    public function create($type, $contenu, $lien, $date, $heure, $statut, $user_id): JsonResponse
    {
        $notification = new Notification();
        $notification->type = $type;
        $notification->contenu = $contenu;
        $notification->lien = $lien;
        $notification->date = $date;
        $notification->heure = $heure;
        $notification->statut = $statut;
        $notification->user_id = $user_id;
        $notification->save();

        return response()->json([
            'message' => 'Notification created successfully',
            'status' => 'success',
            'data' => $notification
        ], 201);

    }

}
