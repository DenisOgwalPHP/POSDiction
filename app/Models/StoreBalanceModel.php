<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreBalanceModel extends Model
{
    use HasFactory;
    protected $table = "store_balance";
    public function Purchasedproduct()
    {
        return $this->hasOne('App\Models\ProductModel', 'id', 'ProductRefer');
    }
    public function registrar()
    {
        return $this->hasOne('App\Models\User', 'id', 'User_id');
    }
}
