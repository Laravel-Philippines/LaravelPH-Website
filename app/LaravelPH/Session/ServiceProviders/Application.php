<?php namespace LaravelPH\Session\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use View;

class Application extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        View::addNamespace('Session', __DIR__.'/../Views/');
    }
}