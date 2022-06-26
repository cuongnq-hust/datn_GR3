<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\CatePost;
use App\Models\Category;
use App\Models\Brand;

session_start();

class PostController extends Controller
{
    //
    public function AuthLogin()
    {
        $admin_id = Auth::id();
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_post()
    {
        $this->AuthLogin();
        $cate_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        return view('admin.post.add_post')->with(compact('cate_post'));
    }
    public function save_post(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $post = new Post();
        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_keywords = $data['post_title'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];

        $get_image = $request->file('post_image');
        if ($get_image) {
            $date = Carbon::now('Asia/Ho_Chi_Minh');
            $dt = $date->toTimeString();
            $dt = str_replace(':', '-', $dt);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . '-' . $dt . '.' . $get_image->getClientOriginalExtension(); //lay duoi mo rong
            $get_image->move('public/uploads/post', $new_image); //insert vao product 
            $post->post_image = $new_image;
            $post->save();
            Session()->put('message', 'Thêm Bài Viết Thành Công');
            return redirect()->back();
        } else {
            Session()->put('message', 'Làm Ơn Thêm Hình Ảnh');
            return redirect()->back();
        }
    }
    public function all_post()
    {
        $this->AuthLogin();
        $all_post = Post::with('cate_post')->orderBy('post_id', 'DESC')->get();
        return view('admin.post.list_post')->with(compact('all_post'));
    }
    public function delete_post($post_id)
    {
        $this->AuthLogin();
        $post = Post::find($post_id);
        $post_image = $post->post_image;
        if ($post_image) {
            $path = 'public/uploads/post/' . $post_image;
            unlink($path);
        }
        $post->delete();
        return redirect()->back()->with('message', 'Xóa Bài Viết Thành Công');
    }
    public function edit_post($post_id)
    {
        $this->AuthLogin();
        $post = Post::find($post_id);
        $cate_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        return view('admin.post.edit_post')->with(compact('post', 'cate_post'));
    }
    public function update_post(Request $request, $post_id)
    {
        $this->AuthLogin();
        $post = Post::find($post_id);
        $data = $request->all();
        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_keywords = $data['post_title'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];

        $get_image = $request->file('post_image');

        if ($get_image) {
            //xoaanh
            $post_image_old = $post->post_image;
            $path = 'public/uploads/post/' . $post_image_old;
            unlink($path);
            //cap nhat anh
            $date = Carbon::now('Asia/Ho_Chi_Minh');
            $dt = $date->toTimeString();
            $dt = str_replace(':', '-', $dt);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . '-' . $dt . '.' . $get_image->getClientOriginalExtension(); //lay duoi mo rong
            $get_image->move('public/uploads/post', $new_image); //insert vao product 
            $post->post_image = $new_image;
        }
        $post->save();
        Session()->put('message', 'Update Bài Viết Thành Công');
        return Redirect::to('all-post');
    }
    public function bai_viet($post_slug, Request $request)
    {
        $category = Category::where('category_status', 0)->orderBy('category_id', 'DESC')->get();
        $brand = Brand::where('brand_status', 0)->orderBy('brand_id', 'DESC')->get();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        $post = Post::with('cate_post')->where('post_status', 0)->where('post_slug', $post_slug)->take(1)->get();
        foreach ($post as $key => $p) {
            $meta_desc = $p->post_meta_desc;
            $meta_keywords = $p->post_meta_keywords;
            $meta_title =  $p->post_title;
            $url_canonical = $request->url();
            $cate_post_id = $p->cate_post_id;
            $post_id = $p->post_id;
        }
        $post_view = Post::where('post_id', $post_id)->first();
        $post_view->post_views =  $post_view->post_views + 1;
        $post_view->save();
        $related = Post::with('cate_post')->where('post_status', 0)->where('cate_post_id', $cate_post_id)
            ->whereNotIn('post_slug', [$post_slug])
            ->orderBy('post_id', 'DESC')
            ->take(3)->get();
        return view('pages.baiviet.baiviet')->with(compact(
            'meta_desc',
            'meta_keywords',
            'meta_title',
            'url_canonical',
            'category',
            'brand',
            'post',
            'category_post',
            'related'
        ));
    }
    public function danh_muc_bai_viet(Request $request, $post_slug)
    {
        $category = Category::where('category_status', 0)->orderBy('category_id', 'DESC')->get();
        $brand = Brand::where('brand_status', 0)->orderBy('brand_id', 'DESC')->get();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        $meta_desc = 'fadfds';
        $meta_keywords = 'fadfds';
        $meta_title =  'fadfds';
        $url_canonical = $request->url();

        $catepost = CatePost::where('cate_post_slug', $post_slug)->take(1)->get();
        foreach ($catepost as $key => $p) {
            $meta_desc = $p->cate_post_desc;
            $meta_keywords = $p->cate_post_slug;
            $meta_title =  $p->cate_post_name;
            $url_canonical = $request->url();
            $cate_id = $p->cate_post_id;
        }
        $post = Post::with('cate_post')->where('post_status', 0)->where('cate_post_id', $cate_id)->get();
        return view('pages.baiviet.danhmucbaiviet')->with(
            compact(
                'category',
                'brand',
                'category_post',
                'meta_desc',
                'meta_keywords',
                'meta_title',
                'post',
                'url_canonical'
            )
        );
    }
}
