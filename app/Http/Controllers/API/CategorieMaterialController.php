<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Categorie_material;
use App\Http\Controllers\Controller;

class CategorieMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // On récupère tous les caté
        $categorie_material = Categorie_material::all();
        // On retourne les informations des caté en JSON
        return response()->json($categorie_material);
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
            'name_categorie_material' => 'required|max:100',
            'included_kit' => 'required',
        ]);
        // On crée un nouvel utilisateur
        $categorie_material = Categorie_material::create([
            'name_categorie_material' => $request->name_categorie_material,
            'included_kit' => $request->included_kit,
        ]);
        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json([
            'status' => 'Success',
            'data' => $categorie_material,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie_material $categorie_material)
    {
        return response()->json($categorie_material);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie_material $categorie_material)
    {
        $this->validate($request, [
            'name_categorie_material' => 'required|max:100',
            'included_kit' => 'required',
        ]);
        // On crée un nouvel utilisateur
        $categorie_material->update([
            'name_categorie_material' => $request->name_categorie_material,
            'included_kit' => $request->included_kit,
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
    public function destroy(Categorie_material $categorie_material)
    {
        // On supprime l'utilisateur
        $categorie_material->delete();
        // On retourne la réponse JSON
        return response()->json([
            'status' => 'Supprimée avec succès'
        ]);
    }
}
