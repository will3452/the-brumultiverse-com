<?php

namespace App\Models\Traits;

use Illuminate\Support\Arr;
use App\Models\StudentShopItem;
use Exception;

trait HasShopItems
{
    public function shopItems () {
        return $this->hasMany(StudentShopItem::class);
    }

    public function addShopItems($data) { // this will add items to the student who buy it
        try {
            $data = Arr::wrap($data);

            foreach ($data as $item) {
                $this->shopItems()->create([
                    'shop_item_id' => $item,
                ]);
            }
            return true;
        } catch (Exception $error) {
            return false;
        }
    }
}
