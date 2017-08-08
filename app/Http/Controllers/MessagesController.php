<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Message;

use App\Room;

use Auth;

class MessagesController extends Controller
{

    public function AddMessage(Request $request) {
        $this->validate($request, [
            'body' => 'required',
        ]);
        if (!Room::find($request->room_id)) {
            return Response::json('error', 403);
        }
        $message = new Message();
        $message->room_id = $request->room_id;
        $message->user_id = Auth::user()->id;
        $message->body = $request->body;
        $message->save();
        if ($message) {
            $messageData = Message::where('id', $message->id)->with('user')->first();
            $this->trigger_pusher($messageData->room_id . 'room', 'newMessage', $messageData);
            return [
                'message' => $messageData,
                'status' => 'done',
            ];
        }
        return Response::json('error', 403);
    }
}
