<?php namespace LaravelPH\User\Forms;

use Illuminate\Validation\Factory as ValidatorFactory;

use User;
use LaravelPH\Common\Forms\BaseForm;

class UserForm extends BaseForm
{
    protected $rules = [
        'username' => 'required|between:3,16|unique:users',
        'password' => 'required|min:8|confirmed',
        'password_confirmation' => 'required|min:8',
        'email' => 'required|email|unique:users'
    ];

    protected $user;

    public function __construct(ValidatorFactory $validatorFactory,
                                User $user)
    {
        parent::__construct($validatorFactory);
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

}