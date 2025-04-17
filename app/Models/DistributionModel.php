<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributionModel extends Model
{
    use HasFactory;
    protected $table = "distribution";
    public function supplierbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'BranchFrom');
    }
    public function receiverbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
    public function registrar()
    {
        return $this->hasOne('App\Models\User', 'id', 'User_id');
    }
    public function distributedproduct()
    {
        return $this->hasOne('App\Models\ProductModel', 'id', 'ProductRefer');
    }
}
