<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobStatus extends Model
{
    use HasFactory;

    protected $table = 'job_status';

    protected $fillable = [
        'name'
    ];


    public function job(){
        return $this->hasMany(Job::class,'job_status_id');
    }
}
