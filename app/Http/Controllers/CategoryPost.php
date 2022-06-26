<?php

namespace App\Http\Controllers;

use App\Models\CatePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class CategoryPost extends Controller
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
    public function add_category_post()
    {
        $this->AuthLogin();
        return view('admin.category_post.add_category');
    }
    public function save_category_post(Request $request)
    {
        $this->AuthLogin();
        $category_post = new CatePost();
        $data = $request->all();
        $category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->cate_post_desc = $data['cate_post_desc'];
        $category_post->cate_post_status = $data['cate_post_status'];
        $category_post->save();
        return redirect()->back()->with('message', 'Thêm Danh Mục Bài Viết Thành Công');
    }
    public function all_category_post()
    {
        $this->AuthLogin();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->paginate(5);
        return view('admin.category_post.list_category')->with(compact('category_post'));
    }
    public function edit_cate_post($cate_post_id)
    {
        $this->AuthLogin();
        $category_post = CatePost::find($cate_post_id);
        return view('admin.category_post.edit_category')->with(compact('category_post'));
    }
    public function update_category_post(Request $request, $cate_post_id)
    {
        $this->AuthLogin();
        $data = $request->all();
        $category_post = CatePost::find($cate_post_id);
        $category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->cate_post_desc = $data['cate_post_desc'];
        $category_post->cate_post_status = $data['cate_post_status'];
        $category_post->save();
        return redirect('/all-category-post')->with('message', 'Update Danh Mục Bài Viết Thành Công');
    }
    public function delete_cate_post($cate_post_id)
    {
        $this->AuthLogin();
        $category_post = CatePost::find($cate_post_id);
        $category_post->delete();
        return redirect('/all-category-post')->with('message', 'Xóa Danh Mục Bài Viết Thành Công');
    }
}
