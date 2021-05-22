<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $table = 'proposals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'freelancer_id','job_id','cover_letter','milestone','payment_type', 'estimated_enddate',
        'proposed_fee','proposal_status_id',
    ];
}