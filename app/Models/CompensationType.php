<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompensationType extends Model
{
    use HasFactory;

    protected $table = 'compensation_types';

    protected $fillable = [
        'name'
    ];


    public function job(){
        return $this->hasMany(Job::class,'compensation_type_id');
    }
}
