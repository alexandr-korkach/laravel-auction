<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Carbon\Carbon;

class MessageController
{
    public function index(){
        $messages = Message::query()->where('created_at', '>', Carbon::parse('now - 24 hours') )
            ->orderBy('created_at', 'DESC')->paginate(50);

        return view('public.actions', compact('messages'));
    }

}
