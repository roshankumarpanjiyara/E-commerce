<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    //seo setting
    public function seoSetting(){

    	$seo = SeoSetting::find(1);
    	return view('backend.setting.seo',compact('seo'));
    }
 

    public function seoSettingUpdate(Request $request){

        $seo_id = $request->id;

    	SeoSetting::findOrFail($seo_id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_url' => $request->meta_url,
            'meta_description' => $request->meta_description,
            'google_analytics' => $request->google_analytics,		 
    	]);

        toast('Seo Setting Updated!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return Redirect()->back();

    } // end mehtod 

}
