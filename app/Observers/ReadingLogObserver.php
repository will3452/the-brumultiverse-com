<?php

namespace App\Observers;

use App\Helpers\CrystalHelper;
use App\Models\BookContentChapter;
use App\Models\ReadingLog;

class ReadingLogObserver
{
    public function created (ReadingLog $rl) {
        $bc = BookContentChapter::find($rl->chapter_id);
        $crystal = $bc->cost_type;

        if ( $crystal == CrystalHelper::PURPLE_CRYSTAL) {
            $newBalance = auth()->user()->balance['purple_crystal'] - $bc->cost;
            auth()->user()->balance()->update(['purple_crystal' => $newBalance]);
        }

        if ($crystal == CrystalHelper::HALL_PASS) {
            $newBalance = auth()->user()->balance['hall_pass'] - $bc->cost;
            auth()->user()->balance()->update(['hall_pass' => $newBalance]);
        }
    }
}
