<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Toaster;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.brand.index");
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
            'name'=>'required|unique:brands|max:50',
            'image'=>'required|mimes:jpeg,png,jpg,svg',
        ]);
        $data = $request->all();
        $image = $request->file('image');
        $name_gen = 'brand_'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('storage/brands/'.$name_gen);
        $image_url = 'storage/brands/'.$name_gen;
        $data['image']=$image_url;
        $data['created_by'] = auth()->user()->name;
        $data['slug']=Str::slug($request->name);
        Brand::create($data);
        toast('Brand created successfully!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('brands.index');
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
    public function edit($slug)
    {
        $brands = Brand::where('slug',$slug)->first();
        $brandId = $brands->id;
        $brand = Brand::findOrFail($brandId);
        return view('backend.brand.index',compact('brands','brandId','brand'));
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
            'name'=>'required|unique:brands,name,'.$id,
            'image'=>'mimes:jpeg,png,jpg,svg',
        ]);
        $data = $request->all();
        $brand = Brand::findOrFail($id);
        if($request->hasFile('image')){
            $image_path = $brand->image;
            if($image_path!=null){
                unlink($image_path);
            }
            $image = $request->file('image');
            $name_gen = 'brand_'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('storage/brands/'.$name_gen);
            $image_url = 'storage/brands/'.$name_gen;
        }else{
            $image_url = $brand->image;
        }
        $data['image']=$image_url;
        $data['slug']=Str::slug($request->name);
        $brand->update($data);
        toast('Brand updated!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $brands = Brand::where('slug',$slug)->first();
        $brandId = $brands->id;
        $brand = Brand::findOrFail ($brandId);
        $image_path = $brand->image;
        if($image_path!=null){
            unlink($image_path);
        }
        $brand->delete();
        toast('Brand deleted!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->back();
    }
}
