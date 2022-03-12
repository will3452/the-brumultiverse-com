<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prologue extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'model_type',
        'body',
    ];

    public function model()
    {
        return $this->morphTo();
    }
}
