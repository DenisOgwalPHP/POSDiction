<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevidendsModel extends Model
{
    use HasFactory;
    protected $table = "devidends";
    public function hasusers()
    {
        return $this->hasOne('App\Models\User', 'id', 'User_id');
    }
    public function payedto()
    {
        return $this->hasOne('App\Models\User', 'id', 'Withdrew_By');
    }
    public function withdrawbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
    public function devidendpaymentmethod()
    {
        return $this->hasOne('App\Models\PaymentMethodModel', 'id', 'PaymentMethod');
    }
}
