<?php

namespace App\Models;

use App\Models\AppModel;
use App\Models\User;
use \Conner\Tagging\Taggable;
use willvincent\Rateable\Rateable;

class Profile extends AppModel
{

    use Taggable,
        Rateable;

    public $qualifications;

    /**
     * The attributes for validation rules.
     *
     * @var array
     */
    protected $rules = [
        'hourly_rate' => 'nullable',
        'gender' => 'nullable|in:M,F',
        'radius' => 'nullable',
        'latitude' => ['nullable', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
        'longitude' => ['nullable', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        'phone_number' => 'nullable', # user phone validation library
        'bio' => 'nullable',
        'address' => 'nullable',
        'experience' => 'nullable',
        'stage_complete' => 'nullable',
        'specialist' => 'nullable',
        'teaches' => 'nullable',
        'paypal_address' => 'nullable',
        'state' => 'nullable',
        'city' => 'nullable',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'hourly_rate', 'gender', 'radius', 'experience', 'stage_complete', 'specialist', 'teaches', 'phone_number', 'bio', 'latitude', 'longitude', 'address', 'city', 'state', 'paypal_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id', 'deleted_at', 'updated_at', 'created_at', 'tagged',
        # uses table
        'password', 'remember_token', 'google', 'user_type', 'active', 'block', 'updated_at', 'deleted_at'
    ];

    /**
     * Attributes that get appended on serialization
     *
     * @var array
     */
    protected $appends = [
        'qualifications',
        'average_rating',
        'completed_tutions',
        'avatar_url',
        'total_hours',
    ];

    /**
     * Get all of the answers's of profile.
     */
    public function answers()
    {
        return $this->morphMany('App\Models\Answer', 'questionable');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Near By 
     * 
     * @return $query
     */
    public function scopeNearBy($query, $lat, $long, $distance)
    {
        $condition = "distance({$lat}, {$long}, latitude, longitude, 'ME') <= {$distance}";
        return $query->whereRaw($condition);
    }

    /**
     * Block 
     * 
     * @return user_type array of User Object
     */
    public function scopeBlock($query)
    {
        return $query->where('block', '=', User::BLOCK);
    }

    /**
     * Unblock 
     * 
     * @return user_type array of User Object
     */
    public function scopeUnblock($query)
    {
        return $query->where('block', '=', User::UNBLOCK);
    }

    /**
     * Active 
     * 
     * @return user_type array of User Object
     */
    public function scopeActive($query)
    {
        return $query->where('active', '=', User::ACTIVE);
    }

    /**
     * Inactive 
     * 
     * @return user_type array of User Object
     */
    public function scopeInactive($query)
    {
        return $query->where('active', '=', User::INACTIVE);
    }

    /**
     * Students 
     * 
     * @return user_type array of User Object
     */
    public function scopeStudents($query)
    {
        return $query->where('user_type', '=', User::TYPE_STUDENT);
    }

    /**
     * Tutors 
     * 
     * @return user_type array of User Object
     */
    public function scopeTutors($query)
    {
        return $query->where('user_type', '=', User::TYPE_TUTOR);
    }

    public function scopeGender($query, $gender)
    {
        return $query->where('gender', '=', $gender);
    }

    public function getQualificationsAttribute()
    {
        return $this->tagNames();
//        if ($this->tags) {
//            return ;
//        }
//        return [];
    }

    public function getAvatarUrlAttribute()
    {
        return env('APP_URL') . '/' . $this->avatar;
    }

    public function tutions()
    {
        $foreign_key = 'student_id';
        if ($this->user->user_type == User::TYPE_TUTOR) {
            $foreign_key = 'tutor_id';
        }
        return $this->hasMany('App\Models\Tution', $foreign_key, 'user_id');
    }

    public function getCompletedTutionsAttribute()
    {
        return $this->tutions()->completed()->count();
    }

    public function getTotalHoursAttribute()
    {
        return 5;
    }
}
