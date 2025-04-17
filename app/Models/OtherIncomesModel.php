<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherIncomesModel extends Model
{
    use HasFactory;
    protected $table = "other_incomes";
    public function incomesbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
    public function registrar()
    {
        return $this->hasOne('App\Models\User', 'id', 'User_id');
    }
    public function paymentmethods()
    {
        return $this->hasOne('App\Models\PaymentMethodModel', 'id', 'PaymentMethod');
    }
}
