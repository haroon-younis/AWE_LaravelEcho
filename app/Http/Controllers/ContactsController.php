<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Events\NewMessage;

class ContactsController extends Controller
{
     public function get()
    {
        $contacts = User::where('id', '!=', auth()->id())->get();

        return response()->json($contacts);
    }

    public function getMessagesFor($id)
    {
      // get messages
      $messages = Message::where('from', $id)->orWhere('to', $id)->get();

      return response()->json($messages); // returns the messages in json
    }

    public function send(Request $request)
    {
      $message = Message::create([
        'from' => auth()->id(),
        'to' => $request->contact_id,
        'text' => $request->text

      ]);

      broadcast(new NewMessage($message)); // firing event
      //event(new NewMessage($message));

      return response()->json($message);
    }
}
