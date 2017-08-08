<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use File;
use Auth;
use App\User;
class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function AddAvatar(Request $request) {
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpg,png,jpeg|max:10000',
        ]);
        $user = User::find(Auth::user()->id);
        if ($user->image == 'images/users/avatar.jpg') {
            $user->image = $this->upload($request->image);
        }else {
            $image = public_path() . '/' .$user->image;
            if (File::exists($image)) {
                File::delete($image);
            }
            $user->image = $this->upload($request->image);
        }
        $user->save();
        return 'success';
    }

    public function upload($file) {
        $extension = $file->getClientOriginalExtension();
        $sha1 = sha1($file->getClientOriginalName());
        $filename = date('Y-m-d-h-i-s')."_".$sha1.".".$extension;
        $path = public_path('images/users');
        $file->move($path, $filename);
        return 'images/users/'.$filename;
    }
}
