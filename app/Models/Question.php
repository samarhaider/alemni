<?php

namespace App\Models;

use App\Models\AppModel;

class Question extends AppModel
{

    const FOR_TUTION = 1;
    const FOR_STUDENT = 2;
    const FOR_TUTOR = 3;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'questions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['text', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'type',
    ];

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
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Student 
     */
    public function scopeStudent($query)
    {
        return $query->where('type', '=', self::FOR_STUDENT);
    }

    /**
     * Tutor 
     */
    public function scopeTutor($query)
    {
        return $query->where('type', '=', self::FOR_TUTOR);
    }

    /**
     * Tutor 
     */
    public function scopeTution($query)
    {
        return $query->where('type', '=', self::FOR_TUTION);
    }

    /**
     * Tutor 
     */
    public function scopeFor($query, $type)
    {
        return $query->where('type', '=', $type);
    }

    /**
     * List of question choices
     * 
     * @return type array of Choices Object
     */
    public function Choices()
    {
        return $this->hasMany('App\Models\Choice');
    }

    /**
     * The users that belong to the question.
     */
    public function users()
    {
        return $this->belongsToMany('App\Modesl\Question');
    }
}
