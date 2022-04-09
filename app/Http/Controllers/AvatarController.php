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
        $bases = AvatarBase::whereGender($request->gender)->get();

        foreach ($bases as $value) {
            $value['thumbnail'] = $value->thumbnail;
        }

        $hairs = AvatarAsset::whereType(AvatarAsset::TYPE_HAIR)
            ->whereGender($request->gender)
            ->orWhere([
                'for_premium' => $request->is_premium,
                'type' => AvatarAsset::TYPE_HAIR,
            ])->get();

        foreach ($hairs as $value) {
            $value['thumbnail'] = $value->thumbnail;
        }

        $clothes = AvatarAsset::whereType(AvatarAsset::TYPE_CLOTHES)
            ->whereGender($request->gender)
            ->orWhere([
                'for_premium' => $request->is_premium,
                'type' => AvatarAsset::TYPE_CLOTHES,
            ])->get();

        foreach ($clothes as $value) {
            $value['thumbnail'] = $value->thumbnail;
        }

        return [
            'bases' => $bases,
            'hairstyles' => $hairs,
            'clothes' => $clothes,
        ];
    }
}
