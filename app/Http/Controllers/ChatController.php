<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function index(){
        $messages = Message::with('user')
        ->get()
        ->values();

        return Inertia::render('Chat/Index',[
          'messages' =>  $messages,
           
        ]);
    }
}
