<?php

namespace App\Http\Controllers\API;

use App\Models\Decoration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorie_decoration;
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
            ->select('decorations.*')
            ->where('categorie_decorations.id', '=', $categorie_decoration->id)
            ->get();

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
            'categorie_decoration_id' => 'required',
            'quantity_editable_decoration' => 'required',
        ]);

        $filename = "";
        if ($request->hasFile('picture_decoration')) {
            // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg"
            $filenameWithExt = $request->file('picture_decoration')->getClientOriginalName();
            $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //  On récupère l'extension du fichier, résultat $extension : ".jpg"
            $extension = $request->file('picture_decoration')->getClientOriginalExtension();
            // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $fileNameToStore : "jeanmiche_20220422.jpg"
            $filename = $filenameWithoutExt . '_' . time() . '.' . $extension;
            // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin /storage/app
            $path = $request->file('picture_decoration')->storeAs('public/uploads', $filename);
        } else {
            $filename = Null;
        }

        // On crée un nouvel utilisateur
        $decoration = Decoration::create([
            'name_decoration' => $request->name_decoration,
            'description_decoration' => $request->description_decoration,
            'price_decoration' => $request->price_decoration,
            'picture_decoration' => $filename,
            'categorie_decoration_id' => $request->categorie_decoration_id,
            'quantity_editable_decoration' => $request->quantity_editable_decoration
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
            'categorie_decoration_id' => 'required',
            'quantity_editable_decoration' => 'required',
        ]);

        $filename = "";

        if ($request->hasFile('picture_decoration')) {
            // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg"
            $filenameWithExt = $request->file('picture_decoration')->getClientOriginalName();
            $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //  On récupère l'extension du fichier, résultat $extension : ".jpg"
            $extension = $request->file('picture_decoration')->getClientOriginalExtension();
            // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $fileNameToStore : "jeanmiche_20220422.jpg"
            $filename = $filenameWithoutExt . '_' . time() . '.' . $extension;
            // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin /storage/app
            $path = $request->file('picture_decoration')->storeAs('public/uploads', $filename);
        } else {
            $filename = Null;
        }



        // On crée un nouvel utilisateur
        $decoration->update([
            'name_decoration' => $request->name_decoration,
            'description_decoration' => $request->description_decoration,
            'price_decoration' => $request->price_decoration,
            'picture_decoration' => $filename ?: $decoration->picture_decoration,
            'quantity_editable_decoration' => $request->quantity_editable_decoration,
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
