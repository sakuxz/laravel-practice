<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserAvatarRequest;
use File;
use Auth;
use \Carbon\Carbon;

class UserController extends Controller
{
    public function getAvatar()
    {
        return view('user.avatar');
    }

    public function postAvatar(UserAvatarRequest $request)
    {
        $file = $request->file('avatar');
        $destinationPath = 'upload/avatar';
        if (!file_exists(public_path() . '/' . $destinationPath)) {
            File::makeDirectory(public_path() . '/' . $destinationPath, 0755, true);
        }
        $ext = $file->getClientOriginalExtension();
        $fileName = Carbon::now()->timestamp . '.' . $ext;
        $file->move(public_path() . '/' . $destinationPath, $fileName);
        $user = Auth::user();
        $user->avatar = $destinationPath . '/' . $fileName;
        $user->save();
        
        return redirect()->route('home');
    }
}
