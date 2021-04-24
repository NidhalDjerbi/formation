<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Planning;
use App\models\Cour;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class PlanningController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->type == 'admin'){
            $searchData = [
                'intitule' => '',
                'date_debut' => \Carbon\Carbon::now()->format('20y-m-d'),
                'date_fin' => \Carbon\Carbon::now()->format('20y-m-d'),
            ];
            $plannings =  DB::table('plannings')
                ->join('cours','plannings.cours_id', '=', 'cours.id')
                ->select('plannings.*', 'cours.intitule')
                ->paginate(4);
            // $plannings = Planning::orderBy('created_at', 'desc')->with('cour')->paginate(4);
            return view('pages.planning.index', compact('plannings', 'searchData'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }else{
            $plannings = Planning::orderBy('created_at', 'desc')->paginate(4);
            return view('pages.planning.index', compact('plannings'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
    }

    public function search(Request $request){
        $searchData = [
            'intitule' => $request->input('intitule'),
            'date_debut' => $request->input('date_debut'),
            'date_fin' => $request->input('date_fin'),            
        ];
        $dateFormat = 'Y-m-d';
        
        $date_debut = $dateTime = \DateTime::createFromFormat($dateFormat, $searchData['date_debut']);
        $date_fin = $dateTime = \DateTime::createFromFormat($dateFormat, $searchData['date_fin']);
      
        // Search in the title and body columns from the posts table
            $plannings = Planning::orderBy('created_at', 'desc');
            if ($searchData['intitule'] != null) $plannings = $plannings->where('intitule', '=', $searchData['intitule']);
            if($date_debut != null) $plannings = $plannings->whereDate('date_debut','>=',$date_debut);
            if($date_fin !=null) $plannings = $plannings->whereDate('date_fin','<=',$date_fin);
            // Return the search view with the resluts compacted
            $plannings = $plannings->paginate(5);
            return view('pages.planning.index', compact('plannings', 'searchData'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createFromAdmin()
    {
        $cours = Cour::all();
        return view('pages.planning.adminCreatePlanning', compact('cours')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeFromAdmin(Request $request)
    {
        $this->validate($request, [
            'date_debut' => 'required',
            'date_fin' => 'required',
            'cours_id' => 'required'
        ]);
        $planning = new Planning;
        $planning->date_debut = $request->input('date_debut');
        $planning->date_fin = $request->input('date_fin');
        $planning->cours_id = $request->input('cours_id');
        $planning->save();
        return redirect()->route('planning.index')
        ->with('success', 'Planning saved successfully');
    }

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
        $user = Auth::user();
        $request->validate([
            'date_debut' => 'required',
            'date_fin' => 'required'
        ]);
        $planning = Planning::find($id);
        $planning->update($request->all());

        if($user->type == 'admin'){
            return redirect()->route('planning.index')
            ->with('success', 'Planning updated successfully');
        }elseif($user->type == 'enseignant') {
            # code...
            return redirect()->route('cour.planning_enseignant')
                ->with('success', 'planning updated successfully');
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Planning $planning
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $planning = Planning::find($id);
        $planning->delete();
        if($user->type == 'admin'){
            return redirect()->route('planning.index')
            ->with('success', 'Planning deleted successfully');
        }elseif($user->type == 'enseignant') {
            # code...
            return redirect()->route('cour.planning_enseignant')
                ->with('success', 'planning deleted successfully');
        }
        
    }
}
