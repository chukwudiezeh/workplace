<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $table = 'conversations';


    protected $fillable =['title', 'client_id', 'job_id', 'participants'];

    protected $casts = [
        'participants' => 'array',
    ];

    public function job(){
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function messages(){
        return $this->hasOne(Message::class, 'conversation_id');
    }
}
