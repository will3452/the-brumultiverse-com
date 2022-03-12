<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'generated_by_id',
        'value',
    ];

    const NOT_USED = 'Not Used';
    const USED = 'Used';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function generator()
    {
        return $this->belongsTo(User::class, 'generated_by_id');
    }

    //properties
    public function getStatusAttribute(): string
    {
        return $this->user_id === null ? self::NOT_USED : self::USED;
    }

    //helper
    public static function generate(): string
    {
        // desired format XXXX-XXXX-XXXXXX (year)(entry number today)(database count)
        $year = now()->format('Y');
        $countToday = self::whereDate('created_at', now())->count();
        $count = self::count();
        $result =  $year . Str::padLeft($countToday, 4, '0') . Str::padLeft($count, 6, '0');

        self::create([
            'user_id' => request()->viaResourceId,
            'value' => $result,
            'generated_by_id' => auth()->id(),
        ]);
        return true;
    }

    public static function checkIfValid($givenAan): bool
    {
        return self::whereValue($givenAan)
            ->whereNull('user_id')
            ->exists();
    }
}
