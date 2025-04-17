<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClearClientAccountModel extends Model
{
    use HasFactory;
    protected $table = "clear_client_account";
    public function incomesbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
    public function registrar()
    {
        return $this->hasOne('App\Models\User', 'id', 'User_id');
    }
    public function clearedclient()
    {
        return $this->hasOne('App\Models\ClientAccountModel', 'id', 'ClientAccount');
    }
    public function paymentmethods()
    {
        return $this->hasOne('App\Models\PaymentMethodModel', 'id', 'PaymentMethod');
    }
}
