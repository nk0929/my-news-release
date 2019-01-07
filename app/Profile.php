<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = array('id');
    public static $rules = array(
        'name' => 'required|max:50',
        'hobby' => 'max:200',
        'introduction' => 'max:400',

    );
    public function user_histories()
    {
        return $this->hasMany('App\UserHistory');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
