<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetsBalanceModel extends Model
{
    use HasFactory;
    protected $table = "assets_balance";
    public function Purchasedproduct()
    {
        return $this->hasOne('App\Models\AssetNameModel', 'id', 'ProductName');
    }
}
