<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Slider;
use App\Models\CatePost;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

session_start();

class ProductController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Auth::id();
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_product()
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->get();
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }
    public function save_product(Request $request)
    {
        $this->AuthLogin();
        $price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $cost = filter_var($request->product_cost, FILTER_SANITIZE_NUMBER_INT);
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $price;
        $data['product_cost'] = $cost;
        $data['product_slug'] = $request->product_slug;
        $data['product_tags'] = $request->product_tags;
        $data['product_desc'] = $request->product_desc;
        $data['product_sold'] = '0';
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';
        $path_document = 'public/uploads/document/';
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension(); //lay duoi mo rong
            $get_image->move($path, $new_image); //insert vao product 
            File::copy($path . $new_image, $path_gallery . $new_image);
            $data['product_image'] = $new_image;
        }
        //them document
        $get_document = $request->file('document');
        if ($get_document) {
            $get_name_doc = $get_document->getClientOriginalName();
            $name_doc = current(explode('.', $get_name_doc));
            $new_doc = $name_doc . rand(0, 9999) . '.' . $get_document->getClientOriginalExtension(); //lay duoi mo rong
            $get_document->move($path_document, $new_doc); //insert vao product 
            $data['product_file'] = $new_doc;
        }

        $pro_id = DB::table('tbl_product')->insertGetId($data);
        $gallery = new Gallery();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();
        Session()->put('message', 'Thêm Sản Phẩm Thành Công');
        return Redirect::to('all-product');
    }
    public function all_product()
    {
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->orderBy('tbl_product.product_id', 'desc')->get();
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('admin.all_product', $manager_product);
    }

    public function unactive_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session()->put('message',  'Không Kích Hoạt Sản Phẩm Thành Công');
        return Redirect::to('all-product');
    }
    public function active_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session()->put('message', 'Kích Hoạt Sản Phẩm Thành Công');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)
            ->with('cate_product', $cate_product)->with('brand_product', $brand_product);
        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();
        $price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $cost = filter_var($request->product_cost, FILTER_SANITIZE_NUMBER_INT);
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $price;
        $data['product_desc'] = $request->product_desc;
        $data['product_slug'] = $request->product_slug;
        $data['product_tags'] = $request->product_tags;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_cost'] = $cost;
        $get_image = $request->file('product_image');
        $path_document = 'public/uploads/document/';
        $path = 'public/uploads/product/';

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension(); //lay duoi mo rong
            $get_image->move($path, $new_image); //insert vao product 
            $data['product_image'] = $new_image;
            $product = Product::find($product_id);
            unlink($path . $product->product_image);
        }
        $get_document = $request->file('document');
        if ($get_document) {
            $get_name_doc = $get_document->getClientOriginalName();
            $name_doc = current(explode('.', $get_name_doc));
            $new_doc = $name_doc . rand(0, 9999) . '.' . $get_document->getClientOriginalExtension(); //lay duoi mo rong
            $get_document->move($path_document, $new_doc); //insert vao product 
            $data['product_file'] = $new_doc;
            $product = Product::find($product_id);
            if ($product->product_file) {
                unlink($path_document . $product->product_file);
            }
        }
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);

        Session()->put('message', 'Update Sản Phẩm Thành Công');
        return Redirect::to('all-product');
    }

    public function delete_product($product_id)
    {
        $this->AuthLogin();
        $path = 'public/uploads/product/';
        $path_document = 'public/uploads/document/';
        $product = Product::find($product_id);
        unlink($path . $product->product_image);
        if ($product->product_file) {
            unlink($path_document . $product->product_file);
        }
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session()->put('message', 'Xoá Sản Phẩm Thành Công');
        return Redirect::to('all-product');
    }

    //end admin page

    public function details_product(Request $request, $product_slug)
    {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '0')->take(4)->get();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '0')->take(4)->get();
        $category = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        $product_details = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.product_slug', $product_slug)->get();

        foreach ($product_details as $key => $value) {
            $product_id = $value->product_id;
            $category_id = $value->category_id;
            $meta_desc = $value->product_slug;
            $meta_keywords = $value->product_name;
            $meta_title = $value->product_slug;
            $url_canonical = $request->url();
        }
        $post_view = Product::where('product_id', $product_id)->first();
        $post_view->product_views =  $post_view->product_views + 1;
        $post_view->save();

        $gallery = Gallery::where('product_id', $product_id)->get();
        $rating = Rating::where('product_id', $product_id)->avg('rating');
        $rating = round($rating);
        $related = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_category_product.category_id', $category_id)->whereNotIn('tbl_product.product_slug', [$product_slug])->orderby(DB::raw('RAND()'))->paginate(3);

        return view('pages.sanpham.show_details')
            ->with(compact(
                'category',
                'brand',
                'product_details',
                'related',
                'meta_desc',
                'meta_keywords',
                'meta_title',
                'url_canonical',
                'category_post',
                'gallery',
                'related',
                'rating',
                'slider'
            ));
    }
    public function tag(Request $request, $product_tag)
    {
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '0')->take(4)->get();
        $category = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        $tag = str_replace('-', " ", $product_tag);
        $pro_tag = Product::where('product_status', '0')->where('product_tags', 'LIKE', '%' . $tag . '%')->orWhere('product_slug', 'LIKE', '%' . $tag . '%')->get();
        $meta_desc = $product_tag;
        $meta_keywords = $product_tag;
        $meta_title = $product_tag;
        $url_canonical = $request->url();

        return view('pages.sanpham.tag')
            ->with(compact(
                'category',
                'brand',
                'meta_desc',
                'meta_keywords',
                'meta_title',
                'url_canonical',
                'category_post',
                'pro_tag',
                'product_tag'
            ));
    }
    public function quickview(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $gallery = Gallery::where('product_id', $product_id)->get();
        $output['product_gallery'] = '';
        foreach ($gallery as $key => $gal) {
            $output['product_gallery'] .= '<p><img width="100%" src="public/uploads/gallery/' . $gal->gallery_image . '"> </p>';
        }
        $output['product_name'] = $product->product_name;
        $output['product_id'] = $product->product_id;
        $output['product_desc'] = $product->product_desc;
        $output['product_content'] = $product->product_content;
        $output['product_price'] = number_format($product->product_price, 0, ',', '.') . 'VNĐ';
        $output['product_image'] = '<p><img width="100%" src="public/uploads/product/' . $product->product_image . '"> </p>';
        $output['product_quickview_value'] = ' 
        <input type="hidden" value="' . $product->product_id . '" class="cart_product_id_' . $product->product_id . '">
        <input type="hidden" value="' . $product->product_name . '" class="cart_product_name_' . $product->product_id . '">
        <input type="hidden" value="' . $product->product_image . '" class="cart_product_image_' . $product->product_id . '">
        <input type="hidden" value="' . $product->product_price . '" class="cart_product_price_' . $product->product_id . '">
        <input type="hidden" value="' . $product->product_quantity . '" class="cart_product_quantity_' . $product->product_id . '">
        <input type="hidden" value="1" class="cart_product_qty_' . $product->product_id . '">';
        $output['product_quickview_button'] = '
        <input type="button" value="Mua Ngay" class="btn btn-primary btn-sm add-to-cart-quickview" id="byequickview" data-id_product="' . $product->product_id . '" name="add-to-cart">
        ';
        echo json_encode($output);
    }
    public function uploads_ckeditor(Request $request)
    {
        if ($request->hasFile('upload')) {
            $orginName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($orginName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filename = $fileName . '_' . time() . '_' . $extension;
            $request->file('upload')->move('public/uploads/ckeditor' . $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/uploads/ckeditor/' . $fileName);
            $msg = 'Tải ảnh thành công';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url','$msg')</script>";
            @header('Content-type: text/html; charset-utf-8');
            echo $response;
        }
    }
    public function file_browser(Request $request)
    {
        $paths = glob(public_path('uploads/ckeditor/*'));
        $fileNames = array();
        foreach ($paths as $path) {
            array_push($fileNames, basename($path));
        }
        $data = array(
            'fileNames' => $fileNames
        );
        return view('admin.images.file_browser')->with($data);
    }
    public function delete_document(Request $request)
    {
        $this->AuthLogin();
        $product_id = $request->product_id;
        $path_document = 'public/uploads/document/';
        $product = Product::find($product_id);
        unlink($path_document . $product->product_file);
        $product->product_file = '';
        $product->save();
    }
}
