<?php

namespace App\Models;

use App\Models\User;
use App\Models\Living;
use App\Models\Material;
use App\Models\Decoration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opinion extends Model
{
    use HasFactory;
    protected $fillable = ['content_opinion', 'note_opinion', 'user_id', 'living_id', 'decoration_id', 'material_id'];

    public function livings()
    {
        return $this->belongsTo(Living::class);
    }
    public function decorations()
    {
        return $this->belongsTo(Decoration::class);
    }
    public function materials()
    {
        return $this->belongsTo(Material::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
