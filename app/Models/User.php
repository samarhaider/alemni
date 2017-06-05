<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Gerardojbaez\Messenger\Contracts\MessageableInterface;
use Gerardojbaez\Messenger\Traits\Messageable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use App\Models\AppModel;

class User extends AppModel implements AuthenticatableContract, MessageableInterface
{

    use Notifiable,
        Messageable,
        Authenticatable;

    const TYPE_ADMIN = 1;
    const TYPE_STUDENT = 2;
    const TYPE_TUTOR = 3;
    const ACTIVE = 1;
    const INACTIVE = 0;
    const BLOCK = 1;
    const UNBLOCK = 0;

    /**
     * The attributes for validation rules.
     *
     * @var array
     */
    protected $rules = [
        'google' => 'required',
        'user_type' => 'required|in:2,3',
    ];

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
        'password', 'remember_token', 'google', 'active', 'block', 'updated_at', 'deleted_at'
    ];
    
    public function emailPasswordValidation($add = true)
    {
        if ($add) {
            $this->rules['email'] = 'required|email|unique:users';
            $this->rules['password'] = 'required';
            unset($this->rules['google']);
        } else {
            unset($this->rules['email']);
            unset($this->rules['password']);
            $this->rules['google'] = 'required';
        }
    }
    
    public function changePasswordValidation($add = true)
    {
        if ($add) {
            $this->rules = [
                'current_password' => 'required',
//                'new_password' => 'required|confirmed',
                'new_password' => 'required',
            ];
        } else {
            unset($this->rules['current_password']);
            unset($this->rules['new_password']);
        }
    }
    
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function isAdmin()
    {
        if ($this->user_type == self::TYPE_ADMIN) {
            return true;
        }
        return false;
    }

    public function isStudent()
    {
        if ($this->user_type == self::TYPE_STUDENT) {
            return true;
        }
        return false;
    }

    public function isTutor()
    {
        if ($this->user_type == self::TYPE_TUTOR) {
            return true;
        }
        return false;
    }
    
    public function isBlocked()
    {
        if ($this->block == self::BLOCK) {
            return true;
        }
        return false;
    }

    /**
     * Block 
     * 
     * @return user_type array of User Object
     */
    public function scopeBlock($query)
    {
        return $query->where('block', '=', self::BLOCK);
    }

    /**
     * Unblock 
     * 
     * @return user_type array of User Object
     */
    public function scopeUnblock($query)
    {
        return $query->where('block', '=', self::UNBLOCK);
    }

    /**
     * Active 
     * 
     * @return user_type array of User Object
     */
    public function scopeActive($query)
    {
        return $query->where('active', '=', self::ACTIVE);
    }

    /**
     * Inactive 
     * 
     * @return user_type array of User Object
     */
    public function scopeInactive($query)
    {
        return $query->where('active', '=', self::INACTIVE);
    }

    /**
     * Students 
     * 
     * @return user_type array of User Object
     */
    public function scopeStudents($query)
    {
        return $query->where('user_type', '=', self::TYPE_STUDENT);
    }

    /**
     * Tutors 
     * 
     * @return user_type array of User Object
     */
    public function scopeTutors($query)
    {
        return $query->where('user_type', '=', self::TYPE_TUTOR);
    }

    /**
     * Admins 
     * 
     * @return user_type array of User Object
     */
    public function scopeAdmins($query)
    {
        return $query->where('user_type', '=', self::TYPE_ADMIN);
    }

    /**
     * Answers 
     * 
     * @return array of Answer Object
     */
    public function Answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

    /**
     * The questions that belong to the user.
     */
    public function Questions()
    {
        return $this->belongsToMany('App\Models\Question', 'answer');
    }
    
    public function CreditCard()
    {
        return $this->hasOne('App\Models\CreditCard');
    }
}
