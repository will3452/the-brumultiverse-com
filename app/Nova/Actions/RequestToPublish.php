<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class RequestToPublish extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        if (! auth()->user()->can('create publish approval')) {
            return Action::danger('You don\'t have permission to send request.');
        }
        foreach ($models as $model) {

            if ($model->published_at != null) {
                return Action::danger('The work was already Published!');
            }

            $model->publishApprovals()->create([
                'notes' => $fields['notes'],
                'user_id' => auth()->id(),
                'account_id' => $model->account_id,
            ]);
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
            Textarea::make('Notes')
                ->help('maximum of 500 characters only.')
                ->rules(['required', 'max:500']),
        ];
    }
}
