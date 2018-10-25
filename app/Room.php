<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Room extends Model
{
    protected $fillable = [
    'name', 'city', 'price'
    ];


    protected $table = 'room';

    public $timestamps = false;
}
