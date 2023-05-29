<?php

namespace App\Models;

use App\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie_material extends Model
{
    use HasFactory;
    protected $fillable = ['name_categorie_material', 'included_kit'];

    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
