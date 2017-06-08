<?php

namespace App\Models;

use App\Models\AppModel;

class Offer extends AppModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offers';

    /**
     * The attributes for validation rules.
     *
     * @var array
     */
    protected $rules = [
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'offer_tutor_id', 'student_id', 'tutor_id', 'status', 'private', 'title', 'budget', 'latitude', 'longitude', 'start_date', 'daily_timing', 'city', 'state', 'date', 'time', 'attachments', 'day_of_week_0', 'day_of_week_1', 'day_of_week_2', 'day_of_week_3', 'day_of_week_4', 'day_of_week_5', 'day_of_week_6', 'description', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_date', 'deleted_at', 'created_at', 'updated_at'];

    public function invitations()
    {
        return $this->hasMany('App\Models\Invitation', 'tution_id');
    }

    public function proposals()
    {
        return $this->hasMany('App\Models\Proposal', 'tution_id');
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
        return $query->where('offer_tutor_id', '=', $tutor_id);
    }

    /**
     * Get Profile
     * 
     * @return type Object of Profile 
     */
    public function student()
    {
        return $this->belongsTo('App\Models\Profile', 'student_id', 'user_id');
    }
}
