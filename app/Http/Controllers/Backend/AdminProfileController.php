<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AdminIndex()
    {
        $admins = Admin::all();
        return view('admin.user.admin_index',compact('admins'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AdminCreate()
    {
        return view('admin.user.admin_index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function AdminStore(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|string|email|max:255|unique:admins',
            'password'=>'required|string',
            'role_id'=>'required',
        ]);

        $data = $request->all();
        $data['password']= Hash::make($request->password);
        Admin::create($data);
        toast('Admin created!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('admins.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function AdminEdit($id)
    {
        $user = Admin::where('id',$id)->first();
        $userId = $user->id;
        $admin = Admin::find($userId);
        return view('admin.user.admin_index',compact('admin','userId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function AdminUpdate(Request $request, $id)
    {
         $this->validate($request,[
            'name'=>'required',
            'email'=>'required|string|email|max:255|unique:admins,email,'.$id,
            'role_id'=>'required',
        ]);
        $data = $request->all();
        $admin = Admin::find($id);
        if($request->password){
            $password = $request->password;
        }else{
            $password = $admin->password;
        }
        $data['password']= $password;
        $admin->update($data);
        toast('Admin updated!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('admins.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function AdminDelete($id)
    {
        $admin = Admin::find($id);
        $filename = $admin->profile_photo_url;
        $admin->delete();
        Storage::delete($filename);
        // $post = Post::find($user->id);
        // $Postfilename = $post->image;
        // $post->delete();
        // \Storage::delete($Postfilename);
        toast('Admin deleted!','success')->autoClose(3000)->width('450px')->timerProgressBar();
       return redirect()->route('admins.index');

    }

    public function AdminProfile(){
    	$id = Auth::user()->id;
    	$admin = Admin::find($id);

    	return view('admin.profile.show',compact('admin'));
    }

    public function AdminEditProfile(){
        $admin= Admin::find(auth()->user()->id);
        $id = Auth::id();
        $userId = Auth::user()->id;
        //  dd(auth()->user()->id);
        // dd($id);
        // Check for correct user
        if($userId !==$id){
            return redirect('/admin/dashboard');
        }
        return view('admin.profile.update-profile-information-form',compact('admin'));
    }

    public function AdminStoreProfile(Request $request){
         $this->validate($request,[
            'name'=>'required',
            'profile_photo_path'=>'mimes:jpeg,jpg,png',
        ]);
        $data = Admin::find(Auth::user()->id);
        $data->name = $request->name;
        if($request->hasFile('profile_photo_path')){
            $image_path = $data->profile_photo_path;
            if($image_path!=null){
                unlink($image_path);
            }
            $image = $request->file('profile_photo_path');
            $name_gen = 'ecom'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(200,200)->save('storage/profile-photos/'.$name_gen);
            $image_url = 'storage/profile-photos/'.$name_gen;
        }else{
            $image_url = $data->profile_photo_path;
        }
        $data['profile_photo_path']=$image_url;
        if($request->delete_photo == 1){
            $image_path = $data->profile_photo_path;
            unlink($image_path);
            $data['profile_photo_path']=NULL;
        }
        $data->save();
        toast('Profile updated!','success')->autoClose(3000)->width('450px')->timerProgressBar();
        return redirect()->back();
    }

    public function AdminPasswordProfile(){
        $admin= Admin::find(auth()->user()->id);
        $id = Auth::id();
        $userId = Auth::user()->id;
        //  dd(auth()->user()->id);
        // dd($id);
        // Check for correct user
        if($userId !==$id){
            return redirect('/admin/dashboard');
        }
        return view('admin.profile.update-password-form',compact('admin'));
    }

    public function AdminUpdatePassword(Request $request){
        $this->validate($request,[
           'current_password' => 'required',
           'password' => 'required|confirmed',
       ]);
       $hashedPassword = Auth::user()->password;
        if (Hash::check($request->current_password,$hashedPassword)) {
            $user = Admin::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            auth()->guard('admin')->logout();
            // Auth::logout();
            toast('Password updated!','success')->autoClose(3000)->width('450px')->timerProgressBar();
            return redirect()->route('admin.logout');
        }else{
            toast('Something went wrong!','error')->autoClose(3000)->width('450px')->timerProgressBar();
            return redirect()->back();
        }
    } // End Metod

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UserIndex()
    {
        $users = User::latest()->get();
        return view('admin.user.user_index',compact('users'));

    }
}
