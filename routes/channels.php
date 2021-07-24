<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Conversation;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

//Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});

//Broadcast::channel('chatClient.{id}', function($user, $id){
//    return $user->id === \App\Models\Client::find($id)->user_id;
//});
//Broadcast::channel('chatFreelancer.{id}', function($user, $id){
//    return $user->id === \App\Models\Freelancer::find($id)->user_id;
//});

Broadcast::channel('chat.{conversation}', function($user, Conversation $conversation){
    if ($user->id == $conversation->client_id){
        return true;
    }
    foreach ($conversation->participants as $participant){
        if ($participant->user->id == $user->id){
            return true;
        }else{
            return false;
        }
    }
//    return $user->id === $conversation->participant;
});
