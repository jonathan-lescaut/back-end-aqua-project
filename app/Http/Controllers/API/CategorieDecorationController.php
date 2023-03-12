<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorie_decoration;

class CategorieDecorationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // On récupère tous les caté
        $categorie_decoration = Categorie_decoration::all();
        // On retourne les informations des caté en JSON
        return response()->json($categorie_decoration);
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
            'name_categorie_decoration' => 'required|max:100',
        ]);
        // On crée un nouvel utilisateur
        $categorie_decoration = Categorie_decoration::create([
            'name_categorie_decoration' => $request->name_categorie_decoration,
        ]);
        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json([
            'status' => 'Success',
            'data' => $categorie_decoration,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie_decoration $categorie_decoration)
    {
        return response()->json($categorie_decoration);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie_decoration $categorie_decoration)
    {
        $this->validate($request, [
            'name_categorie_decoration' => 'required|max:100',
        ]);
        // On crée un nouvel utilisateur
        $categorie_decoration->update([
            'name_categorie_decoration' => $request->name_categorie_decoration,
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
    public function destroy(Categorie_decoration $categorie_decoration)
    {
        // On supprime l'utilisateur
        $categorie_decoration->delete();
        // On retourne la réponse JSON
        return response()->json([
            'status' => 'Supprimée avec succès'
        ]);
    }
}
