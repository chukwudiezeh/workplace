<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';


    protected $fillable =['conversation_id', 'messages_details'];

    protected $casts = [
        'message_details' => 'array',
    ];

    public function conversation(){
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }
}
