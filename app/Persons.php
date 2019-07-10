<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Persons extends Model
{
    protected $table = 'persons';
    protected $primaryKey = 'person_id';
    protected $fillable = [
        'room_id','user_id'
    ];

    public function chats(){
        return $this->hasMany('App\Chats','person_id','person_id');
    }
}
