<?php namespace LaravelPH\User\Forms;

use Illuminate\Validation\Factory as ValidatorFactory;

use User;

class UserForm
{
    protected $rules = [
        'username' => 'required|between:3,16|unique:users',
        'password' => 'required|min:8|confirmed',
        'password_confirmation' => 'required|min:8',
        'email' => 'required|email|unique:users'
    ];

    protected $validatorFactory;
    protected $user;

    public function __construct(ValidatorFactory $validatorFactory,
                                User $user)
    {
        $this->validatorFactory = $validatorFactory;
        $this->user = $user;
    }

    public function create(array $input)
    {
        if ( ! $this->validate($input)) {
            return false;
        }

        $this->user->username = $input['username'];
        $this->user->email = $input['email'];
        $this->user->password = $input['password'];
        return $this->user->save();
    }

    public function validate($data)
    {
        $this->validator = $this->validatorFactory->make($data, $this->rules);
        return $this->validator->passes();
    }

    public function errors()
    {
        return $this->validator->errors();
    }
}