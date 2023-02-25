<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Product;
use App\Models\MultiImage;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpParser\Parser\Multiple;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('backend.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::orderBy('name','ASC')->get();
        $categories = Category::orderBy('name','ASC')->get();
        $subcategories = SubCategory::orderBy('name','ASC')->get();
        $subsubcategories = SubSubCategory::orderBy('name','ASC')->get();
        return view('backend.product.create',compact('brands','categories','subcategories','subsubcategories'));
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
            'brand_id'=>'required',
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'subsubcategory_id'=>'required',
            'product_name'=>'required|max:200',
            'product_sku'=>'required|unique:products,product_sku',
            'product_qty'=>'required|numeric|min:0',
            'product_tags'=>'required',
            'product_size'=>'required',
            'product_thumbnail'=>'required',
            'base_price'=>'required',
            'selling_price'=>'required',
            'long_description'=>'required',
            'meta_title'=>'max:100',
            'meta_description'=>'max:200',
        ]);
        // $data = $request->all();
        // $image = $request->file('product_thumbnail');
        // $name_gen = 'product_thumbnail_'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // Image::make($image)->resize(917,1000)->save('storage/product/thumbnail/'.$name_gen);
        // $image_url = 'storage/product/thumbnail/'.$name_gen;
        // $data['product_thumbnail']=$image_url;
        // $data['product_slug']=Str::slug($request->name);
        // $data['status'] = 1;
        // $data['product_code'] = '#'.rand(10000000, 99999999);
        // $data['created_at'] = Carbon::now();
        // $product_id = Product::insertGetId($data);
        // dd($product_id);
        // $images = $request->file('multi_image');
        // foreach ($images as $img) {
        //     $make_name = 'product_multi_'.hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        //     Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
        //     $uploadPath = 'upload/products/multi-image/'.$make_name;

        //     MultiImage::insert([

        //         'product_id' => $product_id,
        //         'image' => $uploadPath,
        //         'created_at' => Carbon::now(),

        //     ]);

        // }

        $image = $request->file('product_thumbnail');
        $name_gen = 'product_thumbnail_'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('storage/product/thumbnail/'.$name_gen);
        $image_url = 'storage/product/thumbnail/'.$name_gen;

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name' => $request->product_name,
            'product_slug' =>  Str::slug($request->product_name),
            'product_code' => '#'.rand(10000000, 99999999),

            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_sku' => $request->product_sku,

            'base_price' => $request->base_price,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,

            'hot_deal' => $request->hot_deal,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deal' => $request->special_deal,

            'product_thumbnail' => $image_url,
            'status' => 1,
            'reviewed' => 0,
            'created_at' => Carbon::now(),
        ]);


      ////////// Multiple Image Upload Start ///////////

        $images = $request->file('multi_image');
        foreach ($images as $img) {
            $make_name = 'product_multi_'.hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('storage/product/multi-image/'.$make_name);
            $uploadPath = 'storage/product/multi-image/'.$make_name;
            MultiImage::insert([
                'product_id' => $product_id,
                'image' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        };
      ////////// Een Multiple Image Upload Start ///////////

        Alert::success('Product created and will be approved!')->autoClose(3000);
        // toast('Product created successfully!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('products.index');
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
        $product = Product::findOrFail($id);
        $brands = Brand::orderBy('name','ASC')->get();
        $categories = Category::orderBy('name','ASC')->get();
        $subcategories = SubCategory::orderBy('name','ASC')->get();
        $subsubcategories = SubSubCategory::orderBy('name','ASC')->get();
        $multiImgs = MultiImage::where('product_id',$id)->get();
        return view('backend.product.edit',compact('product','brands','categories','subcategories','subsubcategories','multiImgs'));
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
            'brand_id'=>'required',
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'subsubcategory_id'=>'required',
            'product_name'=>'required|max:200',
            'product_sku'=>'required|unique:products,product_sku,'.$id,
            'product_qty'=>'required|numeric|min:0',
            'product_tags'=>'required',
            'product_size'=>'required',
            'base_price'=>'required',
            'selling_price'=>'required',
            'long_description'=>'required',
            'meta_title'=>'max:100',
            'meta_description'=>'max:200',
        ]);

        $data = $request->all();
        $product = Product::findOrFail($id);
        if($request->hasFile('product_thumbnail')){
            $image_path = $product->product_thumbnail;
            if($image_path!=null){
                unlink($image_path);
            }
            $image = $request->file('product_thumbnail');
            $name_gen = 'product_thumbnail_'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(917,1000)->save('storage/product/thumbnail/'.$name_gen);
            $image_url = 'storage/product/thumbnail/'.$name_gen;
        }else{
            $image_url = $product->product_thumbnail;
        }
        $data['product_thumbnail']=$image_url;
        $data['product_slug']=Str::slug($request->product_name);
        $product->update($data);
        toast('Product updated successfully!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $images = MultiImage::where('product_id',$id)->get();
     	foreach ($images as $img) {
     		unlink($img->image);
     		MultiImage::where('product_id',$id)->delete();
     	}
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        $product->delete();
        toast('Product deleted!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->back();
    }

    //pending product
    public function PendingIndex()
    {
        $products = Product::where('reviewed', 0)->get();
        return view('backend.product.pending',compact('products'));
    }

    //accept-reject
    public function acceptReject($id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'reviewed' => 1,
        ]);
        toast('Product approved!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('pending.index');
    }

    //product inactive
    public function productInactive($id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'status' => 0,
        ]);
        toast('Product inactive!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('products.index');
    }

    //product active
    public function productActive($id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'status' => 1,
        ]);
        toast('Product active!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('products.index');
    }

    //update single image in multi image
    public function updateImage(Request $request){
        $imgs = $request->multi_image;

		foreach ($imgs as $id => $img) {
            $imgDel = MultiImage::findOrFail($id);
            unlink($imgDel->image);

            $make_name = 'product_multi_'.hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('storage/product/multi-image/'.$make_name);
            $uploadPath = 'storage/product/multi-image/'.$make_name;

            MultiImage::where('id',$id)->update([
                'image' => $uploadPath,
                'updated_at' => Carbon::now(),
    	    ]);

	    } // end foreach
        toast('Product Image updated!','success')->autoClose(5000)->width('450px')->timerProgressBar();
		return redirect()->back();
    }

    //delete single image in multi image
    public function destroyImage($id){
        $old_img = MultiImage::findOrFail($id);
        unlink($old_img->image);
        $old_img->delete();
        toast('Product Image delete!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->back();
    }
}
