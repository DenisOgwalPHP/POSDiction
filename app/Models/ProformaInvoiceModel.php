<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProformaInvoiceModel extends Model
{
    use HasFactory;
    protected $table = "proforma_invoice";
    public function invoicebranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
    public function registrar()
    {
        return $this->hasOne('App\Models\User', 'id', 'User_id');
    }
}
