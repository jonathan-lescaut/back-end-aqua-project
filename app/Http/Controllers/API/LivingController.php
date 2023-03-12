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

        ###################################################
        // // On récupère tous les caté
        // $living = Living::all();
        // $categories_living = Categorie_living::all();
        // // On retourne les informations des caté en JSON
        // return response()->json($living);
        ###################################################
        // $livings = DB::table('livings')->get();
        // foreach ($livings as $living) {
        //     echo $living->name_living;
        // }
        ###################################################
        $livings = DB::table('livings')

            ->join('categorie_livings', 'livings.categorie_living_id', '=', 'categorie_livings.id')
            ->select('livings.*', 'categorie_livings.name_categorie_living')
            ->get();


        return response()->json([
            'status' => 'Success',
            'data' => $livings,
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
            'categorie_living_id' => 'required'
        ]);
        // On crée un nouvel utilisateur
        $living = Living::create([
            'name_living' => $request->name_living,
            'description_living' => $request->description_living,
            'price_living' => $request->price_living,
            'categorie_living_id' => $request->categorie_living_id,
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

        ]);
        // On crée un nouvel utilisateur
        $living->update([
            'name_living' => $request->name_living,
            'description_living' => $request->description_living,
            'price_living' => $request->price_living,
            'categorie_living_id' => $request->categorie_living_id,


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
