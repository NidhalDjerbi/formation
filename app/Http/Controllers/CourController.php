<?php

namespace App\Http\Controllers;

use App\models\Cour;
use App\models\CourUser;
use App\models\User;
use App\models\Planning;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cour_formation(){
        $searchData = [
            'intitule' => '',            
            'user_id' => ''           
        ];
        $user = Auth::user();
        $cours = Cour::cours_formation();
        return view('pages.cour.coursFormation', compact('cours', 'searchData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cour_enseignant(){
        $user = Auth::user();
        $cours = Cour::where('user_id', '=', $user->id)->paginate(4);
        return view('pages.cour.coursEnseignant', compact('cours'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cour_etudiant()
    {
        $user = Auth::user();
        $cours = $user->cours;
        $searchData = [
            'intitule' => ''
        ];
        return view('pages.cour.coursEtudiant', compact('cours', 'searchData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        
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
    public function update(Request $request, $id){
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
    public function destroy($id){
        $cour = Cour::find($id);
        $cour->delete();
        return redirect()->route('cour.index')
            ->with('success', 'Cour deleted successfully');
    }

    /**
     * Inscription.
     *
     * @return \Illuminate\Http\Response
     */
    public function inscription(Request $request, $id)
    {
        $user = Auth::user();
        $cour = Cour::find($id);
        $user->cours()->attach($cour);
        return redirect()->back();
        
    }
    /**
     * Desinscription.
     *
     * @return \Illuminate\Http\Response
     */
    public function desinscription(Request $request, $id)
    {
        $user = Auth::user();
        $cour = Cour::find($id);
        $user->cours()->detach($cour);
        return redirect()->back();
        
    }

    public function search(Request $request){
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
    public function searchCourFormation(Request $request){
        $user = Auth::user();
        $searchData = [
            'intitule' => $request->input('intitule'),            
            'user_id' => $request->input('user_id')            
        ];
        $cours = Cour::cours_formation();
        if ($searchData['intitule'] != null) $cours = $cours->where('intitule', '=', $searchData['intitule']);
        if ($searchData['user_id'] != null) $cours = $cours->where('user_id', '=', $searchData['user_id']);
        // Return the search view with the resluts compacted
        return view('pages.cour.coursFormation', compact('cours', 'searchData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function searchCourEtudiant(Request $request){
        $user = Auth::user();
        $searchData = [
            'intitule' => $request->input('intitule'),            
            'user_id' => $request->input('user_id')            
        ];
        // Search in the title and body columns from the posts table
            $cours = $user->cours;
            if ($searchData['intitule'] != null) $cours = $cours->where('intitule', '=', $searchData['intitule']);
            if ($searchData['user_id'] != null) $cours = $cours->where('user_id', '=', $searchData['user_id']);
            // Return the search view with the resluts compacted
            return view('pages.cour.coursEtudiant', compact('cours', 'searchData'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function planning(){
        $user = Auth::user();
        $searchData = [
            'intitule' => '',
            'date_debut' => \Carbon\Carbon::now()->format('20y-m-d'),
            'date_fin' => \Carbon\Carbon::now()->format('20y-m-d'),
        ];

        $dateFormat = 'Y-m-d';

        $dateEnd = $dateTime = \DateTime::createFromFormat($dateFormat, $searchData['date_debut']);
        $dateBegin = $dateTime = \DateTime::createFromFormat($dateFormat, $searchData['date_fin']);
        
        $plannings = DB::table('cours_users')
        ->join('cours','cours_users.cours_id', '=', 'cours.id')
        ->join('plannings', 'cours.id', '=', 'plannings.cours_id')
        ->select('cours.*', 'plannings.date_debut', 'plannings.date_fin')
        ->where('cours_users.user_id', '=', $user->id)->paginate(4);
        return view('pages.cour.planning', compact('plannings','searchData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function planningEnseignant(){
        $plannings = [];
        $searchData = [
            'intitule' => '',
            'date_debut' => \Carbon\Carbon::now()->format('20y-m-d'),
            'date_fin' => \Carbon\Carbon::now()->format('20y-m-d'),
        ];
        $user = Auth::user();
        $dateFormat = 'Y-m-d';

        $dateEnd = $dateTime = \DateTime::createFromFormat($dateFormat, $searchData['date_debut']);
        $dateBegin = $dateTime = \DateTime::createFromFormat($dateFormat, $searchData['date_fin']);
        $plannings = DB::table('cours')
            ->join('plannings', 'cours.id', '=', 'plannings.cours_id')
            ->select('cours.*', 'plannings.date_debut', 'plannings.date_fin', 'plannings.id as planning_id')
            ->where('cours.user_id', '=', $user->id)
            ->get();
        return view('pages.cour.planningEnseignant', compact('plannings','searchData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        
    }

    public function planningEnseignantSearch(Request $request){
        $user = Auth::user();
        $searchData = [
            'intitule' => $request->input('intitule'),
            'date_debut' => $request->input('date_debut'),
            'date_fin' => $request->input('date_fin'),
        ];
        $dateFormat = 'Y-m-d';
        
        $date_debut = $dateTime = \DateTime::createFromFormat($dateFormat, $searchData['date_debut']);
        $date_fin = $dateTime = \DateTime::createFromFormat($dateFormat, $searchData['date_fin']);
        $plannings = DB::table('cours')
            ->join('plannings', 'cours.id', '=', 'plannings.cours_id')
            ->select('cours.*', 'plannings.date_debut', 'plannings.date_fin', 'plannings.id as planning_id')
            ->where('cours.user_id', '=', $user->id);
            
        // dd($plannings);
    
        if ($searchData['intitule'] != null) {
            $plannings = $plannings->where('intitule', '=', $searchData['intitule'])->get();
        }else{
            if($date_debut != null) $plannings = $plannings->whereDate('date_debut','>=',$date_debut);
            if($date_fin !=null) $plannings = $plannings->whereDate('date_fin','<=',$date_fin)->get();
        }
        // dd($date_debut,$plannings[0]->date_debut,($plannings[0]->date_debut <= $date_debut));
        // dd($plannings->whereDate('date_debut','>=',$date_debut)->get());
        // dd($plannings[0]->plannings);

        
        return view('pages.cour.planningEnseignant', compact('plannings','searchData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function planningSearch(Request $request){
        $user = Auth::user();
        $searchData = [
            'intitule' => $request->input('intitule'),
            'date_debut' => $request->input('date_debut'),
            'date_fin' => $request->input('date_fin'),
        ];
        $dateFormat = 'Y-m-d';
        
        $date_debut = $dateTime = \DateTime::createFromFormat($dateFormat, $searchData['date_debut']);
        $date_fin = $dateTime = \DateTime::createFromFormat($dateFormat, $searchData['date_fin']);
        $plannings = DB::table('cours_users')
            ->join('cours','cours_users.cours_id', '=', 'cours.id')
            ->join('plannings', 'cours.id', '=', 'plannings.cours_id')
            ->select('cours.*', 'plannings.date_debut', 'plannings.date_fin')
            ->where('cours_users.user_id', '=', $user->id);
        
        if ($searchData['intitule'] != null){
            $plannings = $plannings->where('intitule', '=', $searchData['intitule'])->get();
        }else{
            if($date_debut != null) $plannings = $plannings->whereDate('date_debut','>=',$date_debut);
            if($date_fin !=null) $plannings = $plannings->whereDate('date_fin','<=',$date_fin)->get();
        }
        

        
        return view('pages.cour.planning', compact('plannings','searchData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

}
