<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $models = ['Customer', 'Subscription', 'Pet'];

        foreach ($models as $model) {
            $this->app->bind("App\Repositories\Contracts\\{$model}RepositoryInterface", "App\Repositories\\{$model}RepositoryEloquent");
        }

    }
}
