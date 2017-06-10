<?php

namespace App\Models;

use App\Models\AppModel;

class Proposal extends AppModel
{

    const STATUS_PENDING = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_REJECTED = 3;
    const STATUS_WITHDRAWL = 4;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'proposals';

    /**
     * The attributes for validation rules.
     *
     * @var array
     */
    protected $rules = [
        'tutor_id' => 'required',
        'tution_id' => 'required',
        'title' => 'required',
        'description' => 'required',
        'cost' => 'required',
        'estimated_time' => 'required',
        'attachments' => 'nullable|array',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tutor_id', 'tution_id', 'title', 'availability_from', 'availability_to', 'schedule', 'attachments', 'status', 'description', 'cost', 'estimated_time', 'deleted_at', 'created_at', 'updated_at'];

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
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $with = ['tution'];

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

    public function scopeFindTutor($query, $tutor_id)
    {
        return $query->where('tutor_id', '=', $tutor_id);
    }

    public function scopeFindTution($query, $tution_id)
    {
        return $query->where('tution_id', '=', $tution_id);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', '=', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', '=', self::STATUS_PENDING);
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', '=', self::STATUS_ACCEPTED);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', '=', self::STATUS_REJECTED);
    }

    public function scopeWithdrawl($query)
    {
        return $query->where('status', '=', self::STATUS_WITHDRAWL);
    }

    public function tutors()
    {
        return $this->hasMany('App\Models\Profile', 'tutor_id', 'user_id');
    }

    public function tutor()
    {
        return $this->hasMany('App\Models\Profile', 'tutor_id', 'user_id');
    }

    public function tution()
    {
        return $this->belongsTo('App\Models\Tution');
    }
}
