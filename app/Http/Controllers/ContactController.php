<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;
use App\Models\Brand;
use App\Models\CatePost;
use App\Models\Contact;
use App\Models\Icons;

use Illuminate\Support\Facades\Auth;

session_start();

class ContactController extends Controller
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
    public function lien_he(Request $request)
    {
        $meta_desc = "Liên Hệ";
        $meta_keywords = "Liên Hệ";
        $meta_title = "Liên Hệ Chúng Tôi";
        $url_canonical = $request->url();
        $category = Category::where('category_status', 0)->orderBy('category_id', 'DESC')->get();
        $brand = Brand::where('brand_status', 0)->orderBy('brand_id', 'DESC')->get();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        $contact = Contact::where('info_id', 2)->get();

        return view('pages.lienhe.contact')->with(compact(
            'meta_keywords',
            'meta_title',
            'url_canonical',
            'category',
            'category_post',
            'brand',
            'meta_desc',
            'contact'
        ));
    }
    public function information()
    {
        $this->AuthLogin();
        $contact = Contact::where('info_id', 2)->get();
        return view('admin.information.add_information')->with(compact('contact'));
    }
    public function save_info(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $information = new Contact();
        $information->info_contact = $data['info_contact'];
        $information->info_map = $data['info_map'];
        $information->info_fanpage = $data['info_fanpage'];
        $get_image = $request->file('info_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension(); //lay duoi mo rong
            $get_image->move('public/uploads/info/', $new_image); //insert vao product 
            $information->info_image = $new_image;
        }
        $information->save();
        return redirect()->back()->with('message', 'Thêm Thông Tin Thành Công');
    }
    public function update_info(Request $request, $info_id)
    {
        $this->AuthLogin();
        $data = $request->all();
        $information = Contact::find($info_id);
        $information->info_contact = $data['info_contact'];
        $information->info_map = $data['info_map'];
        $information->info_fanpage = $data['info_fanpage'];
        $get_image = $request->file('info_image');
        if ($get_image) {
            unlink('public/uploads/info/' . $information->info_image);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension(); //lay duoi mo rong
            $get_image->move('public/uploads/info/', $new_image); //insert vao product 
            $information->info_image = $new_image;
        }
        $information->save();
        return redirect()->back()->with('message', 'Update Thông Tin Thành Công');
    }
    public function list_nut(Request $request)
    {
        $icons = Icons::where('category', 'icon')->orderBy('id_icons', 'DESC')->get();
        $output = '';

        $output .= '
        <table class="table table-hover">
          <thead>
          <tr>
          <th>Tên Nút</th>
          <th>Hình Ảnh</th>
          <th>Link</th>
          <th></th>
          </tr>
          </thead>
        <tbody>';
        foreach ($icons as $ico) {
            $output .= '
            <tr>
            <td>' . $ico->name . '</td>
            <td><img src="' . url('public/uploads/icons/' . $ico->image) . '" height="35px" widht="35px"></td>
            <td>' . $ico->link . '</td>
            <td><button id="' . $ico->id_icons . '" class="btn btn-danger" onclick="delete_icons(this.id)">Xóa</button></td>
            </tr>
            ';
        }
        $output .= '</tbody></table>
        ';
        echo $output;
    }
    public function delete_icons()
    {
        $id = $_GET['id'];
        $icons = Icons::find($id);
        $path = 'public/uploads/icons/';
        if ($icons->image) {
            unlink($path . $icons->image);
        }
        $icons->delete();
    }
    public function add_nut(Request $request)
    {
        $data = $request->all();
        $name = $data['name'];
        $link = $data['link'];
        $icons = new Icons();
        $get_image = $request->file('file');
        $path = 'public/uploads/icons/';
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension(); //lay duoi mo rong
            $get_image->move($path, $new_image); //insert vao product 
            $icons->name = $name;
            $icons->link = $link;
            $icons->image = $new_image;
            $icons->category = 'icon';
            $icons->save();
        }
    }
    public function add_doitac(Request $request)
    {
        $data = $request->all();
        $name = $data['name'];
        $link = $data['link'];
        $icons = new Icons();
        $get_image = $request->file('file');
        $path = 'public/uploads/icons/';
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension(); //lay duoi mo rong
            $get_image->move($path, $new_image); //insert vao product 
            $icons->name = $name;
            $icons->link = $link;
            $icons->image = $new_image;
            $icons->category = 'doitac';
            $icons->save();
        }
    }
    public function list_doitac(Request $request)
    {
        $icons = Icons::where('category', 'doitac')->orderBy('id_icons', 'DESC')->get();
        $output = '';

        $output .= '
        <table class="table table-hover">
          <thead>
          <tr>
          <th>Tên Đối Tác</th>
          <th>Hình Ảnh</th>
          <th>Link</th>
          <th></th>
          </tr>
          </thead>
        <tbody>';
        foreach ($icons as $ico) {
            $output .= '
            <tr>
            <td>' . $ico->name . '</td>
            <td><img src="' . url('public/uploads/icons/' . $ico->image) . '" height="105px" widht="105px"></td>
            <td>' . $ico->link . '</td>
            <td><button id="' . $ico->id_icons . '" class="btn btn-danger" onclick="delete_doitac(this.id)">Xóa</button></td>
            </tr>
            ';
        }
        $output .= '</tbody></table>
        ';
        echo $output;
    }
    public function delete_doitac()
    {
        $id = $_GET['id'];
        $icons = Icons::find($id);
        $path = 'public/uploads/icons/';
        if ($icons->image) {
            unlink($path . $icons->image);
        }
        $icons->delete();
    }
}
