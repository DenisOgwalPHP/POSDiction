<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationRead extends Model
{
    use HasFactory;
    protected $table = "notificationread";
    public function notificationsread()
    {
        return $this->hasOne('App\Models\Notifications', 'id', 'NotificationID');
    }
}
