<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class IndexController extends Controller
{
    //front page
    public function welcome(){
        $sliders = Slider::where('status',1)->limit(4)->latest()->get();
        $categories = Category::all();
        $brands = Brand::all();

        $products = Product::where('reviewed',1)->where('status',1)->inRandomOrder()->limit(10)->latest()->get();
        $featureds = Product::where('reviewed',1)->where('status',1)->where('featured',1)->limit(10)->latest()->get();
        $special_deals = Product::where('reviewed',1)->where('status',1)->where('special_deal',1)->limit(10)->latest()->get();
        $special_offers = Product::where('reviewed',1)->where('status',1)->where('special_offer',1)->limit(10)->latest()->get();
        $hot_deals = Product::where('reviewed',1)->where('status',1)->where('hot_deal',1)->limit(4)->latest()->get();

        $skip_category_0 = Category::skip(0)->first();
    	$skip_product_0 = Product::where('reviewed',1)->where('status',1)->where('category_id',$skip_category_0->id)->limit(5)->orderBy('id','DESC')->get();

    	$skip_category_1 = Category::skip(1)->first();
    	$skip_product_1 = Product::where('reviewed',1)->where('status',1)->where('category_id',$skip_category_1->id)->limit(5)->orderBy('id','DESC')->get();

        $skip_brand_0 = Brand::skip(1)->first();
    	$skip_brand_product_0 = Product::where('reviewed',1)->where('status',1)->where('brand_id',$skip_brand_0->id)->limit(5)->orderBy('id','DESC')->get();

        $skip_brand_1 = Brand::skip(1)->first();
    	$skip_brand_product_1 = Product::where('reviewed',1)->where('status',1)->where('brand_id',$skip_brand_1->id)->limit(5)->orderBy('id','DESC')->get();


        DB::statement("SET SQL_MODE=''");
        $category_max_product = Category::select('categories.*', DB::raw('count(products.id) as posts_count'))
        ->with('product')
		->leftJoin('products', 'products.category_id', 'categories.id')
		->groupBy('categories.id')
		->orderBy('posts_count', 'desc')
		->limit(2)
		->get();

        $brand_max_product = Brand::select('brands.*', DB::raw('count(products.id) as posts_count'))
        ->with('product')
		->leftJoin('products', 'products.brand_id', 'brands.id')
		->groupBy('brands.id')
		->orderBy('posts_count', 'desc')
		->limit(2)
		->get();


        return view('welcome',compact('sliders','categories','brands','products','featureds','special_deals','special_offers','hot_deals','skip_category_0','skip_product_0','skip_category_1','skip_product_1','skip_brand_0','skip_brand_product_0','skip_brand_1','skip_brand_product_1','category_max_product','brand_max_product'));
    }

    //product details
    public function productDetails($sku,$id,$slug){
        $products = Product::where('reviewed',1)->where('status',1)->where('product_sku',$sku)->where('id',$id)->where('product_slug',$slug)->first();
        $productId = $products->id;
        $product = Product::findOrFail($productId);

        $size = $product->product_size;
		$size = json_decode($size);
		$product_size = collect($size)->pluck('value')->toArray();

        $tags = $product->product_tags;
		$tags = json_decode($tags);
		$product_tags = collect($tags)->pluck('value')->toArray();

        $multiImages = MultiImage::where('product_id',$productId)->get();
        $productFromSameCategory = Product::inRandomOrder()->where('reviewed',1)->where('status',1)->where('category_id',$product->category_id)->where('id','!=',$product->id)->limit(8)->get();
        $productFromSameSubSubCategory = Product::inRandomOrder()->where('reviewed',1)->where('status',1)->where('subsubcategory_id',$product->subsubcategory_id)->where('id','!=',$product->id)->limit(8)->get();
        return view('frontend.product.product_details',compact('products','productId','product','multiImages','productFromSameCategory','productFromSameSubSubCategory','size','product_size','tags','product_tags'));
    }

    //subcategory wise product
    public function productSubcategoryDetails($id){
        $subcategory = SubCategory::where('id',$id)->first();
        $hot_deals = Product::where('reviewed',1)->where('status',1)->where('hot_deal',1)->limit(4)->latest()->get();
        $products = Product::where('reviewed',1)->where('status',1)->where('subcategory_id',$id)->latest()->paginate(2);
        return view('frontend.product.subcategory-details',compact('products','subcategory','hot_deals'));
    }

    //sub sub category wise product
    public function productSubsubcategoryDetails($id){
        $subsubcategory = SubSubCategory::where('id',$id)->first();
        $hot_deals = Product::where('reviewed',1)->where('status',1)->where('hot_deal',1)->limit(4)->latest()->get();
        $products = Product::where('reviewed',1)->where('status',1)->where('subsubcategory_id',$id)->latest()->paginate(2);
        return view('frontend.product.sub-subcategory-details',compact('products','subsubcategory','hot_deals'));
    }

    //brand wise product
    public function productBrandDetails($id){
        $brand = Brand::where('id',$id)->first();
        $hot_deals = Product::where('reviewed',1)->where('status',1)->where('hot_deal',1)->limit(4)->latest()->get();
        $products = Product::where('reviewed',1)->where('status',1)->where('brand_id',$id)->latest()->paginate(2);
        return view('frontend.product.brand-details',compact('products','hot_deals','brand'));
    }

    //product view modal
    public function productViewAjax($id){
        $product = Product::with('subsubcategory','brand')->findOrFail($id);
        $multiImages = MultiImage::where('product_id',$product->id)->get();

		$size = $product->product_size;
		$size = json_decode($size);
		$product_size = collect($size)->pluck('value')->toArray();

		return response()->json(array(
			'product' => $product,
			'size' => $product_size,
            'multiImages' => $multiImages,
		));
    }

    //about us
    public function aboutUs(){
        return view('frontend.pages.about');
    }

    //contact us
    public function contactUs(){
        return view('frontend.pages.contact');
    }

    //contact store
    public function contactStore(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required | digits:10 | numeric',
            'subject' => 'required',
            'message' => 'required | max:1000'
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['subject'] = $request->subject;
        $data['message'] = $request->message;
        Contact::create($data);
        Alert::success('Message sent and will be updated soon!')->autoClose(3000);
        return Redirect()->back();
    }

    //product search
    public function productSearch(Request $request){
        $request->validate([
            "search" => "required | min:3",
        ]);
        $item = $request->search;
        // dd($item);
        if($item){
            $products = Product::where('product_name','LIKE','%'.$item.'%')
            ->limit(10)
            ->get();
            
            return view('frontend.pages.product_search',compact('products'));
        }
    }

    //blog
    public function blogIndex(){
        $blogcategories = BlogCategory::get();
        $posts = BlogPost::where('status',1)->latest()->paginate(9);
        return view('frontend.blog.index',compact('posts','blogcategories'));
    }

    //blog category
    public function blogCategoryIndex($slug, $id){
        $blogcategories = BlogCategory::get();
        $blogcategory = BlogCategory::where('slug',$slug)->where('id',$id)->first();
        $posts = BlogPost::where('blog_category_id',$blogcategory->id)->where('status',1)->latest()->paginate(2);
        return view('frontend.blog.category',compact('blogcategory','posts','blogcategories'));
    }

    //blog show
    public function showBlog($slug, $id){
        $blogcategories = BlogCategory::get();
        $post = BlogPost::where('slug',$slug)->where('id',$id)->where('status',1)->first();
        return view('frontend.blog.show',compact('post','blogcategories'));
    }

    //blog-search
    public function blogSearch(Request $request){
        $request->validate([
            "search" => "required | min:3",
        ]);
        $item = $request->search;
        // dd($item);
        if($item){
            $posts = BlogPost::where('title','LIKE','%'.$item.'%')
            ->latest()
            ->limit(10)
            ->get();
            
            return view('frontend.blog.blog_search',compact('posts'));
        }
    }

    //blog search index
    public function blogSearchIndex(Request $request){
        $request->validate([
            "search" => "required | min:3"
        ]);
        if($request->search){
            $posts = BlogPost::where('title','like','%'.$request->search.'%')
            ->latest()
            ->paginate(9);

            $blogcategories = BlogCategory::get();
            return view('frontend.blog.search',compact('posts','blogcategories'));
        }
    }

    public function test(){
        DB::statement("SET SQL_MODE=''");
        $result = Category::select('categories.*', DB::raw('count(products.id) as posts_count'))
        ->with('product')
		->leftJoin('products', 'products.category_id', 'categories.id')
		->groupBy('categories.id')
		->orderBy('posts_count', 'desc')
		->limit(2)
		->get();
        // dd($result);
        return view('frontend.test',compact('result'));
    }
}
