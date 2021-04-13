<?php

namespace App\Http\Controllers;
use App\models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formations = Formation::orderBy('created_at', 'desc')->paginate(4);
        return view('pages.formation.index', compact('formations'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.formation.create');
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
        $formation = new Formation;
        $formation->intitule = $request->input('intitule');
        $formation->save();
        return redirect('/formation');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Formation $formation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $formation = Formation::find($id);
        return view('pages.formation.edit', compact('formation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Formation $formation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'intitule' => 'required'
        ]);
        $formation = Formation::find($id);

        

        $formation->update($request->all());

        return redirect()->route('formation.index')
            ->with('success', 'Formation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Formation $formation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $formation = Formation::find($id);
        $formation->delete();
        return redirect()->route('formation.index')
            ->with('success', 'Formation deleted successfully');
    }
}
