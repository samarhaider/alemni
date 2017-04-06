<?php

namespace App\Models;

use App\Models\AppModel;

class Choice extends AppModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'choices';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['question_id', 'text', 'created_at', 'updated_at', 'deleted_at'];

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
     * Get Question
     * 
     * @return type Object of Question 
     */
    public function Question()
    {
        return $this->belongsTo('App\Models\Question');
    }
}
