<?php

namespace App\Models;

use App\Models\AppModel;

class Profile extends AppModel
{

    /**
     * The attributes for validation rules.
     *
     * @var array
     */
    protected $rules = [
        'hourly_rate' => 'nullable',
        'gender' => 'nullable|in:M,F',
        'radius' => 'nullable',
        'latitude' => ['nullable', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
        'longitude' => ['nullable', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        'phone_number' => 'nullable', # user phone validation library
        'bio' => 'nullable',
        'address' => 'nullable',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'hourly_rate', 'gender', 'radius', 'phone_number', 'bio', 'latitude', 'longitude', 'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'user_id', 'deleted_at', 'updated_at', 'created_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Block 
     * 
     * @return user_type array of User Object
     */
    public function scopeNearByMe($query, $lat, $long, $distance)
    {
        $condition = "distance({$lat}, {$long}, latitude, longitude, 'ME') <= {$distance}";
        return $query->whereRaw($condition);
    }
}
