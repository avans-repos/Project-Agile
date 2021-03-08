<?php

namespace App\Providers {

  use Illuminate\Support\ServiceProvider;
  use Service\AuthenticationService;

  class AppServiceProvider extends ServiceProvider
  {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind(AuthenticationService::class, function () {
        return new AuthenticationService();
      });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      //
    }
  }
}
