<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BlogController extends Controller
{
    public function blog (Request $request){
        //SEO
        $meta_desc = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp"; 
        $meta_keywords = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp";
        $meta_title = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp";
        $url_canonical = $request->url();

        $image_og = url('public/uploads/images/website/uiuy.png');
        //./SEO

    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $slider = DB::table('tbl_slider')->where('slider_status','1')->orderby('slider_id','desc')->get();
        $show_blog =  DB::table('tbl_category_post')->where('category_status','1')->get();

        $new_post =  DB::table('tbl_post')->where('post_status','1')->join('tbl_category_post','tbl_category_post.category_id','=','tbl_post.category_id')->limit(3)->get();

        $cate_blog = DB::table('tbl_category_post')->where('category_status','1')->orderby('category_id','desc')->get(); 

		return view('pages.blog')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('new_post',$new_post)->with('show_blog',$show_blog)->with('cate_blog',$cate_blog)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('image_og',$image_og);
    }

   
    public function search_blog(Request $request){
       //SEO
        $meta_desc = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp"; 
        $meta_keywords = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp";
        $meta_title = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp";
        $url_canonical = $request->url();

        $image_og = url('public/uploads/images/website/uiuy.png');
        //./SEO
        
        $keywords = $request->search_blog;
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get(); 
        $slider = DB::table('tbl_slider')->where('slider_status','1')->orderby('slider_id','desc')->get();

        $cate_blog = DB::table('tbl_category_post')->where('category_status','1')->orderby('category_id','desc')->get(); 
        $new_post =  DB::table('tbl_post')->where('post_status','1')->join('tbl_category_post','tbl_category_post.category_id','=','tbl_post.category_id')->limit(3)->get();

        $search_post = DB::table('tbl_post')->where('post_name','like','%'.$keywords.'%')->where('post_status',1)
        ->join('tbl_category_post','tbl_category_post.category_id','=','tbl_post.category_id')
        ->get(); 

        if($search_post){
            return view('pages.searchblog')->with('new_post',$new_post)->with('cate_blog',$cate_blog)->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('search_blog',$search_post)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('image_og',$image_og);
        } else{
        return view('pages.searchblog')->with('new_post',$new_post)->with('cate_blog',$cate_blog)->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('message', 'Không tìm thấy bài viết nào. Bạn vui lòng tìm thêm bài viết khác.')->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('image_og',$image_og);
        }
    }

    public function blog_detail (Request $request, $post_slug){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get(); 
        $slider = DB::table('tbl_slider')->where('slider_status','1')->orderby('slider_id','desc')->get();
        $cate_blog = DB::table('tbl_category_post')->where('category_status','1')->orderby('category_id','desc')->get(); 

        $new_post =  DB::table('tbl_post')->where('post_status','1')->join('tbl_category_post','tbl_category_post.category_id','=','tbl_post.category_id')->limit(3)->get();
        $blog = DB::table('tbl_post')
        ->join('tbl_category_post','tbl_category_post.category_id','=','tbl_post.category_id')
        ->where('post_slug',$post_slug)
        
        ->limit(1)->get();

        

        foreach($blog as $key => $val){
                //seo 
                $meta_desc = $val->post_name; 
                $meta_keywords = $val->key_words;
                $meta_title = $val->post_name;
                $image_og = url('public/uploads/images/post/'.$val->post_image);
                $url_canonical = $request->url();
                //--seo
                }
        
        return view('pages.blog_detail')
        ->with('blog',$blog)
        ->with('new_post',$new_post)
        ->with('cate_blog',$cate_blog)
        ->with('category',$cate_product)
        ->with('slider',$slider)
        ->with('brand',$brand_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('image_og',$image_og);
    }


     public function blog_category(Request $request, $slug_category_post){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get(); 
        $slider = DB::table('tbl_slider')->where('slider_status','1')->orderby('slider_id','desc')->get();
        
        $cate_blog = DB::table('tbl_category_post')->where('category_status','1')->orderby('category_id','desc')->get(); 
        $new_post =  DB::table('tbl_post')->where('post_status','1')->join('tbl_category_post','tbl_category_post.category_id','=','tbl_post.category_id')->limit(5)->get();

        $blog_category = DB::table('tbl_post')
        ->join('tbl_category_post','tbl_category_post.category_id','=','tbl_post.category_id')
        ->where('tbl_category_post.slug_category_post',$slug_category_post)
        ->orderby('tbl_post.post_id','desc')->get();

        $blog_category_name = DB::table('tbl_post')
        ->join('tbl_category_post','tbl_category_post.category_id','=','tbl_post.category_id')
        
        ->where('tbl_category_post.slug_category_post',$slug_category_post)
        
        ->orderby('tbl_post.post_id','desc')->limit(1)->get();

        foreach($blog_category as $key => $val){
                //seo 
                $meta_desc = $val->category_name; 
                $meta_keywords = $val->meta_keywords;
                $meta_title = $val->category_name;
                $image_og = url('public/uploads/images/post/'.$val->category_image);
                $url_canonical = $request->url();
                //--seo
                }
        return view('pages.blog_category')
        ->with('blog_category',$blog_category)
        ->with('new_post',$new_post)
        ->with('cate_blog',$cate_blog)
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('slider',$slider)
        ->with('blog_category_name',$blog_category_name)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('image_og',$image_og);
     }
}
