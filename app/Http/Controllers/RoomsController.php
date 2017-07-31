<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Response;

use Auth;

use App\Room;

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
        $room = Room::where('id', $id)->with('messages')->first();
        if ($room) {
            return Response::json(['room' => $room, 'onlineUser' => Auth::user()], 200);
        }
        return Response::json('error', 403);
    }


}
