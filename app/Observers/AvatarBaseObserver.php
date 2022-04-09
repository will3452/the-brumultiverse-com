<?php

namespace App\Observers;

use App\Models\AvatarBase;
use App\Helpers\FileHelper;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AvatarBaseObserver
{
    public function created(AvatarBase $avatarBase)
    {
        FileHelper::generateImage([90, 140], $avatarBase->path);
    }
}
