<?php

namespace App\Http\Controllers\API;

use App\Models\Opinion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOption\Option;

class OpinionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // On récupère tous les caté
        $opinion = Opinion::all();
        // On retourne les informations des caté en JSON
        return response()->json($opinion);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content_opinion' => 'required',
            'note_opinion' => 'required',
            'user_id' => 'required',
        ]);
        // On crée un nouvel utilisateur
        $opinion = Opinion::create([
            'content_opinion' => $request->content_opinion,
            'note_opinion' => $request->note_opinion,
            'user_id' => $request->user_id,
            'living_id' => $request->living_id,
            'material_id' => $request->material_id,
            'decoration_id' => $request->decoration_id,
        ]);
        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json([
            'status' => 'Success',
            'data' => $opinion,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Opinion $opinion)
    {
        return response()->json($opinion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Opinion $opinion)
    {
        $this->validate($request, [
            'content_opinion' => 'required|max:100',
            'note_opinion' => 'required|max:100',
            'user_id' => 'required',
        ]);
        // On crée un nouvel utilisateur
        $opinion->update([
            'content_opinion' => $request->content_opinion,
            'note_opinion' => $request->note_opinion,
            'user_id' => $request->user_id,
            'living_id' => $request->living_id,
            'material_id' => $request->material_id,
            'decoration_id' => $request->decoration_id,
        ]);
        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json([
            'status' => 'Mise à jour avec succèss'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Opinion $opinion)
    {
        // On supprime l'utilisateur
        $opinion->delete();
        // On retourne la réponse JSON
        return response()->json([
            'status' => 'Supprimée avec succès'
        ]);
    }
}
