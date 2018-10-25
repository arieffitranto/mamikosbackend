<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Chat extends Model
{
    protected $fillable = [
    'room_id', 'chat'
    ];

    protected $table = 'chatroom';

    public $timestamps = false;
}
