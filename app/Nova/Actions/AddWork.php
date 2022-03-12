<?php

namespace App\Nova\Actions;

use App\Models\ClassWork;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Fields\Select;

class AddWork extends Action
{
    use InteractsWithQueue, Queueable;

    public function getModel($str): string
    {
        return "\\App\\Models\\" . Str::studly($str);
    }

    public $resourceModel;

    public function __construct(string $type)
    {
        $this->resourceModel = $this->getModel($type);
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
        foreach($models as $model) {
            $exists = ClassWork::where([
                'work_type' => $this->getModel($model->type),
                'work_id' => $fields['work_id'],
                'class_id' => $model->id,
                'class_type' => get_class($model),
            ])->exists();

            if ($exists) {
                return Action::danger('Book was already added!');
            }
            ClassWork::create([
                'work_type' => $this->getModel($model->type),
                'work_id' => $fields['work_id'],
                'class_id' => $model->id,
                'class_type' => get_class($model),
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
        $accountIds = auth()->user()->accounts()->get()->pluck('id')->toArray();
        return [
            Select::make('Select Work', 'work_id')
                ->rules(['required'])
                ->options(($this->resourceModel)::whereIn('account_id', $accountIds)->get()->pluck('title', 'id')),
        ];
    }
}
