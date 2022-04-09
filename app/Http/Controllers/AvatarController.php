<?php

namespace App\Http\Controllers;

use App\Models\AvatarAsset;
use App\Models\AvatarBase;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function setup()
    {
        return view('student.avatar');
    }

    public function create()
    {
        return view('avatar_create');
    }

    public function apiGet(Request $request)
    {
        $bases = AvatarBase::whereGender($request->gender);
        $hairs = AvatarAsset::whereType(AvatarAsset::TYPE_HAIR)
            ->whereGender($request->gender)
            ->whereForPremium($request->is_premium)->get();
        $clothes = AvatarAsset::whereType(AvatarAsset::TYPE_CLOTHES)
            ->whereGender($request->gender)
            ->whereForPremium($request->is_premium)->get();

        return [
            'bases' => $bases,
            'hairstyles' => $hairs,
            'clothes' => $clothes,
        ];
    }
}
