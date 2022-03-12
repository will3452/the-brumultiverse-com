<?php

namespace App\Nova\Actions\Invitation;

use Laravel\Nova\Nova;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Accept extends Action
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
        foreach ($models as $model) {
            $model->model()->update([
                'confirmed_at' => now(),
                'status' => (get_class($model->model))::STATUS_CONFIRMED,
            ]);
            $groupId = $model->model->group_id;
            $model->delete();
            return Action::redirect(Nova::path() . '/resources/groups/' . $groupId);
        }


    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
