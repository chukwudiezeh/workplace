<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelanceSkill extends Model
{
    use HasFactory;

    protected $table = 'freelance_skills';

    protected $fillable = ['freelancer_id','skill_id',];

}
