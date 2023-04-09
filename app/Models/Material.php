<?php

namespace App\Models;

use App\Models\Opinion;
use App\Models\Project;
use App\Models\Categorie_material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use HasFactory;
    protected $fillable = ['name_material', 'description_material', 'price_material', 'picture_material', 'categorie_material_id', 'quantity_editable_material'];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
    public function categorie_materials()
    {
        return $this->belongsTo(Categorie_material::class);
    }
    public function opinions()
    {
        return $this->hasMany(Opinion::class);
    }
}
