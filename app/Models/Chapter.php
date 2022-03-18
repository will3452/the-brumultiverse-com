<?php

namespace App\Models;

use App\Helpers\CrystalHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'model_type',
        'title',
        'cost_type',
        'cost',
        'type',
        'number',
        'content', // pdf, text
        'notes', //authors note
        'description',
        'age_restriction',
    ];

    const TYPE_PREMIUM = 'Premium';
    const TYPE_REGULAR = 'Regular';
    const TYPE_SPECIAL = 'Special';
    const TYPE_PREMIUM_WITH_FREE_ART_SCENE = 'Premium w/ Free Art Scene';

    const TYPE_OPTIONS = [
        self::TYPE_PREMIUM,
        self::TYPE_REGULAR,
        self::TYPE_SPECIAL,
        // self::TYPE_PREMIUM_WITH_FREE_ART_SCENE,
    ];

    const DEFAULT_COST_TYPE = CrystalHelper::HALL_PASS;

    public function model()
    {
        return $this->morphTo();
    }
}
