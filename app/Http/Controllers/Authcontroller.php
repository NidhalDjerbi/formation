<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class Authcontroller extends Controller
{
    protected $redirectTo = '/';

    public function showLoginForm(){
        return view('login_user');
    }

    public function authenticate(Request $request){
        $this->validate($request,
            [
                'login' => 'required|string',
                'mdp' => 'required|min:3|max:10'
            ]
        );
        $user = User::where('login', $request['login'])->first();
        if ($user) {
            if (password_verify($request['mdp'], $user->mdp)) {
                $this->guard()->login($user);
                return redirect('/home');
            } else {
                return back()->withInput();
            }
        } else {
            return back()->withInput();
        }
    }

    public function register_user(Request $request){
        $this->validate($request,
            [
                'login' => 'required|string|unique:users',
                'nom' => 'required|string',
                'mdp' => ['required', 'string', 'min:8'],

            ]
        );
        $user = new User;
        $user->login = $request->input('login');
        $user->nom = $request->input('nom');
        $user->mdp = Hash::make($request->input('mdp'));
        $user->type = 'user';
        $user->save();
        $this->guard()->login($user);
        return redirect('/home');
    }

    public function logout(Request $request){
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    protected function guard(){
        return Auth::guard();
    }
}
