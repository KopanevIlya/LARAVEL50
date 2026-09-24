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



    public function store(Request $request)
    {
        $request->validate([
            'message' => ['required', 'string','max:255'],
           
        ]);

     Message::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
    
        ]);


        return redirect() ->route('chat.index');
    }


    public function update(Request $request, Message $message)
    {
        if($message->user_id !== auth()->id()){
          abort(403);
        }
        
        $request->validate([
            'message' => ['required', 'string','max:1000'],
           
        ]);

        $message->update(
          ['message' => $request->message]
        );

        return redirect() ->route('chat.index');
    }



    public function destroy(Message $message){
      if($message->user_id !== auth()->id()){
        abort(403);
      }

      $message->delete();

      return redirect() ->route('chat.index');
    }

    
}
