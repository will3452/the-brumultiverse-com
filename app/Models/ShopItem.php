<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'description',
        'price',
        'crystal_type',
        'image',
        'for_app',
    ];

    public function category () {
        return $this->belongsTo(ShopCategory::class, 'category_id');
    }
}
