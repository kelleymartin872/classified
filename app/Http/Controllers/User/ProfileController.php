<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile.index');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'image'=>'mimes:png,jpg,jpeg'
        ]);
        $id = Auth::user()->id;
        $user = User::find($id);
        $image=$user->avatar;
        if($request->hasFile('image')){
            $image = $request->file('image')->store('public/avatar');
        }
        $user->name = $request->name;
        $user->address = $request->address;
        $user->avatar = $image;
        $user->save();
        return redirect()->back()->with('success','Profile updated');
    }
    public function password()
    {
        $user = User::find(Auth::user()->id);
        return view('user.profile.password',compact('user'));
    }
    public function passwordSave(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // $current = bcrypt(Auth::user()->password);
        $current = (Auth::user()->password);
        $current_pass = $request->old_password;
        if(!Hash::check($current_pass, $current)){
            return back()->with('error','Current Password is incorrect, kindly cross check and try again');
        }else {
            $password = bcrypt($request->password);
            $ch = User::find(Auth::user()->id);
            $ch->password = $password;
            $ch->save();
            return redirect()->back()->with('success','Password Updated Successfully, kindly keep it safe');
        }
       
       

    }
}
