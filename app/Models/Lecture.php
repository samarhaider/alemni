<?php

namespace App\Models;

use App\Models\AppModel;

class Lecture extends AppModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lectures';

    /**
     * The attributes for validation rules.
     *
     * @var array
     */
    protected $rules = [
        'tution_id' => 'required',
        'attachments' => 'nullable|array',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tution_id', 'start_time', 'end_time', 'goals', 'reviews', 'progress', 'attachments', 'created_at', 'updated_at', 'deleted_at'];

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
    protected $dates = ['start_time', 'end_time', 'created_at', 'updated_at', 'deleted_at'];

    public function startValidation($add = true)
    {
        if ($add) {
            $this->rules['tution_id'] = 'required';
            $this->rules['goals'] = 'required';
        } else {
            unset($this->rules['tution_id']);
            unset($this->rules['goals']);
        }
    }

    public function endValidation($add = true)
    {
        if ($add) {
            $this->rules['tution_id'] = 'required';
            $this->rules['reviews'] = 'required';
        } else {
            unset($this->rules['tution_id']);
            unset($this->rules['reviews']);
        }
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

    public function scopeFindTution($query, $tution_id)
    {
        return $query->where('tution_id', '=', $tution_id);
    }

    public function tution()
    {
        return $this->belongsTo('App\Models\Tution');
    }
}
