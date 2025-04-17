<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesreturnModel extends Model
{
    use HasFactory;
    protected $table = "sales_return";
    public function returnedproduct()
    {
        return $this->hasOne('App\Models\ProductModel', 'id', 'ProductRefer');
    }
    public function returnedpurchase()
    {
        return $this->hasOne('App\Models\SalesModel', 'id', 'SalesRefer');
    }
    public function returnclient()
    {
        return $this->hasOne('App\Models\ClientAccountModel', 'id', 'ClientAccount');
    }
    public function returnbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
    public function registrar()
    {
        return $this->hasOne('App\Models\User', 'id', 'User_id');
    }
}
