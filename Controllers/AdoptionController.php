<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Adoption;
use Illuminate\Support\Facades\Auth;
use Gate;

class AdoptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $animals = Animal::all()->toArray();
         $adoptions = Adoption::all()->toArray();
            if (Gate::denies('requestViews')) {
                $adoptions = Adoption::where('user_id', Auth::user()->id)->get()->toArray();
            }

        return view('adoptions.index', array('adoptions'=>$adoptions, 'animals'=>$animals));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $animal_id)
    { //setting the values once an adoption request is made
        $adoption = new Adoption;
        $adoption->animal_id = $animal_id;
        $adoption->user_id = Auth::user()->id;
        $adoption->status = 'waiting'; 
        $adoption->created_at = now(); 

        $adoption->save();
        //a redirect HTTP response
        return back()->with('Application completed'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
        public function accept($id){
        $adoption = Adoption::find($id);
        $animal = Animal::find($adoption->animal_id);
        $animal->user_id = $adoption->user_id;
        $animal->availability = 'unavailable';
        $adoption->status='approved';
        $adoption->save();
        $animal->save();

        return back();

    }

    public function deny($id){
        $adoption = Adoption::find($id);
        $adoption->status="denied";
        $adoption->save();

        return back();

    }

        public function indexAdmin()
    {
        $animals = Animal::all()->toArray();
        $adoptions = Adoption::where('status', '!=', 'waiting')->get()->toArray();
        if(Auth::user()->role==1){
      		return view('adoptions.index', compact('adoptions', 'animals'));
        }
  		if(Auth::user()->role==0){
  			return back()->with('Error', 'Admin privilege is required to view this page.');
  		}
    }

        public function pendingView()
    {   
        $animals = Animal::all()->toArray();
         $adoptions = Adoption::where('status', 'waiting')->get()->toArray();
         	if(Auth::user()->role == 1 ){
         		return view('adoptions.index', array('adoptions'=>$adoptions, 'animals'=>$animals));
         	}
        if(Auth::user()->role == 0 ){
        	return back()->with ('Error', 'Admin privilege is required to view this page.');
        }
    }

            public function viewAll()
    {   
        $animalsQuery = Animal::all()->toArray();
        if(Auth::user()->role ==1 ){
        	return view('adoptions.view', array('animals'=>$animalsQuery));
        }
        if(Auth::user()->role ==0 ){
        	return back()->with ('Error', 'Admin privilege is required to view this page.');
        }
        
    }
    
}
