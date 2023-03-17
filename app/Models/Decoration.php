<?php

namespace App\Models;

use App\Models\Opinion;
use App\Models\Project;
use App\Models\Categorie_decoration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Decoration extends Model
{
    use HasFactory;
    protected $fillable = ['name_decoration', 'description_decoration', 'price_decoration', 'picture_decoration', 'categorie_decoration_id'];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
    public function categorie_decorations()
    {
        return $this->belongsTo(Categorie_decoration::class);
    }
    public function opinions()
    {
        return $this->hasMany(Opinion::class);
    }
}
