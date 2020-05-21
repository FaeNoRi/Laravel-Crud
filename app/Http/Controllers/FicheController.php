<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fiche;

class FicheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $fichescases = Fiche::all();
    
            return view('index', compact('fichescases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $user = auth()->user();
            $validatedData = $request->validate([
                'nom' => 'required|max:255',
                'type' => 'required|max:255',
                'genre' => 'required|max:255',
                'sortie' => 'required|date',
                'synopsis' => 'required'

            ]);
            $validatedData['auteur'] = $user->name;
            $show = Fiche::create($validatedData);
       
            return redirect('/fiches')->with('success', 'La fiche à bien été créé');
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
            $fichescases = Fiche::findOrFail($id);
    
            return view('edit', compact('fichescases'));
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
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'type' => 'required|max:255',
            'genre' => 'required|max:255',
            'sortie' => 'required|date',
            'synopsis' => 'required'
        ]);
            Fiche::whereId($id)->update($validatedData);
    
            return redirect('/fiches')->with('success', 'La fiche à bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $fichescases = Fiche::findOrFail($id);
            $fichescases->delete();
    
            return redirect('/fiches')->with('success', 'Votre fiche à été supprimer avec succés');
    }
}
