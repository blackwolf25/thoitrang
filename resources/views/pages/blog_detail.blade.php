@extends('layout')
@section('contents')
			<br>
			<div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
                            <li><a href="{{URL::to('/tin-tuc')}}">Tin tức</a></li>
                            @foreach ($blog as $key =>$blogcate)
	                            <li><a href="{{URL::to('/danh-muc-tin-tuc/'.$blogcate->slug_category_post)}}">{{$blogcate->category_name}}</a></li>
                            @endforeach
                            @foreach ($blog as $key =>$blogname)
                                <li class="active">
		                            <a href="{{URL::to('/chi-tiet-bai-viet/'.$blogname->post_slug)}}">
		                            {{$blogname->post_name}}</a>
		                        </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="li-main-blog-page li-main-blog-details-page pt-60 pb-60 pb-sm-45 pb-xs-45">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Blog Sidebar Area -->
                        <div class="col-lg-3 order-lg-1 order-2">
                            <div class="li-blog-sidebar-wrapper">
                                <div class="li-blog-sidebar">
                                    <div class="li-sidebar-search-form">
                                        <form action="{{URL::to('/tim-kiem-bai-viet')}}" method="post">
                                        	{{ csrf_field()}}
                                            <input name="search_blog" type="text" class="li-search-field" placeholder="Tìm kiếm bài viết...">
                                            <button type="submit" class="li-search-btn"><i class="fa fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="li-blog-sidebar pt-25">
                                    <h4 class="li-blog-sidebar-title">Danh mục bài viết</h4>
                                    <ul class="li-blog-archive">
                                    	@foreach ($cate_blog as $key => $cate)
                                        <li><a href="{{URL::to('/danh-muc-tin-tuc/'.$cate->slug_category_post)}}">{{$cate->category_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                
                                <div class="li-blog-sidebar">
                                    <h4 class="li-blog-sidebar-title">Bài viết mới nhất</h4>
                                    @foreach ($new_post as $key => $new_blog)
                                    <div class="li-recent-post pb-30">
                                        <div style="width: 150px; height: 100px">
                                            <a href="{{URL::to('/chi-tiet-bai-viet/'.$new_blog->post_slug)}}">
                                                <img class="img-full" src="{{asset('public/uploads/images/post/'.$new_blog->post_image)}}" alt="">
                                            </a>
                                        </div>
                                        <div class="li-recent-post-des">
                                            <span><a style="text-align: justify;" href="{{URL::to('/chi-tiet-bai-viet/'.$new_blog->post_slug)}}">{{cutTitle($new_blog->post_name,5)}}</a></span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                            </div>
                        </div>
                        <!-- Li's Blog Sidebar Area End Here -->
                        <!-- Begin Li's Main Content Area -->
                        <div class="col-lg-9 order-lg-2 order-1">
                            <div class="row li-main-content">
                                <div class="col-lg-12">
                                	@foreach ($blog as $key =>$blog_detail)
                                    <div class="li-blog-single-item pb-30">
                                        <div class="li-blog-banner">
                                            <a><img class="img-full" src="{{asset('public/uploads/images/post/'.$blog_detail->post_image)}}" alt=""></a>
                                        </div>
                                        <div class="li-blog-content">
                                            <div class="li-blog-details">
                                                <h3 class="li-blog-heading pt-25"><a style="text-align: justify;">{{$blog_detail->post_name}}</a></h3>
                                                <div class="li-blog-meta">
                                                    <a class="author" href="#"><i class="fa fa-user"></i>Người đăng: {{$blog_detail->post_author}}</a>
                                                    <a class="post-time" href="#"><i class="fa fa-calendar"></i> Ngày đăng: {{$blog_detail->post_created_at}}</a>
                                                    
                                                </div>
                                                <!-- Begin Blog Blockquote Area -->
                                                <div class="li-blog-blockquote">
                                                    <blockquote style="text-align: justify;">
                                                        <p>{!! $blog_detail->post_desc!!}</p>
                                                    </blockquote>
                                                </div>
                                                <!-- Blog Blockquote Area End Here -->
                                                <p style="text-align: justify;">{!!$blog_detail->post_content!!}</p>
                                                <div class="li-tag-line" style="text-align: justify;">
                                                    <h4>tag:</h4>
                                                    {{$blog_detail->post_tags}}
                                                </div>
                                                <div class="li-blog-sharing text-center pt-30">
                                                    <h4>Chia sẽ bài viết này:</h4>
                                                    <div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="standard" data-action="like" data-size="large" data-share="true"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- Begin Li's Blog Comment Section -->
                                    <div class="product-reviews">
                                <div class="product-details-comment-block">
                                    <div class="col-lg-12">
                                    <div class="fb-comments" data-href="{{$url_canonical}}" data-numposts="20" data-width="100%"></div>
                                    </div>
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Main Content Area End Here -->
                    </div>
                </div>
            </div>
@endsection