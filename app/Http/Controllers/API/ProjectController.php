<?php

namespace App\Http\Controllers\API;

use App\Models\Living;
use App\Models\Project;
use App\Models\Material;
use App\Models\Decoration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Auth::user()->roles != 'ROLE_ADMIN') {
        //     abort(403, 'Action non autorisée.');
        // }
        // On récupère tous les projet
        $project = Project::all();
        // On retourne les informations des projets en JSON
        return response()->json($project);
    }

    public function indexUser($id)
    {
        // if (Auth::user()->roles != 'ROLE_ADMIN') {
        //     abort(403, 'Action non autorisée.');
        // }
        // On récupère tous les projet
        $project = DB::table('projects')->where('projects.user_id', '=', $id)->get();
        // On retourne les informations des projets en JSON
        return response()->json($project);
    }
    public function indexLiving($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Project not found'
            ], 404);
        }
        $project->load(['livings' => function ($query) use ($id) {
            $query->select('livings.*', 'lp.living_quantity')
                ->join('living_project as lp', 'lp.living_id', '=', 'livings.id')
                ->where('lp.project_id', '=', $id);
        }]);

        return response()->json([
            'status' => 'Success',
            'data' => $project
        ]);
    }


    public function indexMaterial($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Project not found'
            ], 404);
        }

        $project->load(['materials' => function ($query) use ($id) {
            $query->select('materials.*', 'lp.material_quantity')
                ->join('material_project as lp', 'lp.material_id', '=', 'materials.id')
                ->where('lp.project_id', '=', $id);
        }]);

        return response()->json([
            'status' => 'Success',
            'data' => $project
        ]);
    }
    public function indexDecoration($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Project not found'
            ], 404);
        }

        $project->load(['decorations' => function ($query) use ($id) {
            $query->select('decorations.*', 'lp.decoration_quantity')
                ->join('decoration_project as lp', 'lp.decoration_id', '=', 'decorations.id')
                ->where('lp.project_id', '=', $id);
        }]);

        return response()->json([
            'status' => 'Success',
            'data' => $project
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
        $request->validate([
            'title_project' => 'required|max:100',
            'start_project' => 'required',
            'c°' => 'nullable',
            'ph' => 'nullable',
            'kh' => 'nullable',
            'gh' => 'nullable',
            'no2' => 'nullable',
            'no3' => 'nullable',
            'user_id' => 'required',

        ]);
        // On crée un nouvel project
        $project = Project::create([
            'title_project' => $request->title_project,
            'start_project' => $request->start_project,
            'c°' => $request->c°,
            'ph' => $request->ph,
            'kh' => $request->kh,
            'gh' => $request->gh,
            'no2' => $request->no2,
            'no3' => $request->no3,
            'user_id' => $request->user_id,
        ]);

        // table pivot LIVING
        // $livings[] = $request->living_id;
        // if (!empty($livings)) {
        //     for ($i = 0; $i < count($livings); $i++) {
        //         $living = Living::find($livings[$i]);
        //         $project->livings()->attach($living);
        //     }
        // }
        // table pivot LIVING
        $livings[] = $request->living_id;
        if (!empty($livings)) {
            $project->livings()->syncWithoutDetaching($livings);
        }
        // table pivot MATERIAL
        // $materials[] = $request->material_id;
        // if (!empty($materials)) {
        //     for ($i = 0; $i < count($materials); $i++) {
        //         $material = Material::find($materials[$i]);
        //         $project->materials()->attach($material);
        //     }
        // }
        $materials = $request->input('material_id', []);
        if (!empty($materials)) {
            $project->materials()->syncWithoutDetaching($materials);
        }

        // table pivot DECORATION
        // $decorations[] = $request->decoration_id;
        // if (!empty($decorations)) {
        //     for ($i = 0; $i < count($decorations); $i++) {
        //         $decoration = Decoration::find($decorations[$i]);
        //         $project->decorations()->attach($decoration);
        //     }
        // }
        $decorations = $request->input('decoration_id', []);
        if (!empty($decorations)) {
            $project->decorations()->syncWithoutDetaching($decorations);
        }

        // On retourne les informations de caté en JSON
        return response()->json([
            'status' => 'Success',
            'data' => $project
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return response()->json($project);
    }



    public function updateLivingQuantity(Request $request, $projectId, $livingId)
    {
        $newQuantity = $request->input('living_quantity');
        $project = Project::findOrFail($projectId);
        $living = Living::findOrFail($livingId);
        $project->livings()->syncWithoutDetaching([
            $living->id => ['living_quantity' => $newQuantity]
        ]);
        return response()->json([
            'status' => 'Mise à jour avec succès'
        ]);
    }
    public function updateMaterialQuantity(Request $request, $projectId, $materialId)
    {
        $newQuantity = $request->input('material_quantity');
        $project = Project::findOrFail($projectId);
        $material = Material::findOrFail($materialId);
        $project->materials()->syncWithoutDetaching([
            $material->id => ['material_quantity' => $newQuantity]
        ]);
        return response()->json([
            'status' => 'Mise à jour avec succès'
        ]);
    }
    public function updateDecorationQuantity(Request $request, $projectId, $decorationId)
    {
        $newQuantity = $request->input('decoration_quantity');
        $project = Project::findOrFail($projectId);
        $decoration = Decoration::findOrFail($decorationId);
        $project->decorations()->syncWithoutDetaching([
            $decoration->id => ['decoration_quantity' => $newQuantity]
        ]);
        return response()->json([
            'status' => 'Mise à jour avec succès'
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // $this->validate($request, [
        //     'title_project' => 'required|max:100',
        //     'start_project' => 'required',
        // ]);
        // // On crée un nouvel projet
        // $project->update([
        //     'title_project' => $request->title_project,
        //     'start_project' => $request->start_project,
        // ]);

        // Array à fournir pour la méthode sync
        // $updateTabId = array();

        //Update living pivot
        // $livings = $request->living_id;
        // if (!empty($livings)) {
        //     for ($i = 0; $i < count($livings); $i++) {
        //         $living = Living::find($livings[$i]);
        //         array_push($updateTabId, $living->id);
        //     }
        //     $project->livings()->sync($updateTabId);
        // }
        $livings = $request->input('living_id', []);
        if (!empty($livings)) {
            $project->livings()->syncWithoutDetaching($livings);
        }

        //Update material pivot
        $materials = $request->input('material_id', []);
        if (!empty($materials)) {
            $project->materials()->syncWithoutDetaching($materials);
        }

        //Update decoration pivot
        $decorations = $request->input('decoration_id', []);
        if (!empty($decorations)) {
            $project->decorations()->syncWithoutDetaching($decorations);
        }

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
    public function destroy(Project $project)
    {
        // On supprime l'utilisateur
        $project->delete();
        // On retourne la réponse JSON
        return response()->json([
            'status' => 'Supprimée avec succès'
        ]);
    }
    public function destroyLiving(Project $project, Living $living)
    {
        $project->livings()->detach($living);
        return response()->json([
            'status' => 'Relation supprimée avec succès'
        ]);
    }
    public function destroyMaterial(Project $project, Material $material)
    {
        $project->materials()->detach($material);
        return response()->json([
            'status' => 'Relation supprimée avec succès'
        ]);
    }
    public function destroyDecoration(Project $project, Decoration $decoration)
    {
        $project->decorations()->detach($decoration);
        return response()->json([
            'status' => 'Relation supprimée avec succès'
        ]);
    }
}
