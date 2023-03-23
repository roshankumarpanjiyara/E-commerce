<?php

namespace App\Http\Controllers\Backend\blog;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = BlogPost::with('blogcategory')->latest()->get();
        return view('backend.blog.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BlogCategory::latest()->get();
        return view('backend.blog.post.create',compact('categories'));
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
            'title'=>'required|max:200',
            'body'=>'required|max:5000',
            'image'=>'mimes:jpeg,png,jpg',
            'category'=>'required'
        ]);
        $data = [];
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name_gen = 'blog_'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('storage/blogs/'.$name_gen);
            $image_url = 'storage/blogs/'.$name_gen;
        }else{
            $image_url = NULL;
        }
        $data['title'] = $request->title;
        $data['body'] = $request->body;
        $data['image']=$image_url;
        $data['blog_category_id']=$request->category;
        $data['created_by'] = auth()->user()->name;
        $data['status']=0;
        $data['slug']=Str::slug($request->title);
        BlogPost::create($data);
        //  notify()->success('Post created and will be approved within 24 hours!');
        Alert::success('Post created and will be approved within 24 hours!')->autoClose(3000);
        return redirect()->route('blog.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$slug)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$slug)
    {
        $posts = BlogPost::where('id',$id)->where('slug',$slug)->first();
        $postId = $posts->id;
        $post = BlogPost::find($postId);
        return view('backend.blog.post.edit',compact('post','posts','postId'));
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
            'title'=>'required|max:200',
            'body'=>'required|max:5000',
            'image'=>'mimes:jpeg,png,jpg',
            'category'=>'required'
        ]);
        $data = [];
        $post = BlogPost::findOrFail($id);
        if($request->hasFile('image')){
            $image_path = $post->image;
            if($image_path!=null){
                unlink($image_path);
            }
            $image = $request->file('image');
            $name_gen = 'blog_'.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('storage/blogs/'.$name_gen);
            $image_url = 'storage/blogs/'.$name_gen;
        }else{
            $image_url = $post->image;
        }
        if($request->status){
            $status = $request->status;
        }else{
            $status = $post->status;
        }
        $data['title'] = $request->title;
        $data['body'] = $request->body;
        $data['blog_category_id']=$request->category;
        $data['image']=$image_url;
        $data['status']=$status;
        if($request->delete_photo == 1){
            $image_path = $post->image;
            unlink($image_path);
            $data['image']=NULL;
        }
        $post->update($data);
        toast('Post updated!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('blog.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
        $image_path = $post->image;
        if($image_path!=null){
            unlink($image_path);
        }
        $post->delete();
        toast('Post deleted!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->back();
    }

    public function PendingIndex()
    {
        $posts = BlogPost::where('status', 0)->get();
        return view('backend.blog.post.pending',compact('posts'));
    }

    public function acceptReject(Request $request,$id)
    {
        $post = BlogPost::findOrFail($id);
        $post->update([
            'status' => 1,
        ]);
        toast('Post approved!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('blog.pending.index');
    }

}

