<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffPaymentModel extends Model
{
    use HasFactory;
    protected $table = "staff_payment";
      public function hasstaff()
    {
        return $this->hasOne('App\Models\StaffModel','id','StaffReference');
    }
    public function staffpaymentbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
    public function paymentmethods()
    {
        return $this->hasOne('App\Models\PaymentMethodModel', 'id', 'PaymentMethod');
    }
}
