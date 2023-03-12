<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Categorie_living;
use App\Http\Controllers\Controller;

class CategorieLivingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // On récupère tous les caté
        $categorie_living = Categorie_living::all();
        // On retourne les informations des caté en JSON
        return response()->json($categorie_living);
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
            'name_categorie_living' => 'required|max:100',
        ]);
        // On crée un nouvel utilisateur
        $categorie_living = Categorie_living::create([
            'name_categorie_living' => $request->name_categorie_living,
        ]);
        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json([
            'status' => 'Success',
            'data' => $categorie_living,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie_living $categorie_living)
    {
        return response()->json($categorie_living);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie_living $categorie_living)
    {
        $this->validate($request, [
            'name_categorie_living' => 'required|max:100',
        ]);
        // On crée un nouvel utilisateur
        $categorie_living->update([
            'name_categorie_living' => $request->name_categorie_living,
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
    public function destroy(Categorie_living $categorie_living)
    {
        // On supprime l'utilisateur
        $categorie_living->delete();
        // On retourne la réponse JSON
        return response()->json([
            'status' => 'Supprimée avec succès'
        ]);
    }
}
