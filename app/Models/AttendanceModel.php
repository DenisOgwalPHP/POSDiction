<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceModel extends Model
{
    use HasFactory;
    protected $table = "attendance";
    public function attendancestaff()
    {
        return $this->hasOne('App\Models\StaffModel', 'id', 'StaffId');
    }
    public function attendancebranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
}
