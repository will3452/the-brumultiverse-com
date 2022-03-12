<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file',
        'description',
        'type',
    ];

    const TYPE_REQUIRED = 'Required';
    const TYPE_OPTIONAL = 'Optional';
}
