<?php namespace Tests\Unit\LaravelPH\Session\Forms;

use Illuminate\Auth\AuthManager;
use TestCase;

use LaravelPH\Session\Forms\SessionForm;
use User;

class SessionFormTest extends TestCase
{
    public function testCreateShouldReturnFalseWhenPassedWithInvalidCredentials()
    {
        $form = new SessionForm($this->app->make('auth'));
        $this->assertFalse($form->create([]));
    }

    public function testCreateShouldReturnTrueWhenPassedWithValidCredentials()
    {
        $this->createUser();

        $inputs = [
            'username' => $this->user->username,
            'password' => $this->rawPassword
        ];

        $form = new SessionForm($this->app->make('auth'));
        $this->assertTrue($form->create($inputs));
    }

}