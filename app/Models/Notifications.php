<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
     protected $table = "notifications";
     public function notificationsread()
    {
        return $this->hasOne('App\Models\User', 'id', 'PostedUser');
    }
    public function notificationbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
}
