<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyTransferModel extends Model
{
    use HasFactory;
    protected $table = "money_transfer";
    public function hasusers()
    {
        return $this->hasOne('App\Models\User', 'id', 'User_id');
    }
    public function paymentmethods()
    {
        return $this->hasOne('App\Models\PaymentMethodModel', 'id', 'TransferedFrom');
    }
    public function paymentmethodsto()
    {
        return $this->hasOne('App\Models\PaymentMethodModel', 'id', 'TransferedTo');
    }
    public function transferbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
    
}
