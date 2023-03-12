<?php

namespace App\Models;

use App\Models\User;
use App\Models\Living;
use App\Models\Material;
use App\Models\Decoration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['title_project', 'start_project', 'c°', 'ph', 'kh', 'gh', 'no2', 'no3', 'user_id'];


    public function livings()
    {
        return $this->belongsToMany(Living::class);
    }
    public function materials()
    {
        return $this->belongsToMany(Material::class);
    }
    public function decorations()
    {
        return $this->belongsToMany(Decoration::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
