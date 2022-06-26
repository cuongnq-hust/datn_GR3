<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Models\Video;
use App\Models\Category;
use App\Models\CatePost;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


session_start();

class VideoController extends Controller
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
    public function video()
    {
        return view('admin.video.video');
    }
    public function select_video()
    {
        $video = Video::orderBy('video_id', 'DESC')->get();
        $video_cout = $video->count();
        $output = '
        <form>
        ' . csrf_field() . '
        <table class="table table-striped b-t b-light">
        <thead>
            <tr>
                <th>Thứ Tự</th>
                <th>Tên Video</th>
                <th>Slug</th>
                <th>Hình Ảnh Video</th>
                <th>Link</th>
                <th>Mô Tả</th>
                <th>Demo</th>
                <th style="width: 30px">Quản Lý</th>
            </tr>
        </thead>
        <tbody>
        ';
        if ($video_cout > 0) {
            $i = 0;
            foreach ($video as $key => $vid) {
                $i++;
                $output .= '
                <tr>
                <td>' . $i . '</td>
                <td contenteditable data-video_id = "' . $vid->video_id . '" data-video_type="video_name" class="video_edit" id="video_name_' . $vid->video_id . '">' . $vid->video_name . '</td>
                <td contenteditable data-video_id = "' . $vid->video_id . '" data-video_type="video_slug" class="video_edit" id="video_slug_' . $vid->video_id . '">' . $vid->video_slug . '</td>
                <td>
                <img  src= "' . url('public/uploads/videos/' . $vid->video_image) . '" class="img-thumbnail" width="200" height="200">
                <input type="file" 
                class="file_img_video" 
                data-video_id = "' . $vid->video_id . '" 
                id="file-video-' . $vid->video_id . '" 
                name="file" accept="image/*"/>
                </td>
                <td contenteditable data-video_id = "' . $vid->video_id . '" data-video_type="video_link" class="video_edit" id="video_link_' . $vid->video_id . '">https://youtu.be/' . $vid->video_link . '</td>
                <td contenteditable data-video_id = "' . $vid->video_id . '" data-video_type="video_desc" class="video_edit" id="video_desc_' . $vid->video_id . '"> ' . $vid->video_desc . '</td>
                <td>
                <iframe width="200" height="200" src="https://www.youtube.com/embed/' . $vid->video_link . '" title="YouTube video player" 
                frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
                </iframe>
                </td>
                <td><button type="button" class="btn btn-xs btn-danger btn-delete-video" data-video_id = "' . $vid->video_id . '">Xóa Video</button></td>
            </tr>
                ';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="4">Chưa Có Video Nào</td>
                </tr>
                ';
        }
        $output .= '
        </tbody>
        </table>
        </form>';
        echo $output;
    }
    public function insert_video(Request $request)
    {
        $data = $request->all();
        $video = new Video();
        $sub_link = substr($data['video_link'], 17);
        $video->video_name = $data['video_name'];
        $video->video_slug = $data['video_slug'];
        $video->video_link = $sub_link;
        $video->video_desc = $data['video_desc'];
        $get_image = $request->file('file');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/videos', $new_image);
            $video->video_image = $new_image;
        }
        $video->save();
    }
    public function update_video(Request $request)
    {
        $data = $request->all();
        $video_id = $data['video_id'];
        $video_edit = $data['video_edit'];
        $video_check = $data['video_check'];
        $video = Video::find($video_id);
        if ($video_check == 'video_name') {
            $video->video_name = $video_edit;
        } elseif ($video_check == 'video_desc') {
            $video->video_desc = $video_edit;
        } elseif ($video_check == 'video_link') {
            $sub_link = substr($video_edit, 17);
            $video->video_link = $sub_link;
        } elseif ($video_check == 'video_slug') {
            $video->video_slug = $video_edit;
        }
        $video->save();
    }
    public function delete_video(Request $request)
    {
        $video_id = $request->video_id;
        $video = Video::find($video_id);
        unlink('public/uploads/videos/' . $video->video_image);
        $video->delete();
    }
    public function video_shop(Request $request)
    {
        $meta_desc = "Video thousand sunny";
        $meta_keywords = "thiet bi choi game, choi game";
        $meta_title = "Video Shop";
        $url_canonical = $request->url();
        //end seo
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        $brand = Brand::where('brand_status', 0)->orderBy('brand_id', 'DESC')->get();
        $category = Category::where('category_status', 0)->orderBy('category_id', 'DESC')->get();
        $video = Video::orderBy('video_id', 'DESC')->paginate(6);

        return view('pages.video.video')->with(compact(
            'meta_desc',
            'meta_keywords',
            'meta_title',
            'url_canonical',
            'category_post',
            'brand',
            'category',
            'video'
        ));
    }
    public function update_video_image(Request $request)
    {
        $get_image = $request->file('file');
        $video_id = $request->video_id;
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/videos', $new_image);
            $video = Video::find($video_id);
            unlink('public/uploads/videos/' . $video->video_image);
            $video->video_image = $new_image;
            $video->save();
        }
    }
    public function watch_video(Request $request)
    {
        $video_id = $request->video_id;
        $video = Video::find($video_id);
        $output['video_name'] = $video->video_name;
        $output['video_link'] = ' <iframe width="100%" height="500" src="https://www.youtube.com/embed/' . $video->video_link . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
            </iframe>';
        // $output['video_link'] = '<div id="player" class="vlite-js" data-youtube-id="' . $video->video_link . '"></div>';
        echo json_encode($output);
    }
}
