@extends('frontend.layouts.master')
@section('main_title')
    {{$post->title}} |
@endsection
@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> <a href="{{route('blog.category.index',[$post->blogcategory->slug, $post->blogcategory->id])}}">{{$post->blogcategory->name}}</a> <span></span> {{$post->title}}
            </div>
        </div>
    </div>
    <div class="page-content mb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-11 col-lg-12 m-auto">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="single-page pt-50 pr-30">
                                <div class="single-header style-2">
                                    <div class="row">
                                        <div class="col-xl-10 col-lg-12 m-auto">
                                            <h6 class="mb-10"><a href="{{route('blog.category.index',[$post->blogcategory->slug, $post->blogcategory->id])}}">{{$post->blogcategory->name}}</a></h6>
                                            <h2 class="mb-10">{{$post->title}}</h2>
                                            <div class="single-header-meta">
                                                <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                                                    @php
                                                        $admin_photo = App\Models\Admin::where('name',$post->created_by)->first();
                                                    @endphp
                                                    <span class="author-avatar">
                                                        <img class="img-circle" src="{{asset($admin_photo->profile_photo_url)}}" alt="" />
                                                    </span>
                                                    <span class="post-by">By <span>{{$post->created_by}}</span></span>
                                                    <span class="post-on has-dot">{{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</span>
                                                </div>
                                                <div class="social-icons single-share">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <figure class="single-thumbnail">
                                    <img src="{{asset($post->image)}}" alt="{{$post->slug}}" />
                                </figure>
                                <div class="single-content">
                                    <div class="row">
                                        <div class="col-xl-10 col-lg-12 m-auto">
                                            {!! $post->body !!}
                                            <!--Author box-->
                                            {{-- <div class="author-bio p-30 mt-50 border-radius-15 bg-white">
                                                <div class="author-image mb-30">
                                                    <a href="author.html"><img src="assets/imgs/blog/author-1.png" alt="" class="avatar" /></a>
                                                    <div class="author-infor">
                                                        <h5 class="mb-5">Barbara Cartland</h5>
                                                        <p class="mb-0 text-muted font-xs">
                                                            <span class="mr-10">306 posts</span>
                                                            <span class="has-dot">Since 2012</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="author-des">
                                                    <p>Hi there, I am a veteran food blogger sharing my daily all kinds of healthy and fresh recipes. I find inspiration in nature, on the streets and almost everywhere. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Amet id enim, libero sit. Est donec lobortis cursus amet, cras elementum libero</p>
                                                </div>
                                            </div> --}}
                                            <!--Comment form-->
                                            <div class="comment-form">
                                                <h3 class="mb-15">Leave a Comment</h3>
                                                <div class="product-rate d-inline-block mb-30"></div>
                                                <div class="row">
                                                    <div class="col-lg-9 col-md-12">
                                                        <form class="form-contact comment_form mb-50" action="#" id="commentForm">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <input class="form-control" name="name" id="name" type="text" placeholder="Name" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <input class="form-control" name="email" id="email" type="email" placeholder="Email" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <input class="form-control" name="website" id="website" type="text" placeholder="Website" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="button button-contactForm">Post Comment</button>
                                                            </div>
                                                        </form>
                                                        <div class="comments-area">
                                                            <h3 class="mb-30">Comments</h3>
                                                            <div class="comment-list">
                                                                <div class="single-comment justify-content-between d-flex mb-30">
                                                                    <div class="user justify-content-between d-flex">
                                                                        <div class="thumb text-center">
                                                                            <img src="assets/imgs/blog/author-2.png" alt="" />
                                                                            <a href="#" class="font-heading text-brand">Sienna</a>
                                                                        </div>
                                                                        <div class="desc">
                                                                            <div class="d-flex justify-content-between mb-10">
                                                                                <div class="d-flex align-items-center">
                                                                                    <span class="font-xs text-muted">December 4, 2021 at 3:12 pm </span>
                                                                                </div>
                                                                                <div class="product-rate d-inline-block">
                                                                                    <div class="product-rating" style="width: 80%"></div>
                                                                                </div>
                                                                            </div>
                                                                            <p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="single-comment justify-content-between d-flex mb-30 ml-30">
                                                                    <div class="user justify-content-between d-flex">
                                                                        <div class="thumb text-center">
                                                                            <img src="assets/imgs/blog/author-3.png" alt="" />
                                                                            <a href="#" class="font-heading text-brand">Brenna</a>
                                                                        </div>
                                                                        <div class="desc">
                                                                            <div class="d-flex justify-content-between mb-10">
                                                                                <div class="d-flex align-items-center">
                                                                                    <span class="font-xs text-muted">December 4, 2021 at 3:12 pm </span>
                                                                                </div>
                                                                                <div class="product-rate d-inline-block">
                                                                                    <div class="product-rating" style="width: 80%"></div>
                                                                                </div>
                                                                            </div>
                                                                            <p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="single-comment justify-content-between d-flex">
                                                                    <div class="user justify-content-between d-flex">
                                                                        <div class="thumb text-center">
                                                                            <img src="assets/imgs/blog/author-4.png" alt="" />
                                                                            <a href="#" class="font-heading text-brand">Gemma</a>
                                                                        </div>
                                                                        <div class="desc">
                                                                            <div class="d-flex justify-content-between mb-10">
                                                                                <div class="d-flex align-items-center">
                                                                                    <span class="font-xs text-muted">December 4, 2021 at 3:12 pm </span>
                                                                                </div>
                                                                                <div class="product-rate d-inline-block">
                                                                                    <div class="product-rating" style="width: 80%"></div>
                                                                                </div>
                                                                            </div>
                                                                            <p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 primary-sidebar sticky-sidebar pt-50">
                            <div class="widget-area">
                                <div class="sidebar-widget-2 widget_search mb-50">
                                    <div class="search-form">
                                        <form action="{{route('blog.search')}}" method="post" role="form" class="form">@csrf
                                            <input type="text" placeholder="Search for items..." name="search" autocomplete="off" required class="view" onfocus="search_result_show()" onblur="search_result_hide()" id="blogsearch">
                                            <button type="submit"><i class="fi-rs-search"></i></button>
                                        </form>
                                    </div>
                                    <div class="answersearch" id="allBlogSearch"></div>
                                    <script type="text/javascript">
                                        $("body").on("keyup", "#blogsearch", function(){
                                            let text = $("#blogsearch").val();
                                            // console.log(text);
                                            if (text.length > 0) {
                                                $.ajax({
                                                    data: {search: text},
                                                    url : "/blog/post-search",
                                                    method : 'post',
                                                    // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                                    success:function(result){
                                                        $("#allBlogSearch").html(result);
                                                    }
                                                }); // end ajax
                                                $(document).on('click','p',function(){
                                                    $("#blogsearch").val($(this).text());
                                                    $("#allProductSearch").html('');
                                                    $("#blogsearch").val("");
                                                });
                                            } // end if
                                            if (text.length < 1 ) $("#allBlogSearch").html("");
                                        });

                                        function search_result_hide(){
                                            $("#allBlogSearch").slideUp();
                                        }

                                        function search_result_show(){
                                            $("#allBlogSearch").slideDown();
                                        }
                                    </script>
                                </div>
                                <div class="sidebar-widget widget-category-2 mb-50">
                                    <h5 class="section-title style-1 mb-30">Category</h5>
                                    <ul>
                                        @forelse ($blogcategories as $category)
                                            <li>
                                                <a href="{{route('blog.category.index',[$category->slug, $category->id])}}">{{$category->name}}</a><span class="count">{{App\Models\BlogPost::where('status',1)->where('blog_category_id',$category->id)->count()}}</span>
                                            </li>
                                        @empty
                                            
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<style>
    .answersearch{
        position: absolute;
        background-color: #fff;
        min-width: 336px;
        /* max-width: 84%; */
        max-height: 450px;
        overflow-y: auto;
        /*overflow-y: scroll;*/
        margin: 0px 0 0 0px;
        z-index: 3;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        -ms-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        /*display: none;*/
        /*min-height: 100px;*/
        /* padding: 10px 2px; */
    }

    .answersearch p{
        cursor: pointer;
        padding: 5px 15px 5px 15px;
        margin: 0;
        border-bottom: 1px solid #fff;
    }

    .answersearch p:last-child{border: none;}

    .answersearch p:hover{
        color: #583101;
        background-color: #ffecd5;
        border-left: 3px solid #fc8902;
    }
    @media screen and (max-width: 992px) {
        .answersearch{
            min-width: 696px;
        }
    }
</style>
@endsection