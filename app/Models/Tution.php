<?php

namespace App\Models;

use App\Models\AppModel;
use \Conner\Tagging\Taggable;

class Tution extends AppModel
{

    use Taggable;

    const STATUS_NEW = 1;
    const STATUS_INPROGRESS = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_CANCELLED = 4;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tutions';
    Protected $primaryKey = "id";
    /**
     * The attributes for validation rules.
     *
     * @var array
     */
    protected $rules = [
//        'title' => 'required|in:2,3',
        'title' => 'required',
        'budget' => 'required',
        'latitude' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
        'longitude' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        'start_date' => 'required|date',
        'daily_timing' => 'required',
        'day_of_week_0' => 'required',
        'day_of_week_1' => 'required',
        'day_of_week_2' => 'required',
        'day_of_week_3' => 'required',
        'day_of_week_4' => 'required',
        'day_of_week_5' => 'required',
        'day_of_week_6' => 'required',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['student_id', 'tutor_id', 'status', 'title', 'budget', 'latitude', 'longitude', 'start_date', 'daily_timing', 'day_of_week_0', 'day_of_week_1', 'day_of_week_2', 'day_of_week_3', 'day_of_week_4', 'day_of_week_5', 'day_of_week_6', 'description', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['deleted_at', 'updated_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['day_of_week_0' => 'boolean', 'day_of_week_1' => 'boolean', 'day_of_week_2' => 'boolean', 'day_of_week_3' => 'boolean', 'day_of_week_4' => 'boolean', 'day_of_week_5' => 'boolean', 'day_of_week_6' => 'boolean'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_date', 'deleted_at', 'created_at', 'updated_at'];
    protected $with = ['answers'];

    /**
     * Get Profile
     * 
     * @return type Object of Profile 
     */
    public function studentProfile()
    {
        return $this->belongsTo('App\Models\Profile', 'student_id');
    }

    /**
     * Get User
     * 
     * @return type Object of User 
     */
    public function studentUser()
    {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    /**
     * Get Profile
     * 
     * @return type Object of Profile 
     */
    public function tutorProfile()
    {
        return $this->belongsTo('App\Models\Profile', 'tutor_id', 'user_id');
    }

    /**
     * Get User
     * 
     * @return type Object of User 
     */
    public function tutorUser()
    {
        return $this->belongsTo('App\Models\User', 'tutor_id');
    }

    /**
     * Get all of the answer's of tution.
     */
    public function answers()
    {
        return $this->morphMany('App\Models\Answer', 'questionable');
    }

    public function bids()
    {
        return $this->hasMany('App\Models\Bid', 'tution_id');
    }
}
