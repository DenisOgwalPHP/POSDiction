<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetsRegisterModel extends Model
{
    use HasFactory;
    protected $table = "asset_register";
    public function hassupplier()
    {
        return $this->hasOne('App\Models\SupplierAccountModel', 'id', 'Supplier');
    }
    public function Purchasedproduct()
    {
        return $this->hasOne('App\Models\AssetNameModel', 'id', 'ProductName');
    }
}
