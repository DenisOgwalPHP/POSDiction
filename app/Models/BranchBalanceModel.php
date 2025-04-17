<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchBalanceModel extends Model
{
    use HasFactory;
    protected $table = "branch_balance";
    public function Purchasedproduct()
    {
        return $this->hasOne('App\Models\ProductModel', 'id', 'ProductRefer');
    }
    public function supplierbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
    public function registrar()
    {
        return $this->hasOne('App\Models\User', 'id', 'User_id');
    }
}
