<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->type = 'admin'){
            $searchData = [
                'nom' => '',
                'prenom' => '',
                'login' => '',
                'type' => ''
            ];
            $users = User::orderBy('created_at', 'desc')->paginate(4);
            return view('pages.user.index', compact('users', 'searchData'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }else{
            $users = User::orderBy('created_at', 'desc')->paginate(4);
            return view('pages.user.index', compact('users'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'login' => 'required|string|unique:users',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'mdp' => ['required', 'string', 'min:8'],
            'type' => 'required'
        ]);
        $user = new User();
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->login = $request->input('login');
        $user->mdp = Hash::make($request->input('mdp'));
        $user->type = $request->input('type');
        $user->save();
        return redirect('/user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.user.edit', compact('user'));
    }

    public function search(Request $request)
    {
        $searchData = [
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'login' => $request->input('login'),
            'type' => $request->input('type')
        ];
        // Search in the title and body columns from the posts table
        $users = User::orderBy('created_at', 'desc');
        if ($searchData['nom'] != null) $users = $users->where('nom', '=', $searchData['nom']);
        if ($searchData['prenom'] != null) $users = $users->where('prenom', '=', $searchData['prenom']);
        if ($searchData['login'] != null) $users = $users->where('login', '=', $searchData['login']);
        if ($searchData['type'] != null) $users = $users->where('type', '=', $searchData['type']);
        // Return the search view with the resluts compacted
        $users = $users->paginate(5);
        return view('pages.user.index', compact('users', 'searchData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nom' => 'required',
            'prenom' => 'required',
            'login' => ['required', 'string', 'max:255'],
            //'password' => ['string', 'min:8'],
            'type' => 'string',
        ]);
        //dd($request);
        $user = User::find($id);
        if ($request['mdp'] != null) {
            $request['mdp'] = Hash::make($request['mdp']);
        } else {
            $request['mdp'] = $user->mdp;
        }
        $user->update([
            'nom' => $request['nom'],
            'prenom' => $request['prenom'],
            'login' => $request['login'],
            'mdp' => $request['mdp'],
            'type' => $request['type'],
        ]);
        if (Auth::user()->type == "admin")
            return redirect()->route('user.index')
                ->with('success', 'User updated successfully');
        else
            return back()
                ->with('success', 'User updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $planning
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();
            return redirect()->route('user.index')
            ->with('success', 'User deleted successfully'); 
    }

}
