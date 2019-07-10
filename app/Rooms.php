<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Rooms extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'room_id';
    protected $fillable = [
        'room_name'
    ];

    public function users(){
        return $this->belongsToMany('App\User','Persons','room_id','user_id');
    }

    public function chats(){
        return $this->hasMany('App\Chats','room_id','room_id');
    }
}
