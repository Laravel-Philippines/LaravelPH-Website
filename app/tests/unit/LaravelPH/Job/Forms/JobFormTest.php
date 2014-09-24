<?php namespace Tests\Unit\LaravelPH\Job\Forms;

use Illuminate\Auth\AuthManager;
use TestCase;

use LaravelPH\Job\Forms\JobForm;
use Job;

class JobFormTest extends TestCase
{
    protected $form;

    public function setUp()
    {
        parent::setUp();
        $this->form = new JobForm($this->app->make('validator'), $this->app->make('auth'), new Job);
    }

    public function testCreateShouldReturnFalseWhenPassedWithAnEmptyArray()
    {
        $this->assertFalse($this->form->create([]));
    }

    public function testCreateShouldReturnTrueWhenPassedWithValidInputs()
    {
        $this->createAndLoginUser();

        $inputs = [
            'title' => 'php dev',
            'description' => 'should be familiar w/ laravel',
        ];

        $this->assertTrue($this->form->create($inputs));
    }

    public function testCreateShouldReturnFalseWhenTitleIsEmpty()
    {
        $this->createAndLoginUser();

        $inputs = [
            'title' => '',
            'description' => 'should be familiar w/ laravel',
        ];

        $this->assertFalse($this->form->create($inputs));
    }

    public function testCreateShouldReturnFalseWhenDescriptionIsEmpty()
    {
        $this->createAndLoginUser();

        $inputs = [
            'title' => 'php dev',
            'description' => '',
        ];

        $this->assertFalse($this->form->create($inputs));
    }

}