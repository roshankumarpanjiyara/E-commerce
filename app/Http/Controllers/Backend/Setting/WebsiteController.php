<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class WebsiteController extends Controller
{
    //website setting
    public function websiteSetting(){

    	$site = WebsiteSetting::find(1);
    	return view('backend.setting.website',compact('site'));
    }
 

    public function websiteSettingUpdate(Request $request){

        $site_id = $request->id;

    	$this->validate($request,[
            'icon'=>'mimes:png,jpg,jpeg',
            'logo'=>'mimes:png,jpg,jpeg',
            'phone' => 'required',
            'email' => 'required',
            'company_name'=>'required',
            'company_address'=>'required|max:100',
        ]);

        $data = $request->all();
        $site = WebsiteSetting::findOrFail($site_id);
        if($request->hasFile('icon')){
            $icon_path = $site->icon;
            if($icon_path!=null){
                unlink($icon_path);
            }
            $icon = $request->file('icon');
            $name_gen = 'icon_'.hexdec(uniqid()).'.'.$icon->getClientOriginalExtension();
            Image::make($icon)->resize(330,250)->save('storage/website/icon/'.$name_gen);
            $icon_url = 'storage/website/icon/'.$name_gen;
        }else{
            $icon_url = $site->icon;
        }
        if($request->hasFile('logo')){
            $logo_path = $site->logo;
            if($logo_path!=null){
                unlink($logo_path);
            }
            $logo = $request->file('logo');
            $name_gen = 'logo_'.hexdec(uniqid()).'.'.$logo->getClientOriginalExtension();
            Image::make($logo)->resize(750,270)->save('storage/website/logo/'.$name_gen);
            $logo_url = 'storage/website/logo/'.$name_gen;
        }else{
            $logo_url = $site->logo;
        }
        $data['icon']=$icon_url;
        $data['logo']=$logo_url;
        $site->update($data);

        toast('Site Setting Updated!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return Redirect()->back();

    } // end method 
}
