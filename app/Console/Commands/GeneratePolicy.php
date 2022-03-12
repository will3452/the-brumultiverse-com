<?php

namespace App\Console\Commands;

use App\Models\Policy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GeneratePolicy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:policy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'scan all file in model dir and generate policy from it.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $existingPolicies = Policy::get()->pluck('name');
        $excludes = $existingPolicies->merge(
            [
                    '..',
                    '.',
                    'Traits',
                    'HeatLevel.php',
                    'ViolenceLevel.php',
                    'ClassWork.php',
            ]
        );

        //scan the models
        $models = scandir('./app/models/');

        //remove the excludes
        $models = collect($models)->filter(fn ($e) => !$excludes->contains($e));

        $models->each(function ($model) {
            $origModel = $model; // just have a copy of the model
            $policyName = str_replace('.php', 'Policy', $model);
            $modelName = preg_replace('/(\w+).(\w+)/i', '$1', $model);
            $this->call('make:policy', [
                'name' => $policyName,
                '--model' => $modelName,
            ]);
            //register model
            Policy::create(['name' => $origModel]);
        });
        return error_log('Success!');
    }
}
