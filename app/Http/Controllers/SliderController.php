<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
session_start();
class SliderController extends Controller
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
    public function manage_slider()
    {
        $this->AuthLogin();
        $all_slide = Slider::orderBy('slider_id', 'DESC')->get();
        return view('admin.slider.list_slider')
            ->with(compact('all_slide'));
    }
    public function add_slider()
    {
        $this->AuthLogin();
        return view('admin.slider.add_slider');
    }
    public function insert_slider(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $get_image = $request->file('slider_image');
        if ($get_image) {
            $date = Carbon::now('Asia/Ho_Chi_Minh');
            $dt = $date->toTimeString();
            $dt = str_replace(':', '-', $dt);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . '-' . $dt . '.' . $get_image->getClientOriginalExtension(); //lay duoi mo rong
            $get_image->move('public/uploads/slider', $new_image); //insert vao product 
            $slider = new Slider();
            $slider->slider_name = $data['slider_name'];
            $slider->slider_image = $new_image;
            $slider->slider_desc = $data['slider_desc'];
            $slider->slider_status = $data['slider_status'];
            $slider->save();
            Session()->put('message', 'Thêm Slider Thành Công');
            return Redirect::to('manage-slider');
        } else {
            Session()->put('message', 'Làm ơn thêm hình ảnh');
            return Redirect::to('add-slider');
        }
    }
    public function unactive_slide($slide_id)
    {
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id', $slide_id)->update(['slider_status' => 1]);
        Session()->put('message', 'Không Kích Hoạt Slider Thành Công');
        return Redirect::to('manage-slider');
    }
    public function active_slide($slide_id)
    {
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id', $slide_id)->update(['slider_status' => 0]);
        Session()->put('message', 'Kích Hoạt Slider Sản Phẩm Thành Công');
        return Redirect::to('manage-slider');
    }
    public function delete_slide($slide_id){
        $slider = Slider::find($slide_id);
        $slider->delete();
        Session()->put('message', 'Xóa Slide Thành Công');
        return Redirect::to('manage-slider');
    }
}
