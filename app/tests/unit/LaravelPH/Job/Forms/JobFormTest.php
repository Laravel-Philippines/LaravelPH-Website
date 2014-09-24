<?php namespace Tests\Unit\LaravelPH\Job\Forms;

use Illuminate\Auth\AuthManager;
use TestCase;

use LaravelPH\Job\Forms\JobForm;
use Job;

class JobFormTest extends TestCase
{
    public function testCreateShouldReturnFalseWhenPassedWithAnEmptyArray()
    {
        $form = new JobForm($this->app->make('validator'), $this->app->make('auth'), new Job);
        $this->assertFalse($form->create([]));
    }

    public function testCreateShouldReturnTrueWhenPassedWithValidInputs()
    {
        $this->createUser();
        $this->be($this->user);

        $inputs = [
            'title' => 'php dev',
            'description' => 'should be familiar w/ laravel',
        ];

        $form = new JobForm($this->app->make('validator'), $this->app->make('auth'), new Job);
        $this->assertTrue($form->create($inputs));
    }

    public function testCreateShouldReturnFalseWhenTitleIsEmpty()
    {
        $this->createUser();
        $this->be($this->user);

        $inputs = [
            'title' => '',
            'description' => 'should be familiar w/ laravel',
        ];

        $form = new JobForm($this->app->make('validator'), $this->app->make('auth'), new Job);
        $this->assertFalse($form->create($inputs));
    }

    public function testCreateShouldReturnFalseWhenDescriptionIsEmpty()
    {
        $this->createUser();
        $this->be($this->user);

        $inputs = [
            'title' => 'php dev',
            'description' => '',
        ];

        $form = new JobForm($this->app->make('validator'), $this->app->make('auth'), new Job);
        $this->assertFalse($form->create($inputs));
    }

}