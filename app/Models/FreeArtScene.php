<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeArtScene extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_id',
        'model_type',
        'art_scene_id',
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function artScene()
    {
        return $this->belongsTo(ArtScene::class);
    }
}
