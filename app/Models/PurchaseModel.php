<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseModel extends Model
{
    use HasFactory;
    protected $table = "purchases";
    public function Purchasedproduct()
    {
        return $this->hasOne('App\Models\ProductModel', 'id', 'ProductName');
    }
    public function supplierbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
    public function registrar()
    {
        return $this->hasOne('App\Models\User', 'id', 'User_id');
    }
    public function purchasefromsupplier()
    {
        return $this->hasOne('App\Models\SupplierAccountModel', 'id', 'Supplier');
    }
}
