@extends('frontend.layouts.master')
@section('main_title')
    Blog - {{$blogcategory->name}} |
@endsection
@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('welcome')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> {{$blogcategory->name}} <span></span> Blog & News
                </div>
            </div>
        </div>
        <div class="page-content mb-50 mt-10">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="shop-product-fillter mb-50 pr-30">
                            <div class="totall-product">
                                <h2>
                                    <img class="w-36px mr-10" src="{{asset('frontend/assets/imgs/theme/icons/category-1.svg')}}" alt="" />
                                    Recips Articles
                                </h2>
                            </div>
                        </div>
                        <div class="loop-grid pr-30">
                            <div class="row">
                                @forelse ($posts as $post)
                                    <article class="col-xl-4 col-lg-6 col-md-6 text-center hover-up mb-30 animated">
                                        <div class="post-thumb">
                                            <a href="{{route('blog.show',[$post->slug,$post->id])}}">
                                                <img class="border-radius-15" src="{{asset($post->image)}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="entry-content-2">
                                            <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="{{route('blog.category.index',[$post->blogcategory->slug, $post->blogcategory->id])}}">{{$post->blogcategory->name}}</a></h6>
                                            <h4 class="post-title mb-15">
                                                <a href="{{route('blog.show',[$post->slug,$post->id])}}">{{$post->title}}</a>
                                            </h4>
                                            <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                                <div>
                                                    <span class="post-on mr-10">{{$post->created_at->format('D, F d Y')}}</span>
                                                    <span class="hit-count has-dot mr-10">126k Views</span>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @empty
                                    
                                @endforelse
                            </div>
                        </div>
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                            <nav aria-label="Page navigation example">
                                {{$posts->links()}}
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
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