<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\TaskRepository;
use App\Repositories\Eloquent\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
          $this->app->singleton(RoleRepository::class, function ($app) {
              return new RoleRepository();
          });
          $this->app->singleton(TaskRepository::class, function ($app) {
              return new TaskRepository();
          });
          $this->app->singleton(UserRepository::class, function ($app) {
              return new UserRepository();
          });
    }

    public function provides()
    {
          return [
              RoleRepository::class,
              TaskRepository::class,
              UserRepository::class,
          ];
     }

}
