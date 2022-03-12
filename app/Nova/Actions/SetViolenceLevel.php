<?php

namespace App\Nova\Actions;

use App\Models\Level;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetViolenceLevel extends Action
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
                'violence_level_id' => $fields['violence_level_id']
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
            Select::make('Violence Level', 'violence_level_id')
                ->options(fn () => Level::whereGenreId($this->model->genre_id)->whereType(Level::TYPE_VIOLENCE)->get()->pluck('name', 'id'))
        ];
    }
}
