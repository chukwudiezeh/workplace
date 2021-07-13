<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalStatus extends Model
{
    use HasFactory;

    protected $table = 'proposal_status';

    protected $fillable = [
        'name'
    ];


    public function job(){
        return $this->hasMany(Proposal::class,'proposal_status_id');
    }
}
