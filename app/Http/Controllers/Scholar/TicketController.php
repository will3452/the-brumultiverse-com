<?php

namespace App\Http\Controllers\Scholar;

use App\Events\NewTicketHasBeenCreated;
use App\Helpers\FormHelper;
use App\Http\Controllers\Controller;
use App\Models\Chapter;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function getOriginalContent($model, $raw)
    {
        $content = [];
        $keys = collect($raw)->keys();

        foreach ($keys as $key) {
            $content[$key] = $model[$key];
        }
        return $content;
    }

    public function getModel($type, $id)
    {
        return ("\\App\\Models\\$type")::findOrFail($id);
    }

    public function getOldAndNewState($model, $raw)
    {
        $oldContent = $this->getOriginalContent($model, $raw);
        $data['old_state'] = json_encode($oldContent); // just convert to string of json

        $newContent = $raw;
        $data['new_state'] = json_encode($newContent);

        return $data;
    }

    public function attachAccount($model, $data)
    {

        if (get_class($model) === Chapter::class) {
            $data['user_id'] = $model->model->user_id;
            $data['account_id'] = $model->model->account_id;
            return $data;
        }

        $data['user_id'] = $model->user_id;
        $data['account_id'] = $model->account_id;


        return $data;
    }

    public function addNotes($data, $notes)
    {
        $data['requestor_notes'] = $notes;

        return $data;
    }

    public function storeUpdateTicket(Request $r)
    {
        $raw = FormHelper::removeDataWithKeys(['id', '_type', '_token'], $r->all());

        $model = $this->getModel($r->_type, $r->id);

        $oldAndNew = $this->getOldAndNewState($model, $raw);

        $withNotes = $this->addNotes($oldAndNew, $r->requestor_notes);

        $data = $this->attachAccount($model, $withNotes);

        $ticket = $model->tickets()->create($data);

        event(new NewTicketHasBeenCreated($ticket));

        return back()->withSuccess('Submitted');
    }
}
