<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesFinalModel extends Model
{
    use HasFactory;
    protected $table = "sales_final";
    public function salesaccount()
    {
        return $this->hasOne('App\Models\ClientAccountModel', 'id', 'ClientAccount');
    }
    public function registrar()
    {
        return $this->hasOne('App\Models\User', 'id', 'User_id');
    }
    public function paymentmethods()
    {
        return $this->hasOne('App\Models\PaymentMethodModel', 'id', 'PaymentMethod');
    }
    public function salesbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
}
