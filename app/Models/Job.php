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

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }
    public function compensationType(){
        return $this->belongsTo(CompensationType::class,'compensation_type_id');
    }
    public function experienceLevel(){
    return $this->belongsTo(ExperienceLevel::class,'experience_level_id');
}
    public function jobStatus(){
        return $this->belongsTo(JobStatus::class,'job_status_id');
    }
    public function duration(){
        return $this->belongsTo(Duration::class,'duration_id');
    }

    public function jobInvites(){
        return $this->hasMany(JobInvites::class,'job_id');
    }

    public function proposals(){
        return $this->hasMany(Proposal::class,'job_id');
    }

    public function contracts(){
        return $this->hasMany(Contract::class, 'job_id');
    }

}
