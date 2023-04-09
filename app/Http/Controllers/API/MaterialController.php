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
    public function indexCategorie(Categorie_material $categorie_material)
    {
        $categorie_material = DB::table('materials')
            ->join('categorie_materials', 'materials.categorie_material_id', '=', 'categorie_materials.id')
            ->select('materials.*')
            ->where('categorie_materials.id', '=', $categorie_material->id)
            ->get();

        return response()->json([
            'status' => 'Success',
            'data' => $categorie_material,
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
            'categorie_material_id' => 'required',
            'quantity_editable_material' => 'required',
        ]);

        $filename = "";
        if ($request->hasFile('picture_material')) {
            // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg"
            $filenameWithExt = $request->file('picture_material')->getClientOriginalName();
            $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //  On récupère l'extension du fichier, résultat $extension : ".jpg"
            $extension = $request->file('picture_material')->getClientOriginalExtension();
            // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $fileNameToStore : "jeanmiche_20220422.jpg"
            $filename = $filenameWithoutExt . '_' . time() . '.' . $extension;
            // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin /storage/app
            $path = $request->file('picture_material')->storeAs('public/uploads', $filename);
        } else {
            $filename = Null;
        }
        // On crée un nouvel utilisateur
        $material = Material::create([
            'name_material' => $request->name_material,
            'description_material' => $request->description_material,
            'price_material' => $request->price_material,
            'picture_material' => $filename,
            'categorie_material_id' => $request->categorie_material_id,
            'quantity_editable_material' => $request->quantity_editable_material,
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
            'categorie_material_id' => 'required',
            'quantity_editable_material' => 'required',
        ]);

        $filename = "";
        if ($request->hasFile('picture_material')) {
            // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg"
            $filenameWithExt = $request->file('picture_material')->getClientOriginalName();
            $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //  On récupère l'extension du fichier, résultat $extension : ".jpg"
            $extension = $request->file('picture_material')->getClientOriginalExtension();
            // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $fileNameToStore : "jeanmiche_20220422.jpg"
            $filename = $filenameWithoutExt . '_' . time() . '.' . $extension;
            // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin /storage/app
            $path = $request->file('picture_material')->storeAs('public/uploads', $filename);
        } else {
            $filename = Null;
        }
        // On crée un nouvel utilisateur
        $material->update([
            'name_material' => $request->name_material,
            'description_material' => $request->description_material,
            'price_material' => $request->price_material,
            'picture_material' => $filename,
            'quantity_editable_material' => $request->quantity_editable_material,
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
