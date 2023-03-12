<?php

namespace App\Http\Controllers\API;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorie_material;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // On récupère tous les caté
        $materials = DB::table('materials')

            ->join('categorie_materials', 'materials.categorie_material_id', '=', 'categorie_materials.id')
            ->select('materials.*', 'categorie_materials.name_categorie_material')
            ->get();


        return response()->json([
            'status' => 'Success',
            'data' => $materials,
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
            'name_material' => 'required|max:100',
            'description_material' => 'required',
            'price_material' => 'required',
            'picture_material' => 'required',
            'categorie_material_id' => 'required'


        ]);
        // On crée un nouvel utilisateur
        $material = Material::create([
            'name_material' => $request->name_material,
            'description_material' => $request->description_material,
            'price_material' => $request->price_material,
            'picture_material' => $request->picture_material,
            'categorie_material_id' => $request->categorie_material_id,
        ]);
        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json([
            'status' => 'Success',
            'data' => $material,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        return response()->json($material);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        $this->validate($request, [
            'name_material' => 'required|max:100',
            'description_material' => 'required',
            'price_material' => 'required',
            'picture_material' => 'required',
            'categorie_material_id' => 'required',


        ]);
        // On crée un nouvel utilisateur
        $material->update([
            'name_material' => $request->name_material,
            'description_material' => $request->description_material,
            'price_material' => $request->price_material,
            'picture_material' => $request->picture_material,
            'categorie_material_id' => $request->categorie_material_id,
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
    public function destroy(Material $material)
    {
        // On supprime l'utilisateur
        $material->delete();
        // On retourne la réponse JSON
        return response()->json([
            'status' => 'Supprimée avec succès'
        ]);
    }
}
