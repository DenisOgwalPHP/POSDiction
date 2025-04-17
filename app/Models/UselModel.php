<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UselModel extends Model
{
    use HasFactory;
     protected $table = "users";
    public function usermessages()
    {
        return $this->hasMany('App\Models\Chat','id','id');
    }
     public function usermessaging()
    {
        return $this->belongsTo(Chat::class);
    }
}
