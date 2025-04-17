<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $table = "chat";
    public function senderaccount()
    {
        return $this->hasOne('App\Models\User','id','SenderID');
    }
      public function recieveraccount()
    {
        return $this->hasOne('App\Models\User','id','ReceiverID');
    }
}
