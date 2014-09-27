<?php namespace Tests\Unit\LaravelPH\Job\Presenters\Factories;

use TestCase;
use LaravelPH\Job\Presenters\Factories\JobPresenterFactory;
use Job;

class JobPresenterFactoryTest extends TestCase
{
    public function testMakeShouldCreateAJobPresenterInstance()
    {
        $factory = new JobPresenterFactory;
        $jobPresenter = $factory->make(new Job);
        $this->assertInstanceOf('LaravelPH\Job\Presenters\JobPresenter', $jobPresenter);
    }

}