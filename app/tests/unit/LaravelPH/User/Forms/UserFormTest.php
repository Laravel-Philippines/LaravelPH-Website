<?php namespace Tests\Unit\LaravelPH\User\Forms;

use Illuminate\Auth\AuthManager;
use TestCase;

use LaravelPH\User\Forms\UserForm;
use User;

class UserFormTest extends TestCase
{
    protected $form;

    public function setUp()
    {
        parent::setUp();
        $this->form = new UserForm($this->app->make('validator'), new User);
    }

    public function testCreateShouldReturnFalseWhenPassedWithAnEmptyArray()
    {
        $this->assertFalse($this->form->create([]));
    }

    public function testCreateShouldReturnTrueWhenPassedWithValidInputs()
    {
        $inputs = [
            'username' => 'johndoe25',
            'password' => 'dummypassword',
            'password_confirmation' => 'dummypassword',
            'email' => 'johndoe25@gmail.com'
        ];

        $this->assertTrue($this->form->create($inputs));
    }

    public function testCreateShouldReturnFalseWhenEmailIsInvalid()
    {
        $inputs = [
            'username' => 'johndoe25',
            'password' => 'dummypassword',
            'password_confirmation' => 'dummypassword',
            'email' => 'invalid email'
        ];

        $this->assertFalse($this->form->create($inputs));
    }

    public function testCreateShouldReturnFalseWhenPasswordIsLessThan8Characters()
    {
        $inputs = [
            'username' => 'johndoe25',
            'password' => '1234567',
            'password_confirmation' => '1234567',
            'email' => 'johndoe25@gmail.com'
        ];

        $this->assertFalse($this->form->create($inputs));
    }

    public function testCreateShouldReturnFalseWhenPasswordDoesntMatchPasswordConfirmation()
    {
        $inputs = [
            'username' => 'johndoe25',
            'password' => 'dummypassword',
            'password_confirmation' => 'imdifferent',
            'email' => 'johndoe25@gmail.com'
        ];

        $this->assertFalse($this->form->create($inputs));
    }

    public function testCreateShouldReturnFalseWhenUsernameIsLessThan3Characters()
    {
        $inputs = [
            'username' => 'aa',
            'password' => 'dummypassword',
            'password_confirmation' => 'dummypassword',
            'email' => 'johndoe25@gmail.com'
        ];

        $this->assertFalse($this->form->create($inputs));
    }

    public function testCreateShouldReturnFalseWhenUsernameIsMoreThan16Characters()
    {
        $inputs = [
            'username' => 'averylongusernameaverylongusername',
            'password' => 'dummypassword',
            'password_confirmation' => 'dummypassword',
            'email' => 'johndoe25@gmail.com'
        ];

        $this->assertFalse($this->form->create($inputs));
    }

    public function testCreateShouldReturnFalseWhenEmailIsAlreadyUsed()
    {
        $this->createUser();

        $inputs = [
            'username' => 'ken25',
            'password' => 'dummypassword',
            'password_confirmation' => 'dummypassword',
            'email' => $this->user->email
        ];

        $this->assertFalse($this->form->create($inputs));
    }

    public function testCreateShouldReturnFalseWhenUsernameIsAlreadyUsed()
    {
        $this->createUser();

        $inputs = [
            'username' => $this->user->username,
            'password' => 'dummypassword',
            'password_confirmation' => 'dummypassword',
            'email' => 'ken@gmail.com'
        ];

        $this->assertFalse($this->form->create($inputs));
    }

}