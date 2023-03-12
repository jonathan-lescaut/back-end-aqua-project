<?php

namespace App\Models;

use App\Models\Living;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie_living extends Model
{
    use HasFactory;
    protected $fillable = ['name_categorie_living'];

    public function livings()
    {
        return $this->hasMany(Living::class);
    }

}
