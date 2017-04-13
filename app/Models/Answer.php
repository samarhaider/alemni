<?php

namespace App\Models;

use App\Models\AppModel;

class Answer extends AppModel
{

    /**
     * The attributes for validation rules.
     *
     * @var array
     */
    protected $rules = [
        'question_id' => 'required',
        'choice_id' => 'required',
    ];

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
    protected $fillable = ['questionable_id', 'questionable_type', 'question_id', 'choice_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['updated_at', 'deleted_at'];

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
     * Get all of the owning questionable models.
     */
    public function questionable()
    {
        return $this->morphTo();
    }

    /**
     * Get Profile
     * 
     * @return type Object of Profile 
     */
    public function profile()
    {
        return $this->belongsTo('App\Models\Profile', 'user_id', 'user_id');
    }

    /**
     * Get User
     * 
     * @return type Object of User 
     */
    public function user()
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
        return $this->belongsTo('App\Models\Choice');
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
