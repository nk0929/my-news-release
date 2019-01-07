<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'title' => 'required|max:100',
        'body' => 'required|max:10000',
    );
    public function histories()
    {
        return $this->hasMany('App\History');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
