<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name','ASC')->get();
        $subcategories = SubCategory::latest()->get();
        return view('backend.category.subcategory.index',compact('subcategories','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name','ASC')->get();
        $subcategories = SubCategory::latest()->get();
        return view('backend.category.subcategory.index',compact('subcategories','categories'));
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
            'name' => ['required'],
            'category_id'=>'required',
        ]);
        $data = $request->all();
        $data['created_by'] = auth()->user()->name;
        $data['slug']=Str::slug($request->name);
        Subcategory::create($data);
        toast('Subcategory created successfully!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('subcategorys.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();
        toast('Subcategory deleted!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->back();
    }

    // ---------- Sub->Sub Category-------------

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subindex()
    {
        $categories = Category::orderBy('name','ASC')->get();
        $subcategories = SubCategory::orderBy('name','ASC')->get();
        $subsubcategories = SubSubCategory::latest()->get();
        return view('backend.category.subsubcategory.index',compact('subcategories','categories','subsubcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subcreate()
    {
        $categories = Category::orderBy('name','ASC')->get();
        $subcategories = SubCategory::orderBy('name','ASC')->get();
        $subsubcategories = SubSubCategory::latest()->get();
        return view('backend.category.subsubcategory.index',compact('subcategories','categories','subsubcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function substore(Request $request)
    {
        $this->validate($request,[
            'name' => ['required'],
            'category_id'=>'required',
            'subcategory_id'=>'required',
        ]);
        $data = $request->all();
        $data['created_by'] = auth()->user()->name;
        $data['slug']=Str::slug($request->name);
        SubSubcategory::create($data);
        toast('Sub Subcategory created successfully!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('subsubcategorys.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function subdestroy($id)
    {
        $subcategory = SubSubcategory::findOrFail($id);
        $subcategory->delete();
        toast('Sub Subcategory deleted!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->back();
    }

    public function getSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('name','ASC')->get();
        return json_encode($subcat);
    }

    public function getSubSubCategory($subcategory_id)
    {
        $subsubcat = SubSubCategory::where('subcategory_id',$subcategory_id)->orderBy('name','ASC')->get();
        return json_encode($subsubcat);
    }
}
