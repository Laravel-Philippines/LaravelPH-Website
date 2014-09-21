<?php namespace LaravelPH\LaravelPH\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use View;

class Application extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        View::addNamespace('LaravelPH', __DIR__.'/../Views/');
    }
}