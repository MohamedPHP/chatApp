<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Response;

use Auth;

use App\Room;
use App\Online;

class RoomsController extends Controller
{
    public function AddRoom(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:3|max:25|unique:rooms',
        ]);
        $room = new Room();
        $room->name = $request->name;
        $room->user_id = Auth::user()->id;
        $room->save();
        if ($room) {
            return Response::json('success', 200);
        }
        return Response::json('error', 403);
    }

    public function MyRooms() {
        $rooms = Room::where('user_id', Auth::user()->id)->with('user')->withCount('messages')->get();
        if ($rooms) {
            return Response::json(['rooms' => $rooms], 200);
        }
        return Response::json('error', 403);
    }

    public function AllRooms() {
        $rooms = Room::with('user')->withCount('messages')->get();
        if ($rooms) {
            return Response::json(['rooms' => $rooms], 200);
        }
        return Response::json('error', 403);
    }

    public function DeleteRoom($id) {
        $room = Room::find($id);
        if ($room) {
            if ($room->user_id == Auth::user()->id) {
                $room->delete();
                return 'room deleted';
            }
            return Response::json('error', 403);
        }
        return Response::json('error', 403);
    }

    public function getRoomMessages($id) {
        $room = Room::where('id', $id)->with('messages', 'messages.user')->first();
        if ($room) {
            return Response::json(['room' => $room, 'onlineUser' => Auth::user()], 200);
        }
        return Response::json('error', 403);
    }

    public function getOnlineUsers($id) {
        $room = Room::find($id);
        if ($room) {
            if (Online::where('user_id', Auth::user()->id)->count() == 0) {
                // on enter
                $this->CreateOnline(Auth::user()->id, $room->id);
            }else {
                // on leave
                $leavRoom = Online::where('user_id', Auth::user()->id)->first();
                Online::where('user_id', Auth::user()->id)->first()->delete();
                // update on leaving
                $arrayLeaving = [
                    'roomOnlineCount' => Room::where('id', $leavRoom->room_id)->withCount('online')->first()->online_count,
                    'who_is_online' => Online::where('room_id', $leavRoom->room_id)->with('users')->get(),
                    'ac' => Auth::user()->name . ' Has Left The Room ' . $leavRoom->name,
                ];
                $this->trigger_pusher($leavRoom->room_id . 'leaveuser', 'leaveUsers', $arrayLeaving);
                // CreateOnline
                $this->CreateOnline(Auth::user()->id, $room->id);
            }
            $roomOnlineCount = Room::where('id', $room->id)->withCount('online')->first()->online_count;
            $array = [
                'roomOnlineCount' => $roomOnlineCount,
                'who_is_online' => Online::where('room_id', $room->id)->with('users')->get(),
                'ac' => Auth::user()->name . ' Has Joined The Room ' . $room->name,
            ];
            $this->trigger_pusher($room->id . 'onlineuser', 'onlineUsers', $array);
            return $array;
        }
        return Response::json('error', 403);
    }


    public function RemoveLeavingUser($id) {
        // on leave
        $leavRoom = Online::where('user_id', Auth::user()->id)->first();
        Online::where('user_id', Auth::user()->id)->first()->delete();
        // update on leaving
        $arrayLeaving = [
            'roomOnlineCount' => Room::where('id', $leavRoom->room_id)->withCount('online')->first()->online_count,
            'who_is_online' => Online::where('room_id', $leavRoom->room_id)->with('users')->get(),
            'ac' => Auth::user()->name . ' Has Left The Room ' . $leavRoom->name,
        ];
        $this->trigger_pusher($leavRoom->room_id . 'leaveuser', 'leaveUsers', $arrayLeaving);
    }

    protected function CreateOnline($user_id, $room_id) {
        /* `user_id`, `room_id`, `timelogin`, `timelogout` */
        $online = new Online();
        $online->user_id = $user_id;
        $online->room_id = $room_id;
        $online->timelogin = date("Y-m-d H:i:s");
        $online->timelogout = 0;
        $online->save();
    }

}
