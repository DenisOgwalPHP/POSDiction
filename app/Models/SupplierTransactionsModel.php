<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierTransactionsModel extends Model
{
    use HasFactory;
    protected $table = "supplier_transactions";
    public function supplierbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
    public function registrar()
    {
        return $this->hasOne('App\Models\User', 'id', 'User_id');
    }
    public function Purchasedproduct()
    {
        return $this->hasOne('App\Models\ProductModel', 'id', 'ProductID');
    }
    public function productsupplier()
    {
        return $this->hasOne('App\Models\SupplierAccountModel', 'id', 'AccountID');
    }
}
