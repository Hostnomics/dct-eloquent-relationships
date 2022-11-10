<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Nov 5 2022: extends Authenticatable just jazzed up extends model: https://stackoverflow.com/questions/39887613/what-is-the-difference-between-extends-authenticatable-vs-extends-model-in-l

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'field_names_here'
    ];

  
// Nov 5 2022 attempt with Invoice.php - WORKING on 11/9/22 - https://i.imgur.com/YAtDOWV.png
    public function invoice()
    {
        return $this->hasMany('App\Invoice');
    }
    
    
} // end of class
