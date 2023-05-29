<?php

namespace App\Http\Controllers\API;

use App\Models\Living;
use Illuminate\Http\Request;
use App\Models\Categorie_living;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LivingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livings = DB::table('livings')
            ->join('categorie_livings', 'livings.categorie_living_id', '=', 'categorie_livings.id')
            ->select('livings.*', 'categorie_livings.name_categorie_living')
            ->get();
        return response()->json([
            'status' => 'Success',
            'data' => $livings,
        ]);
    }
    public function indexCategorie(Categorie_living $categorie_living)
    {
        $categorie_living = DB::table('livings')
            ->join('categorie_livings', 'livings.categorie_living_id', '=', 'categorie_livings.id')
            ->select('livings.*')
            ->where('categorie_livings.id', '=', $categorie_living->id)
            ->get();

        return response()->json([
            'status' => 'Success',
            'data' => $categorie_living,
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
            'name_living' => 'required|max:100',
            'description_living' => 'required',
            'price_living' => 'required',
            'categorie_living_id' => 'required',
            'quantity_editable_living' => 'required',
            'unique_living_category' => 'required',

        ]);

        $filename = "";
        if ($request->hasFile('picture_living')) {
            // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg"
            $filenameWithExt = $request->file('picture_living')->getClientOriginalName();
            $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //  On récupère l'extension du fichier, résultat $extension : ".jpg"
            $extension = $request->file('picture_living')->getClientOriginalExtension();
            // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $fileNameToStore : "jeanmiche_20220422.jpg"
            $filename = $filenameWithoutExt . '_' . time() . '.' . $extension;
            // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin /storage/app
            $path = $request->file('picture_living')->storeAs('public/uploads', $filename);
        } else {
            $filename = Null;
        }

        // On crée un nouvel utilisateur
        $living = Living::create([
            'name_living' => $request->name_living,
            'description_living' => $request->description_living,
            'price_living' => $request->price_living,
            'categorie_living_id' => $request->categorie_living_id,
            'quantity_editable_living' => $request->quantity_editable_living,
            'unique_living_category' => $request->unique_living_category,
            'liter_min' => $request->liter_min,
            'number_max' => $request->number_max,
            'number_min' => $request->number_min,
            'picture_living' => $filename,
        ]);
        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json([
            'status' => 'Success',
            'data' => $living,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Living $living)
    {
        return response()->json($living);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Living $living)
    {
        $this->validate($request, [
            'name_living' => 'required|max:100',
            'description_living' => 'required',
            'price_living' => 'required',
            'categorie_living_id' => 'required',
            'quantity_editable_living' => 'required',
            'unique_living_category' => 'required',

        ]);
        $filename = "";
        if ($request->hasFile('picture_living')) {
            // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg"
            $filenameWithExt = $request->file('picture_living')->getClientOriginalName();
            $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //  On récupère l'extension du fichier, résultat $extension : ".jpg"
            $extension = $request->file('picture_living')->getClientOriginalExtension();
            // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $fileNameToStore : "jeanmiche_20220422.jpg"
            $filename = $filenameWithoutExt . '_' . time() . '.' . $extension;
            // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin /storage/app
            $path = $request->file('picture_living')->storeAs('public/uploads', $filename);
        } else {
            $filename = Null;
        }
        // On crée un nouvel utilisateur
        $living->update([
            'name_living' => $request->name_living,
            'description_living' => $request->description_living,
            'price_living' => $request->price_living,
            'picture_living' => $filename ?: $living->picture_living, // use existing picture if no new file is uploaded
            'categorie_living_id' => $request->categorie_living_id,
            'quantity_editable_living' => $request->quantity_editable_living,
            'unique_living_category' => $request->unique_living_category,
            'liter_min' => $request->liter_min,
            'number_min' => $request->number_min,
            'number_max' => $request->number_max,
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
    public function destroy(Living $living)
    {
        // On supprime l'utilisateur
        $living->delete();
        // On retourne la réponse JSON
        return response()->json([
            'status' => 'Supprimée avec succès'
        ]);
    }
}
