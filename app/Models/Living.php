<?php

namespace App\Models;

use App\Models\Opinion;
use App\Models\Project;
use App\Models\Categorie_living;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Living extends Model
{
    use HasFactory;
    protected $fillable = ['name_living', 'description_living', 'price_living', 'categorie_living_id', 'picture_living', 'quantity_editable_living'];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
    public function categorie_livings()
    {
        return $this->belongsTo(Categorie_living::class);
    }
    public function opinions()
    {
        return $this->hasMany(Opinion::class);
    }
}
