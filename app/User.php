<?php

namespace App;

<<<<<<< HEAD
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
=======
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Validator;

class User extends Authenticatable
{
>>>>>>> 5e46b170fd076f69529943a6bb928b7b96b6a2dc

    use HasApiTokens,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

<<<<<<< HEAD
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setRememberToken($value) {
=======
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setRememberToken($value)
    {
>>>>>>> 5e46b170fd076f69529943a6bb928b7b96b6a2dc
        $val = str_random(10);
        $this->attributes['remember_token'] = ($val);
    }

<<<<<<< HEAD
=======
    private $rules = array(
        'name' => 'required',
        'username' => 'required',
        'email' => 'required|min:6|unique:users',
        'password' => 'required',

    );

    private $errors;

    public function validate($data)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules);

        // check for failure
        if ($v->fails()) {
            // set errors and return false
            $this->errors = $v->errors();
            return false;
        }

        // validation pass
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }

>>>>>>> 5e46b170fd076f69529943a6bb928b7b96b6a2dc
}
