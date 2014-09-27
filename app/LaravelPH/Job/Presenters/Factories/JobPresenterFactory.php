<?php namespace LaravelPH\Job\Presenters\Factories;

use GrahamCampbell\Markdown\Markdown;
use ParsedownExtra;

use LaravelPH\Job\Presenters\JobPresenter;
use Job;

class JobPresenterFactory
{
    public function make(Job $job)
    {
        return new JobPresenter($job, new Markdown(new ParsedownExtra));
    }
}