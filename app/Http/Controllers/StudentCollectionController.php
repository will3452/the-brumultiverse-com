<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentCollectionController extends Controller
{
    public $model = null;
    public function validateTransaction($type, $id): bool
    {
        if (is_null($this->model)) {
            $this->model = getFullModel($type)::findOrFail($id);
        }

        if ($this->model->cost != 0 || $this->model->cost != null) {
            $costType = costTypeEncode($this->model->cost_type);
            return auth()->user()->hasEnoughBalanceOf($costType, $this->model->cost);
        }

        return true;
    }
    public function addToCollection ($type, $id) {
        if (is_null($this->model)) {
            $this->model = getFullModel($type)::findOrFail($id);
        }
        if (! $this->validateTransaction($type, $id)) {
            toast('Buy Crystals/Ticket to continue','info');
            return redirect(route('student.buy.crystal') . "?redirect=student.add.to.collection&type=route&payload=type:$type,id:$id");// todo will redirect to the book if finish purchasing crystal
        } else { // deduct balance
            if (! auth()->user()->deductBalance(costTypeEncode($this->model->cost_type),$this->model->cost))
            {
                toast('Something went wrong!','error');
                return back();
            }
        }
        auth()->user()->studentCollections()->create(['model_type' => getFullModel($type), 'model_id' => $id]);
        toast('Work has been added to you collection','success');
        return back()->withSuccess('work has been added to your collection!');
    }
}
