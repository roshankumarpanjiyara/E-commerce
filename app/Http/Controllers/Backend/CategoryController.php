<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.category.create');
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
            'name'=>'required|unique:categories|max:50',
            'image'=>'required|mimes:jpeg,png,jpg,svg',
            'meta_title'=>'max:100',
            'meta_description'=>'max:200',
        ]);
        $data = $request->all();
        $image = $request->file('image');
        $name_gen = 'category_'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('storage/category/'.$name_gen);
        $image_url = 'storage/category/'.$name_gen;
        $data['image']=$image_url;
        $data['created_by'] = auth()->user()->name;
        $data['slug']=Str::slug($request->name);
        Category::create($data);
        toast('Category created successfully!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('categorys.index');
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
    public function edit($slug,$id)
    {
        $categories = Category::where('slug',$slug)->where('id',$id)->first();
        $categoryId = $categories->id;
        $category = Category::findOrFail($categoryId);
        return view('backend.category.category.edit',compact('categories','categoryId','category'));
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
            'name'=>'required|unique:categories,name,'.$id,
            'image'=>'mimes:jpeg,png,jpg,svg',
            'meta_title'=>'max:100',
            'meta_description'=>'max:200',
        ]);
        $data = $request->all();
        $category = Category::findOrFail($id);
        if($request->hasFile('image')){
            $image_path = $category->image;
            if($image_path!=null){
                unlink($image_path);
            }
            $image = $request->file('image');
            $name_gen = 'category_'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('storage/category/'.$name_gen);
            $image_url = 'storage/category/'.$name_gen;
        }else{
            $image_url = $category->image;
        }
        $data['image']=$image_url;
        $data['slug']=Str::slug($request->name);
        $category->update($data);
        toast('Categroy updated!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('categorys.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $image_path = $category->image;
        if($image_path!=null){
            unlink($image_path);
        }
        $category->delete();
        toast('Category deleted!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->back();
    }
}
