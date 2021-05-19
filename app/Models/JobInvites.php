<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobInvites extends Model
{
    use HasFactory;

    protected $table = 'job_invites';

    protected $fillable = ['message','job_id','freelancer_id','client_id',];

}
