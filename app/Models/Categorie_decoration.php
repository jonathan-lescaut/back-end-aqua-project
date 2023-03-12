<?php

namespace App\Models;

use App\Models\Decoration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie_decoration extends Model
{
    use HasFactory;
    protected $fillable = ['name_categorie_decoration'];

    public function decorations()
    {
        return $this->hasMany(Decoration::class);
    }
}
