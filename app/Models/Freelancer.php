<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelancer extends Model
{
    use HasFactory;

    protected $table = 'freelancers';

    protected $fillable = ['user_id','overview','address','experience_level_id','category_id','subcategory_id','hourly_rate'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function employmentHistories(){
        return $this->hasMany(EmploymentHistory::class,'freelancer_id');
    }

    public function educations(){
        return $this->hasMany(Education::class,'freelancer_id');
    }

    public function portfolios(){
        return $this->hasMany(Portfolio::class,'freelancer_id');
    }

    public function proposals(){
        return $this->hasMany(Proposal::class,'freelancer_id');
    }

    public function jobInvites(){
        return $this->hasMany(JobInvites::class,'freelancer_id');
    }

    public function contracts(){
        return $this->hasMany(Contract::class,'client_id');
    }
    public function experienceLevel(){
        return $this->belongsTo(ExperienceLevel::class,'experience_level_id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }
}
