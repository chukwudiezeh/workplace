<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    use HasFactory;

    protected $table = 'durations';

    protected $fillable = [
        'name'
    ];


    public function job(){
        return $this->hasMany(Job::class,'duration_id');
    }
}
