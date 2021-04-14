<?php

namespace App\Http\Controllers;

use App\models\Cour;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CourController extends Controller
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
                'intitule' => ''
            ];
            $cours = Cour::orderBy('created_at', 'desc')->with('user')->paginate(4);
            return view('pages.cour.index', compact('cours', 'searchData'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }else{
            $cours = Cour::orderBy('created_at', 'desc')->with('user')->paginate(4);
            return view('pages.cour.index', compact('cours'))
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
        return view('pages.cour.create');
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
            'intitule' => 'required'
        ]);
        $cour = new Cour;
        $cour->intitule = $request->input('intitule');
        $cour->user_id = $request->input('user_id');
        $cour->save();
        return redirect('/cour');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Cour $cour
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cour = Cour::find($id);
        return view('pages.cour.edit', compact('cour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Cour $cour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'intitule' => 'required',
            'user_id' => 'required'
        ]);
        $cour = Cour::find($id);
        $cour->update([
            'intitule' => $request['intitule'],
            'user_id' => $request['user_id']
        ]);

        return redirect()->route('cour.index')
            ->with('success', 'Cour updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Cour $formation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cour = Cour::find($id);
        $cour->delete();
        return redirect()->route('cour.index')
            ->with('success', 'Cour deleted successfully');
    }


    public function search(Request $request)
    {
        $searchData = [
            'intitule' => $request->input('intitule'),            
            'user_id' => $request->input('user_id')            
        ];
        // Search in the title and body columns from the posts table
        $cours = Cour::orderBy('created_at', 'desc');
        if ($searchData['intitule'] != null) $cours = $cours->where('intitule', '=', $searchData['intitule']);
        if ($searchData['user_id'] != null) $cours = $cours->where('user_id', '=', $searchData['user_id']);
        // Return the search view with the resluts compacted
        $cours = $cours->paginate(5);
        return view('pages.cour.index', compact('cours', 'searchData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

}
