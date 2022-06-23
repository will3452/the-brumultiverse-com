<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\AvatarBase;
use App\Models\AvatarAsset;
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

    public function getMyAvatar($id) {
        $isExists = Avatar::whereUserId($id)->exists();
        if (! $isExists) {
            return ['base' => 0, 'clothes' => 0, 'hair' => 0];
        }
        $avatar = Avatar::whereUserId($id)->first();
        $response['base'] = optional(AvatarBase::wherePath($avatar->base)->first())->id;
        $response['hair'] = optional(AvatarAsset::wherePath($avatar->hair)->first())->id;
        $response['clothes'] = optional(AvatarAsset::wherePath($avatar->dress)->first())->id;
        return $response;
    }

    public function update(Request $request)
    {
        $base = optional(AvatarBase::find($request->get('base')))->path;
        $hair = optional(AvatarAsset::find($request->get('hair')))->path;
        $dress = optional(AvatarAsset::find($request->get('dress')))->path;

        $avatar = [
            'user_id' => auth()->id(),
            'base' => $base,
            'hair' => $hair,
            'dress' => $dress,
        ];

        Avatar::updateOrCreate(['user_id' => auth()->id()], $avatar);

        auth()->user()->update(['avatar_updated' => true]);

        return redirect(route('student.dorm.me'));
    }

    public function apiGet(Request $request)
    {
        $bases = AvatarBase::whereGender($request->gender)->get();

        foreach ($bases as $value) {
            $value['thumbnail'] = $value->thumbnail;
        }

        $hairs = AvatarAsset::whereType(AvatarAsset::TYPE_HAIR)
            ->whereGender($request->gender)->get();

        foreach ($hairs as $value) {
            $value['thumbnail'] = $value->thumbnail;
        }

        $clothes = AvatarAsset::whereType(AvatarAsset::TYPE_CLOTHES)
            ->whereGender($request->gender)
            ->whereCollege($request->college)->get();

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
