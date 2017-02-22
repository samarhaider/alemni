<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use App\Models\AppModel;

class User extends AppModel
{

    use Notifiable;

    const USER_TYPE_ADMIN = 1;
    const USER_TYPE_STUDENT = 2;
    const USER_TYPE_TUTOR = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
