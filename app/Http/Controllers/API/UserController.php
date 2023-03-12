<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $this->middleware('CheckRole:ROLE_ADMIN');
        $users = User::all();
        return response()->json([
            'status' => 'Success',
            'data' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // On retourne les informations des utilisateurs en JSON
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd($user);
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100',
            'roles' => 'required|string'
        ]);
        // On modifie l'utilisateur
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'roles' => $request->roles
        ]);
        // On retourne les informations du sondage modifié en JSON
        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // On supprime le message de contact
        // if (Auth::user()->roles != 'ROLE_ADMIN') {
        //     abort(403, 'Action non autorisée.');
        // }
        $user->delete();
        // On retourne la réponse JSON
        return response()->json([
            'status' => 'Profil supprimé avec succès'
        ]);
    }
}
