<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractStatus extends Model
{
    use HasFactory;

    protected $table = 'contract_status';

    protected $fillable = [
        'name'
    ];


    public function contract(){
        return $this->hasMany(Contract::class,'contract_status_id');
    }

}
