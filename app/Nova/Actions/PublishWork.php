<?php

namespace App\Nova\Actions;

use App\Models\Group;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use App\Models\PublishApproval;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PublishWork extends Action
{
    use InteractsWithQueue, Queueable;

    public function updateRequest($requests)
    {
        foreach ($requests as $r) { // this will update
            $r->update([
                'approved_at' => now(),
                'status' => PublishApproval::STATUS_APPROVED,
                'approved_at_user_id' => auth()->id(),
            ]);


        }
    }
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $requests = $model->publishApprovals;

            $this->updateRequest($requests); // this will update all rqeuest to approved state.

            $model->update([
                'published_at' => $fields['date'],
            ]);

            if ($model->has('groups')) {
                $model->groups()->first()->update([
                    'status' => Group::STATUS_ACTIVE,
                    'approved_by_user_id' => auth()->id(),
                    'approved_at' => now()
                ]);
            }
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('Date')
                ->rules(['required'])
        ];
    }
}
