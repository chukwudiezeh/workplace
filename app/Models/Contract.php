<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;


    protected $fillable = ['client_id','freelancer_id', 'job_id', 'proposal_id','starts_at', 'ends_at', 'compensation_type_id','contract_fee','contract_status_id'];

}
