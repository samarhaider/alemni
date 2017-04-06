<?php

namespace App\Models;

use App\Models\AppModel;
use App\Models\User;

class Question extends AppModel
{

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
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Student 
     */
    public function scopeStudent($query)
    {
        return $query->where('user_type', '=', User::TYPE_STUDENT);
    }

    /**
     * Tutor 
     */
    public function scopeTutor($query)
    {
        return $query->where('user_type', '=', User::TYPE_TUTOR);
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
