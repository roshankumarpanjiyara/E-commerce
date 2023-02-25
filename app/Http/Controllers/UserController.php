<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LogoutResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userDashboard(){
        return view('dashboard');
    }

    public function UserProfileEdit($id,$name){
        $id = Auth::user()->id;
        $name = Auth::user()->name;
        $users = User::where('id',$id)->where('name',$name)->first();
        $id = Auth::id();
        $userId = Auth::user()->id;
        $user= User::findOrFail($userId);
        //  dd(auth()->user()->id);
        // dd($user);
        // Check for correct user
        if($userId !==$id){
            return redirect('/dashboard');
        }
        return view('frontend.profile.user-edit',compact('user'));
    }

    public function UserProfileUpdate(Request $request,$id){
        $this->validate($request,[
           'name'=>'required',
           'email'=>'required|string|email|max:255|unique:users,email,'.$id,
           'phone'=>'required|numeric|digits:10'
       ]);
       $data = User::findOrFail(Auth::user()->id);
       $data->name = $request->name;
       $data->email = $request->email;
       $data->phone = $request->phone;
       $data->save();
       toast('User updated!','success')->autoClose(5000)->width('450px')->timerProgressBar();
       return redirect()->back();
    }

    public function UserPasswordView($id,$name){
        $id = Auth::user()->id;
        $name = Auth::user()->name;
        $users = User::where('id',$id)->where('name',$name)->first();
        $id = Auth::id();
        $userId = Auth::user()->id;
        $user= User::findOrFail($userId);
        //  dd(auth()->user()->id);
        // dd($id);
        // Check for correct user
        if($userId !==$id){
            return redirect('/dashboard');
        }
        return view('frontend.profile.password-view',compact('user'));
    }

    public function UserPasswordChange(Request $request){
        $this->validate($request,[
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->current_password,$hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            // auth()->guard('web')->logout();
            toast('Password updated!','success')->autoClose(3000)->width('450px')->timerProgressBar();
            return redirect()->route('login');
        }else{
            toast('Something went wrong!','error')->autoClose(3000)->width('450px')->timerProgressBar();
            return redirect()->back();
        }
    } // End Metod
}
