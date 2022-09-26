<?php

namespace App\Http\Controllers;

use App\Models\ShopItem;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index () {
        $items = ShopItem::latest()->get();
        return view('student.shop.index', compact('items'));
    }

    public function proceedToBuy (Request $request) {
        $item = ShopItem::find($request->itemId);
        if (! $item) {
            toast('Item not found!', 'info');
            return back();
        }

        $costType = costTypeEncode($item->crystal_type);

        if (! auth()->user()->hasEnoughBalanceOf($costType, $item->price)) {
            toast('Buy Crystals/Ticket to continue','info');
            return back();
        } else {
            if (! auth()->user()->deductBalance($costType, $item->price))
            {
                toast('Something went wrong!','error');
                return back();
            }
        }

        if (auth()->user()->addShopItems($item->id)) {
            toast('Done!', 'success');
        } else {
            toast('something went wrong!', 'danger');
        }

        return back();
    }
}
