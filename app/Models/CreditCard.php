<?php

namespace App\Models;

use App\Models\AppModel;

class CreditCard extends AppModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'credit_cards';

    /**
     * The attributes for validation rules.
     *
     * @var array
     */
    protected $rules = [
        'month' => 'required',
        'year' => 'required',
        'card_number' => 'required',
        'cvc' => 'required',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'month', 'year', 'card_number', 'cvc',];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

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

}
