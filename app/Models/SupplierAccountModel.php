<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierAccountModel extends Model
{
    use HasFactory;
    protected $table = "supplier_account";
    public function supplierbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
}
