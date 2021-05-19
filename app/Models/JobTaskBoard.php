<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTaskBoard extends Model
{
    use HasFactory;

    protected $table = "job_task_boards";

    protected $fillable = ['contract_id','job_tasks'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'job_tasks' => 'array',
    ];
}
