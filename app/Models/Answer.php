<?php

namespace App\Models;

use App\Models\AppModel;

class Answer extends AppModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'answers';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'question_id', 'choice_id', 'created_at', 'updated_at', 'deleted_at'];

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
     * Get User
     * 
     * @return type Object of User 
     */
    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get Choice
     * 
     * @return type Object of Choice 
     */
    public function Choice()
    {
        return $this->hasOne('App\Models\Choice');
    }

    /**
     * Get Question
     * 
     * @return type Object of Question 
     */
    public function Question()
    {
        return $this->belongsTo('App\Models\Question');
    }
}
