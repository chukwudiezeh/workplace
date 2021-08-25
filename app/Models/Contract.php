<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $table = "contracts";

    protected $fillable = ['client_id','freelancer_id', 'job_id', 'proposal_id','starts_at', 'ends_at', 'compensation_type_id','contract_fee','contract_status_id'];


    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function freelancer(){
        return $this->belongsTo(Freelancer::class, 'freelancer_id');
    }

    public function job(){
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function proposal(){
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }

    public function compensationType(){
        return $this->belongsTo(CompensationType::class, 'compensation_type_id');
    }

    public function contractStatus(){
        return $this->belongsTo(ContractStatus::class, 'contract_status_id');
    }

}
