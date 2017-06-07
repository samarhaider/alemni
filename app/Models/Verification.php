<?php

namespace App\Models;

use App\Models\AppModel;

class Verification extends AppModel
{

    const TYPE_PHONE = 1;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'verifications';

    /**
     * The attributes for validation rules.
     *
     * @var array
     */
    protected $rules = [
        'value' => 'required',
        'user_id' => 'required',
        'code' => 'required',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'value', 'user_id', 'code', 'created_at', 'updated_at', 'deleted_at'];

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

    public function scopeFindPhoneNumber($query, $phone_number)
    {
        return $query->where('value', '=', $phone_number);
    }

    public function scopeFindCode($query, $code)
    {
        return $query->where('code', '=', $code);
    }
    
    public function profile()
    {
        return $this->hasMany('App\Models\Profile', 'user_id', 'user_id');
    }
}
