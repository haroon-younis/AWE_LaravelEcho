<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;

class ContactsController extends Controller
{
     public function get()
    {
        $contacts = User::all();

        return response()->json($contacts);
    }

    public function getMessagesFor($id)
    {
      // get messages
      $messages = Message::where('from', $id)->orWhere('to', $id)->get();

      return response()->json($messages); // returns the messages in json
    }
}
