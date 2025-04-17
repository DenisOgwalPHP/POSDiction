<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAccountModel extends Model
{
    use HasFactory;
    protected $table = "client_accounts";

    public function clientbranch()
    {
        return $this->hasOne('App\Models\BranchModel', 'id', 'Branch');
    }
}
