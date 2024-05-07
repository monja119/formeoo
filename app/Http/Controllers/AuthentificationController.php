<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthentificationController extends Controller
{

    public function login(Request $request){

        if($request->isMethod('get')){
            // destroy session if exists
            Auth::logout();
            $request->session()->remove('user');
            $request->session()->remove('entity');

            return View('forms/login');
        }

        // if request is post
        elseif($request->isMethod('post')) {
            $email = $request->input('email');
            $password = $request->input('password');

            // Look for the user in both 'users' table
            $user = User::where('email', $email)->first();

            // if user admin
            if ($user && $user->role == 'admin') {
                // If user exists and the password is correct
                if ($password === $user->password) {
                    session(['user' => $user]);
                    Auth::login($user);
                    return redirect()->route('home');
                } else {
                    $error_msg = 'Votre email ou mot de passe est incorrect';
                    return redirect()->route('login')->with(['error_msg' => $error_msg]);
                }

            } else {
                if ($user && password_verify($password, $user->password)) {
                    // If user exists and the password is correct
                    session(['user' => $user]);
                    Auth::login($user);
                    return redirect()->route('home');
                } else {
                    // If neither user nor entity found or the password is incorrect
                    $error_msg = 'Votre email ou mot de passe est incorrect';
                    return redirect()->route('login')->with(['error_msg' => $error_msg]);
                }
            }
        }

    }


    public function register(Request $request)
    {

        if ($request->isMethod('get')) {
            return View('forms/register');

        }
        // post method
        elseif ($request->isMethod('post')) {

            $email = $request->input('email');

            // verify if email exist in database
            $user = User::where('email', $email)->first();
            if ($user) {
                $error_msg = 'Votre email ' . $email . ' existe déjà dans notre base de données';
                return redirect()->route('register')->with(['error_msg' => $error_msg]);
            } else {

                // verifying if password and confirm password are the same
                $password = $request->input('password');
                $confirm_password = $request->input('password2');
                if ($password != $confirm_password) {
                    $error_msg = 'Les mots de passe ne sont pas identiques';
                    return redirect()->route('register')->with(['error_msg' => $error_msg]);
                }
                // saving user as his account type : user or entity
                $account_type = $request->input('account_type');
                if($account_type != 'entity') {
                    // saving user in database
                    $user = new User();
                    $user->email = $email;

                    $user->password = $password;
                    $user->first_name = $request->input('first_name');
                    $user->last_name = $request->input('last_name');
                    $user->phone = $request->input('telephone');
                    $user->address = $request->input('address');
                    $user->gender = $request->input('gender');
                    $user->created_at = date('Y-m-d H:i:s');

                    $user->save();
                }
                else {
                    $entity = new Entity();
                    $entity->name = $request->input('name');
                    $entity->description = $request->input('description');
                    $entity->website = $request->input('website');
                    $entity->password = $password;
                    $entity->phone = $request->input('telephone');
                    $entity->address = $request->input('address');
                    $entity->email = $email;

                    $entity->save();
                }
                return redirect()->route('login');
            }

        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->remove('user');
        $request->session()->remove('entity');
        return redirect()->route('home');

    }
}
