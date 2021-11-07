<?php

namespace App\Providers;

use App\Models\User;
use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(Newsletter::class, function () { // quand on demande qq part dans l'app
            $client = new ApiClient();

            $client->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => config('services.mailchimp.server-prefix'),
            ]);

            return new MailchimpNewsletter($client); //return instance Newsletter avec qqch qu'on
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Paginator::useTailwind();

        // Lever l'interdiction sur le mass-assignment => pas besoin de guarded/fillable
        Model::unguard();

        Gate::define('admin', function (User $user) {
            return $user->username === 'emmanuelle-vo';
        });

        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });
    }
}
