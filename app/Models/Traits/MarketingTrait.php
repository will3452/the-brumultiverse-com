<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;
use App\Helpers\MarketingHelper;

/**
 * [Description MarketingTrait]
 * this trait is for marketing categories such as bulletin, marquee and etc..,
 */
trait MarketingTrait
{
    public function saveNow()
    {
        return $this->update(['status' => MarketingHelper::STATUS_SAVED]);
    }

    public function notSaved()
    {
        return $this->status !== MarketingHelper::STATUS_SAVED;
    }

    public function ref()
    {
        return $this->created_at->format('mdy') . "-" . Str::padLeft($this->package_id, 4, 0) . "-" . $this->id;
    }

    public function type()
    {
        $modelClass = self::class;
        $arr = explode('\\', $modelClass);
        $model = end($arr);
        return $model;
    }
}
