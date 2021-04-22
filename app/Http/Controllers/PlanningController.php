<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Planning;
use App\models\Cour;


class PlanningController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $cour = Cour::find($id);
        return view('pages.planning.create', compact('cour'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'date_debut' => 'required',
            'date_fin' => 'required'
        ]);
        $planning = new Planning;
        $planning->date_debut = $request->input('date_debut');
        $planning->date_fin = $request->input('date_fin');
        $planning->cours_id = $request->route('id');
        // dd($planning);
        $planning->save();
        return redirect()->route('cour.planning_enseignant')
        ->with('success', 'Planning updated successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Planning $planning
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $planning = Planning::find($id);
        return view('pages.planning.edit', compact('planning'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Planning $planning
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date_debut' => 'required',
            'date_fin' => 'required'
        ]);
        $planning = Planning::find($id);

        

        $planning->update($request->all());

        return redirect()->route('cour.planning_enseignant')
            ->with('success', 'Planning updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Planning $planning
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $planning = Planning::find($id);
        $planning->delete();
        return redirect()->route('cour.planning_enseignant')
            ->with('success', 'plan$planning deleted successfully');
    }
}
