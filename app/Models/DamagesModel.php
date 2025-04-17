<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DamagesModel extends Model
{
    use HasFactory;
    protected $table = "damages";
    public function damagedproduct()
    {
        return $this->hasOne('App\Models\ProductModel', 'id', 'ProductRefer');
    }
    public function damagedpurchase()
    {
        return $this->hasOne('App\Models\PurchaseModel', 'id', 'PurchaseRefer');
    }
    public function damagedforsupplier()
    {
        return $this->hasOne('App\Models\SupplierAccountModel', 'id', 'SupplierAccount');
    }
    public function damagebranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
    public function registrar()
    {
        return $this->hasOne('App\Models\User', 'id', 'User_id');
    }
}
