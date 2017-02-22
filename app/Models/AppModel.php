<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Watson\Validating\ValidatingTrait;
use Illuminate\Database\Eloquent\Model;

class AppModel extends Model
{

    use ValidatingTrait;
//    use SoftDeletes;
    use Notifiable;

//    protected $dateFormat = 'U';

    protected $dates = ['deleted_at'];

    /**
     * The attributes for validation rules.
     *
     * @var array
     */
    protected $rules = [
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

}
