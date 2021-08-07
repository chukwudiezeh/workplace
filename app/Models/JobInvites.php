<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobInvites extends Model
{
    use HasFactory;

    protected $table = 'job_invites';

    protected $fillable = ['message','job_id','freelancer_id','client_id',];

    public function freelancer(){
        return $this->belongsTo(Freelancer::class, 'freelancer_id');
    }
    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function job(){
        return $this->belongsTo(Job::class, 'job_id');
    }
}
