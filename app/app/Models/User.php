<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static $rules = [
        "name" => "required|string",
        "email" => "required|string|email|unique:users,email",
        "password" => "required|string"
    ];

    protected static $validationMessage = [
        "name.required" => "please enter a name.",
        "email.required" => "Please enter an email.",
        "email.unique" => "Email already taken.",
        "email.email" => "Please enter a valid email.",
        "password.required" => "Please enter a password."
    ];

    public static function getRules()
    {
        return self::$rules;
    }

    public static function getValidationMessage()
    {
        return self::$validationMessage;
    }
}
