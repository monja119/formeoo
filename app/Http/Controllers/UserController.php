<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;
use \Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function index(): View
    {
        $users = User::all();
        return view('users/users', ['users' => $users]);
    }

    public function profile(): RedirectResponse
    {

        $user = session()->get('user');
        $user_module_count = DB::table('inscription_modules')
            ->where('apprenant_id', $user->id)
            ->count();

        $user_formation_count = DB::table('participations')
            ->where('apprenant_id', $user->id)
            ->count();

        return redirect()->route('profile.user', [
            'id' => $user->id,
        ]);
    }

    public function user($id): View
    {
        $user = User::find($id);
        $user_module_count = DB::table('inscription_modules')
            ->where('apprenant_id', $user->id)
            ->count();

        $user_formation_count = DB::table('participations')
            ->where('apprenant_id', $user->id)
            ->count();

        if($user->role != 'admin')
            return view('profile/admin', [
                'user' => $user,
                'user_module_count' => $user_module_count,
                'user_formation_count' => $user_formation_count
                ]);

        return view('profile/user/user', [
            'user' => $user,
            'user_module_count' => $user_module_count,
            'user_formation_count' => $user_formation_count
            ]);
    }

    public function allApprenant(): View
    {
        $apprenants = User::where('role', 'apprenant')->get()->reverse();

        return view('users/apprenant', ['apprenants' => $apprenants]);

    }

    public function allFormateur(): string
    {
        $formateurs = User::where('role', 'formateur')->get()->reverse();

        return view('users/formateur', ['formateurs' => $formateurs]);
    }


    public function getFormateurByName() : JsonResponse
    {
        $name = request()->get('name');
        $formateurs = DB::table('users')
                    ->select('id', DB::raw("CONCAT(first_name, ' ', last_name) as nom"))
                    ->where('role', 'formateur')
                    ->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%'.$name.'%')
                    ->limit(5)
                    ->get()
                    ->reverse();

        return response()->json($formateurs, 201, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);

    }


    public function getApprenantByName() : JsonResponse
    {
        $name = request()->get('name');
        $apprenants = DB::table('users')
                    ->select('id', DB::raw("CONCAT(first_name, ' ', last_name) as nom"))
                    ->where('role', 'apprenant')
                    ->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%'.$name.'%')
                    ->limit(5)
                    ->get()
                    ->reverse();

        return response()->json($apprenants, 201, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }


}
