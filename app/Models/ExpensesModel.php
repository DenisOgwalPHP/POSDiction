<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesModel extends Model
{
    use HasFactory;
     protected $table = "expenses";
       public function hasusers()
    {
        return $this->hasOne('App\Models\User', 'id', 'InputUser');
    }
    public function expensesbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
}
