<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierAccountBalanceModel extends Model
{
    use HasFactory;
    protected $table = "supplier_account_balance";
    public function supplierbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
    public function registrar()
    {
        return $this->hasOne('App\Models\User', 'id', 'User_id');
    }
    public function clearedsupplier()
    {
        return $this->hasOne('App\Models\SupplierAccountModel', 'id', 'AccountID');
    }
    public function paymentmethods()
    {
        return $this->hasOne('App\Models\PaymentMethodModel', 'id', 'PaymentMode');
    }
}
