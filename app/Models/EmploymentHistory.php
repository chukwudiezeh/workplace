<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentHistory extends Model
{
    use HasFactory;

    protected $table = 'employment_histories';

    protected $fillable = ['freelancer_id','company','location','title','role','start_year','end_year','currently_working'];


}
