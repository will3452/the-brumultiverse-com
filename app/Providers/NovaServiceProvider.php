<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use Laravel\Nova\Nova;
use Pdmfc\NovaCards\Info;
use App\Nova\Metrics\Books;
use App\Nova\Metrics\Films;
use App\Nova\Metrics\Songs;
use App\Nova\Metrics\Users;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Text;
use App\Nova\Metrics\Podcasts;
use Laravel\Nova\Fields\Image;
use App\Nova\Metrics\ArtScenes;
use Laravel\Nova\Fields\Number;
use App\Nova\Metrics\AudioBooks;
use Laravel\Nova\Fields\Textarea;
use Spatie\BackupTool\BackupTool;
use Elezerk\BruProfile\BruProfile;
use Illuminate\Support\Facades\Gate;
use Runline\ProfileTool\ProfileTool;
use Giuga\LaravelNovaSidebar\NovaSidebar;
use Giuga\LaravelNovaSidebar\SidebarLink;
use OptimistDigital\NovaSettings\NovaSettings;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        NovaSettings::addSettingsFields([
            Image::make('Logo'),
            Number::make('Event Day Away')
                ->rules(['gt:0'])
                ->help('default value: 60'),
            Number::make('Maximum Account Per Scholar', 'max_account')
                ->default(fn () => 3),
            Textarea::make('Copyright Disclaimer')
                ->default(fn () => 'I certify that I own the copyright and have obtained written approval for use of all the materials under my name and account, and hold BRUMULTIVERSE free of liabilities should any copyright infringement occurs.'),
            Number::make('Registration Age Restriction', 'registration_age_restriction'),
            Text::make('Bru Link'),
            Text::make('Bruniversity Link'),
        ]);
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array`
     */
    protected function cards()
    {
        if (auth()->user()->hasRole(User::ROLE_NORMAL)) { // this will check if the user is student
            return [
                (new Info())
                ->warning('
                <div class="flex justify-between w-full items-center">
                    Please verify your email address.
                    <a target="_blank"href="/send-email-verification-notification" class="mx-4 btn btn-default block btn-primary">Send Verification.</a>
                </div>
                ')
                ->asHtml()
                ->canSee(fn () =>
                    ! optional(auth()->user())->hasRole(Role::SUPERADMIN) &&
                    ! optional(auth()->user())->hasVerifiedEmail()
                ),
            ];
        }

        return [
            (new Users())
                ->canSee(fn () => auth()->user()->hasRole(Role::SUPERADMIN)),
            (new Books())->canSee(fn () => auth()->user()->isAdmin() || auth()->user()->can('view list: book')),
            (new AudioBooks())->canSee(fn () => auth()->user()->isAdmin() || auth()->user()->can('view list: audio book')),
            (new ArtScenes())->canSee(fn () => auth()->user()->isAdmin() || auth()->user()->can('view list: art scene')),
            (new Films())->canSee(fn () => auth()->user()->isAdmin() || auth()->user()->can('view list: film')),
            (new Podcasts())->canSee(fn () => auth()->user()->isAdmin() || auth()->user()->can('view list: podcast')),
            (new Songs())->canSee(fn () => auth()->user()->isAdmin() || auth()->user()->can('view list: song')),
            (new \Richardkeep\NovaTimenow\NovaTimenow)->timezones([
                'Africa/Nairobi',
                'America/Mexico_City',
                'Australia/Sydney',
                'Europe/Paris',
                'Asia/Manila',
                'Asia/Tokyo',
            ])->defaultTimezone('Africa/Manila')
            ->canSee(function () {
                return config('novax.time_enabled');
            }),
            (new Info())
                ->warning('
                <div class="flex justify-between w-full items-center">
                    Please verify your email address.
                    <a target="_blank"href="/send-email-verification-notification" class="mx-4 btn btn-default block btn-primary">Send Verification.</a>
                </div>
                ')
                ->asHtml()
                ->canSee(fn () =>
                    ! optional(auth()->user())->hasRole(Role::SUPERADMIN) &&
                    ! optional(auth()->user())->hasVerifiedEmail()
                ),
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            // (new NovaSidebar())
            //     ->addLink((new SidebarLink())->setUrl('/library')->setType('_blank')->setName('Library')),
            (new ProfileTool)->canSee(function () {
                return config('novax.profile_enabled');
            }),
            (new BackupTool)->canSee(function ($request) {
                return $request->user()->hasRole(\App\Models\Role::SUPERADMIN) &&
                config('novax.back_up_enabled');
            }),
            // (new BruProfile)->canSee(fn ($request) => ! $request->user()->hasRole(User::ROLE_NORMAL)),
            (new NovaSettings)->canSee(function ($request) {
                return $request->user()->hasRole(\App\Models\Role::SUPERADMIN) &&
                config('novax.setting_enabled');
            }),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
