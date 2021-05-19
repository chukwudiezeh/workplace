<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id','title','category_id','subcategory_id','compensation_type_id', 'experience_level_id',
        'job_status_id','duration_id','description','skills_required','budget'
    ];

    protected $casts = [
        'skill_required' => 'array',
    ];

    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }

    public function jobInvites(){
        return $this->hasMany(job::class,'job_id');
    }

    public function contracts(){
        return $this->hasMany(Contract::class, 'job_id');
    }

}
