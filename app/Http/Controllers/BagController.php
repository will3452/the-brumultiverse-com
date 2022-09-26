<?php

namespace App\Http\Controllers;

use App\Models\ShopItem;
use App\Models\StudentShopItem;
use Illuminate\Http\Request;

class BagController extends Controller
{
    public function index () {
        $studentItems = StudentShopItem::whereUserId(auth()->id())->get()->pluck('shop_item_id')->all();

        $items = ShopItem::whereIn('id', $studentItems)->get();
        return view('student.bag.index', compact('items'));
    }
}
