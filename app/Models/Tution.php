<?php

namespace App\Models;

use App\Models\AppModel;
use \Conner\Tagging\Taggable;
use willvincent\Rateable\Rateable;

class Tution extends AppModel
{

    use Taggable,
        Rateable;

    const STATUS_NEW = 1;
    const STATUS_INPROGRESS = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_CANCELLED = 4;

    #Public / Private
    const TYPE_PUBLIC = 0;
    const TYPE_PRIVATE = 1;

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
        'private' => 'required',
        'budget' => 'required',
        'latitude' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
        'longitude' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        'start_date' => 'required|date_format:"Y-m-d"',
        'daily_timing' => 'required',
        'day_of_week_0' => 'required',
        'day_of_week_1' => 'required',
        'day_of_week_2' => 'required',
        'day_of_week_3' => 'required',
        'day_of_week_4' => 'required',
        'day_of_week_5' => 'required',
        'day_of_week_6' => 'required',
        'state' => 'nullable',
        'city' => 'nullable',
        'date' => 'nullable',
        'time' => 'nullable',
        'attachments' => 'nullable|array',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['student_id', 'tutor_id', 'status', 'private', 'title', 'budget', 'latitude', 'longitude', 'start_date', 'daily_timing', 'day_of_week_0', 'day_of_week_1', 'day_of_week_2', 'day_of_week_3', 'day_of_week_4', 'day_of_week_5', 'day_of_week_6', 'description', 'deleted_at', 'created_at', 'updated_at', 'city', 'state', 'date', 'time', 'attachments'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['tagged', 'deleted_at', 'updated_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['private' => 'boolean', 'day_of_week_0' => 'boolean', 'day_of_week_1' => 'boolean', 'day_of_week_2' => 'boolean', 'day_of_week_3' => 'boolean', 'day_of_week_4' => 'boolean', 'day_of_week_5' => 'boolean', 'day_of_week_6' => 'boolean'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
    protected $with = ['answers'];

    /**
     * Attributes that get appended on serialization
     *
     * @var array
     */
    protected $appends = [
        'subjects',
        'last_class',
//        'attachments',
//        'date',
//        'time',
    ];

    public function getSubjectsAttribute()
    {
        return $this->tagNames();
    }

    public function getLastClassAttribute()
    {
        return "";
    }

    public function getNextClassAttribute()
    {
        return "";
    }

    public function setAttachmentsAttribute($value)
    {
        $this->attributes['attachments'] = serialize($value);
    }

    public function getAttachmentsAttribute($value)
    {
        if ($value == null) {
            return [];
        }
        return unserialize($value);
    }
//    public function getDateAttribute()
//    {
//        return "";
//    }
//
//    public function getTimeAttribute()
//    {
//        return "";
//    }

    /**
     * Get Profile
     * 
     * @return type Object of Profile 
     */
    public function student()
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
    public function tutor()
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

    public function invitations()
    {
        return $this->hasMany('App\Models\Invitation', 'tution_id');
    }

    public function proposals()
    {
        return $this->hasMany('App\Models\Proposal', 'tution_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message', 'tution_id');
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', '=', $status);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', '=', self::STATUS_COMPLETED);
    }

    public function scopeFindTutor($query, $tutor_id)
    {
        return $query->where('tutor_id', '=', $tutor_id);
    }

    public function scopeFindStudent($query, $student_id)
    {
        return $query->where('student_id', '=', $student_id);
    }

    public function scopeNearBy($query, $lat, $long, $distance)
    {
        $condition = "distance({$lat}, {$long}, latitude, longitude, 'ME') <= {$distance}";
        return $query->whereRaw($condition);
    }

    public function scopePublicOnlyAndInvitedUser($query, $user_id)
    {
        return $query->where(function($q) use ($user_id) {
                $q->where('private', '=', self::TYPE_PUBLIC)
                    ->orWhereHas('invitations', function($query) use ($user_id) {
                        $query->where('invitations.tutor_id', '=', $user_id);
                    });
            });
    }

    public function scopePublicOnly($query)
    {
        return $query->where('private', '=', self::TYPE_PUBLIC);
    }
}
