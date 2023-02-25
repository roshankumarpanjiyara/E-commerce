<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.index',compact('sliders'));
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
            'title'=>'required|max:500',
            'slider_img'=>'required|mimes:jpeg,png,jpg,svg',
        ]);
        $data = $request->all();
        $image = $request->file('slider_img');
        $name_gen = 'slider_'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('storage/sliders/'.$name_gen);
        $image_url = 'storage/sliders/'.$name_gen;
        $data['slider_img']=$image_url;
        Slider::create($data);
        toast('Slider created successfully!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('sliders.index');
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
        $slider = Slider::findOrFail($id);
        return view('backend.slider.index',compact('slider'));
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
            'title'=>'required|max:500',
            'image'=>'mimes:jpeg,png,jpg,svg',
        ]);
        $data = $request->all();
        $slider = Slider::findOrFail($id);
        if($request->hasFile('slider_img')){
            $image_path = $slider->slider_img;
            if($image_path!=null){
                unlink($image_path);
            }
            $image = $request->file('slider_img');
            $name_gen = 'slider_'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('storage/sliders/'.$name_gen);
            $image_url = 'storage/sliders/'.$name_gen;
        }else{
            $image_url = $slider->slider_img;
        }
        $data['slider_img']=$image_url;
        $slider->update($data);
        toast('Slider updated!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail ($id);
        $image_path = $slider->slider_img;
        if($image_path!=null){
            unlink($image_path);
        }
        $slider->delete();
        toast('Slider deleted!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->back();
    }

    public function sliderInactive($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->update([
            'status' => 0,
        ]);
        toast('Slider inactive!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('sliders.index');
    }

    public function sliderActive($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->update([
            'status' => 1,
        ]);
        toast('Slider active!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('sliders.index');
    }
}
