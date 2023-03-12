<?php

namespace App\Http\Controllers\API;

use App\Models\Decoration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorie_decoration;
use App\Models\Categorie_material;
use Illuminate\Support\Facades\DB;

class DecorationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $decorations = DB::table('decorations')

            ->join('categorie_decorations', 'decorations.categorie_decoration_id', '=', 'categorie_decorations.id')
            ->select('decorations.*', 'categorie_decorations.name_categorie_decoration')
            ->get();


        return response()->json([
            'status' => 'Success',
            'data' => $decorations,
        ]);
    }

    public function indexCategorie(Categorie_decoration $categorie_decoration)
    {
        $categorie_decoration = DB::table('decorations')
            ->join('categorie_decorations', 'decorations.categorie_decoration_id', '=', 'categorie_decorations.id')
            ->select('decorations.name_decoration')
            ->where('categorie_decorations.id', '=', $categorie_decoration->id)
            ->get();

        // On retourne les informations d'une fiche "enfant" en JSON
        return response()->json([
            'status' => 'Success',
            'data' => $categorie_decoration,
        ]);
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
            'name_decoration' => 'required|max:100',
            'description_decoration' => 'required',
            'price_decoration' => 'required',
            'picture_decoration' => 'required',
            'categorie_decoration_id' => 'required'
        ]);
        // On crée un nouvel utilisateur
        $decoration = Decoration::create([
            'name_decoration' => $request->name_decoration,
            'description_decoration' => $request->description_decoration,
            'price_decoration' => $request->price_decoration,
            'picture_decoration' => $request->picture_decoration,
            'categorie_decoration_id' => $request->categorie_decoration_id
        ]);

        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json([
            'status' => 'Success',
            'data' => $decoration,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Decoration $decoration)
    {
        return response()->json($decoration);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Decoration $decoration)
    {
        $this->validate($request, [
            'name_decoration' => 'required|max:100',
            'description_decoration' => 'required',
            'price_decoration' => 'required',
            'picture_decoration' => 'required',
            'categorie_decoration_id' => 'required',

        ]);
        // On crée un nouvel utilisateur
        $decoration->update([
            'name_decoration' => $request->name_decoration,
            'description_decoration' => $request->description_decoration,
            'price_decoration' => $request->price_decoration,
            'picture_decoration' => $request->picture_decoration,
            'categorie_decoration_id' => $request->categorie_decoration_id,
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
    public function destroy(Decoration $decoration)
    {
        // On supprime l'utilisateur
        $decoration->delete();
        // On retourne la réponse JSON
        return response()->json([
            'status' => 'Supprimée avec succès'
        ]);
    }
}
