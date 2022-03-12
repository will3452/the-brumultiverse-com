<?php

namespace App\Nova\Actions;

use App\Models\Level;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class SetHeatLevel extends Action
{
    use InteractsWithQueue, Queueable;
    public $model;

    public function __construct($model)
    {
        $this->model = $model;
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
            $model->update([
                'heat_level_id' => $fields['heat_level_id']
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
            Select::make('Heat Level', 'heat_level_id')
                ->options(fn () => Level::whereGenreId($this->model->genre_id)->whereType(Level::TYPE_HEAT)->get()->pluck('name', 'id'))
        ];
    }
}
