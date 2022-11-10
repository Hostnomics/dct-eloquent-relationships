<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
// 11/5/22 - Trying to follow: https://laravel.com/docs/5.2/eloquent-relationships#one-to-one
// 11/9/22 - WORKING: https://i.imgur.com/YAtDOWV.png
    public function user()
        {
            return $this->belongsTo('App\User');
        }
    
    
    protected $fillable = [
        'field_names_here'
    ];
}
