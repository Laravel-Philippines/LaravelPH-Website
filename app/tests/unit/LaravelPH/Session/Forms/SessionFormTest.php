<?php namespace Tests\Unit\LaravelPH\Session\Forms;

use Illuminate\Auth\AuthManager;
use TestCase;

use LaravelPH\Session\Forms\SessionForm;
use User;

class SessionFormTest extends TestCase
{
    protected $form;

    public function setUp()
    {
        parent::setUp();
        $this->form = new SessionForm($this->app->make('auth'));
    }

    public function testCreateShouldReturnFalseWhenPassedWithInvalidCredentials()
    {
        $this->assertFalse($this->form->create([]));
    }

    public function testCreateShouldReturnTrueWhenPassedWithValidCredentials()
    {
        $this->createUser();

        $inputs = [
            'username' => $this->user->username,
            'password' => $this->rawPassword
        ];

        $this->assertTrue($this->form->create($inputs));
    }

}