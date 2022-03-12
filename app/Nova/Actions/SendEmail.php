<?php

namespace App\Nova\Actions;

use App\Mail\GenericMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;

class SendEmail extends Action
{
    use InteractsWithQueue, Queueable;
    public $hasEmail;

    public function __construct($hasEmail = true)
    {
        $this->hasEmail = $hasEmail;
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
            if (! $this->hasEmail) {
                Mail::to($fields['email'])->send(new GenericMail($fields['introduction'], $fields['message']));
            } else if (get_class($model) === 'App\\Models\\User') {
                Mail::to($model)->send(new GenericMail($fields['introduction'], $fields['message']));
            } else {
                Mail::to($model->user)->send(new GenericMail($fields['introduction'], $fields['message']));
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
        if ($this->hasEmail) {
            return [
                Text::make('Subject', 'introduction')
                    ->rules(['required']),
                Trix::make('Message')
                    ->rules(['required']),
            ];
        }

        return [
            Text::make('Email')
                ->rules(['required', 'email']),
            Text::make('Subject', 'introduction')
                ->rules(['required']),
            Trix::make('Message')
                ->rules(['required']),
        ];

    }
}
