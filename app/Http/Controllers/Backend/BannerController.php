<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        return view('backend.banner.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|max:50',
            'banner_img'=>'required',
            'type'=>'required'
        ]);

        $data = array();
 	    $data['title'] = $request->title;
 	    $data['link'] = $request->link;
 	    $data['description'] = $request->description;
        if ($request->type == 2) {
            $image = $request->file('banner_img');
            $name_gen = 'banner_hori_'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('storage/banners/'.$name_gen);
            $image_url = 'storage/banners/'.$name_gen;
            $data['banner_img'] = $image_url;
            $data['type'] = 2;
            Banner::create($data);
            toast('Horizontal Banner created!','success')->autoClose(5000)->width('450px')->timerProgressBar();
            return Redirect()->route('banners.index');
        }else{
            $image = $request->file('banner_img');
            $name_gen = 'banner_vert_'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('storage/banners/'.$name_gen);
            $image_url = 'storage/banners/'.$name_gen;
            $data['banner_img'] = $image_url;
            $data['type'] = 1;
            Banner::create($data);
            toast('Vertical Banner created!','success')->autoClose(5000)->width('450px')->timerProgressBar();
            return Redirect()->route('banners.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('backend.bannner.index',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required|max:50',
            'type'=>'required'
        ]);
        $data = $request->all();
        $banner = Banner::find($id);
        if($request->hasFile('banner_img')){
            $image_path = $banner->banner_img;
            if($image_path!=null){
                unlink($image_path);
            }
            if ($request->type == 2) {
                $image = $request->file('banner_img');
                $name_gen = 'banner_hori_'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->save('storage/banners/'.$name_gen);
                $image_url = 'storage/banners/'.$name_gen;
                $data['type'] = 2;
            }else{
                $image = $request->file('banner_img');
                $name_gen = 'banner_vert_'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->save('storage/banners/'.$name_gen);
                $image_url = 'storage/banners/'.$name_gen;
                $data['type'] = 1;
            }
        }else{
            $image_url = $banner->banner_img;
        }
        $data['banner_img']=$image_url;
        $banner->update($data);
        toast('Banner updated!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $image_path = $banner->banner_img;
        if($image_path!=null){
            unlink($image_path);
        }
        $banner->delete();
        toast('Banner deleted!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->back();
    }

    public function bannerInactive($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update([
            'status' => 0,
        ]);
        toast('Banner inactive!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('banners.index');
    }

    public function bannerActive($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update([
            'status' => 1,
        ]);
        toast('Banner active!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('banners.index');
    }
}
