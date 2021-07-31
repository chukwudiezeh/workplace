<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = ['user_id','address', 'got_company', 'company_name', 'company_tagline', 'company_description', 'company_address', 'company_website', 'company_logo', 'position_at_company'];

    public function jobs(){
        return $this->hasMany(Job::class, 'client_id');
    }

    public function jobInvites(){
        return $this->hasMany(JobInvites::class,'client_id');
    }

    public function contracts(){
        return $this->hasMany(Contract::class,'client_id');
    }

}
