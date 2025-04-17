<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierReturnsModel extends Model
{
    use HasFactory;
    protected $table = "supplier_return";
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
    public function Purchasesids()
    {
        return $this->hasOne('App\Models\PurchaseModel', 'id', 'PurchaseID');
    }
    public function Supplierids()
    {
        return $this->hasOne('App\Models\SupplierAccountModel', 'id', 'SupplierID');
    }
}
