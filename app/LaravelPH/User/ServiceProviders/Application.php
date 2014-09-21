<?php namespace LaravelPH\User\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use View;

class Application extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        View::addNamespace('User', __DIR__.'/../Views/');
    }
}