<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Chats extends Model
{
    protected $table = 'chats';
    protected $primaryKey = 'chat_id';
    protected $fillable = [
        'user_id', 'room_id', 'message'
    ];

    public function rooms(){
        return $this->belongsTo('App\Rooms','room_id','room_id');
    }
    public function users(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
