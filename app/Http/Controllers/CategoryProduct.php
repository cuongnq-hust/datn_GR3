<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Slider;
use App\Models\CatePost;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class CategoryProduct extends Controller
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
    public function add_category_product()
    {
        $this->AuthLogin();
        $category = Category::where('category_parent', 0)->orderBy('category_id', 'DESC')->get();
        return view('admin.add_category_product')->with(compact('category'));
    }
    public function all_category_product()
    {
        $this->AuthLogin();
        $category_product = Category::where('category_parent', 0)->orderBy('category_id', 'DESC')->get();
        $all_category_product = DB::table('tbl_category_product')->orderBy('category_parent', 'DESC')->orderBy('category_order', 'DESC')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product)
            ->with('category_product', $category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
    }

    public function save_category_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_parent'] = $request->category_parent;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['category_status'] = $request->category_product_status;
        $data['category_slug'] = $request->category_slug;
        DB::table('tbl_category_product')->insert($data);
        Session()->put('message', 'Thêm Danh Mục Sản Phẩm Thành Công');
        return Redirect::to('all-category-product');
    }

    public function unactive_category_product($category_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 1]);
        Session()->put('message', 'Không Kích Hoạt Danh Mục Sản Phẩm Thành Công');
        return Redirect::to('all-category-product');
    }
    public function active_category_product($category_product_id)
    {
        $this->AuthLogin();

        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 0]);
        Session()->put('message', 'Kích Hoạt Danh Mục Sản Phẩm Thành Công');
        return Redirect::to('all-category-product');
    }

    public function edit_category_product($category_product_id)
    {
        $this->AuthLogin();
        $category = Category::orderBy('category_id', 'DESC')->paginate(5);
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product)
            ->with('category', $category);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request, $category_product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['category_slug'] = $request->category_slug;
        $data['category_parent'] = $request->category_parent;
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        Session()->put('message', 'Update Danh Mục Sản Phẩm Thành Công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        Session()->put('message', 'Xoá Danh Mục Sản Phẩm Thành Công');
        return Redirect::to('all-category-product');
    }
    //End Admin Function Page
    public function show_category_home(Request $request, $category_slug)
    {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '0')->take(4)->get();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        $category = Category::where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand = Brand::where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        $category_slug = Category::where('category_slug', $category_slug)->get();
        foreach ($category_slug as $key => $cate) {
            $category_id = $cate->category_id;
        }
        if (isset($_GET['sort_by'])) {

            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'giam_dan') {
                $category_by_id = Product::with('category')->where('category_id', $category_id)->orderby('product_price', 'DESC')->paginate(36)->appends(request()->query());
            } elseif ($sort_by == 'tang_dan') {
                $category_by_id = Product::with('category')->where('category_id', $category_id)->orderby('product_price', 'ASC')->paginate(36)->appends(request()->query());
            } elseif ($sort_by == 'kytu_za') {
                $category_by_id = Product::with('category')->where('category_id', $category_id)->orderby('product_name', 'DESC')->paginate(36)->appends(request()->query());
            } elseif ($sort_by == 'kytu_az') {
                $category_by_id = Product::with('category')->where('category_id', $category_id)->orderby('product_name', 'ASC')->paginate(36)->appends(request()->query());
            }
        } elseif (isset($_GET['start_price']) && $_GET['end_price']) {
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];
            $category_by_id = Product::with('category')->where('category_id', $category_id)->whereBetween('product_price', [$min_price, $max_price])->orderby('product_price', 'DESC')->paginate(36)->appends(request()->query());
        } else {
            $category_by_id = Product::with('category')->where('category_id', $category_id)->orderby('product_id', 'DESC')->paginate(36)->appends(request()->query());
        }
        $category_name = Category::where('category_id', $category_id)->limit(1)->get();

        foreach ($category_name as $key => $val) {
            $meta_desc = $val->category_desc;
            $meta_keywords = $val->meta_keywords;
            $meta_title = $val->category_name;
            $url_canonical = $request->url();
        }
        return view('pages.category.show_category')
            ->with(compact(
                'category',
                'brand',
                'category_by_id',
                'category_name',
                'meta_desc',
                'meta_keywords',
                'meta_title',
                'url_canonical',
                'category_post',
                'slider'
            ));
    }

    public function arrange_category(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $cate_id = $data['page_id_array'];
        foreach ($cate_id as $key => $value) {
            $category = Category::find($value);
            $category->category_order = $key;
            $category->save();
        }
        echo 'Updated';
    }
    public function product_tabs(Request $request)
    {
        $data = $request->all();
        $output = '';
        $subcategory = Category::where('category_parent', $data['cate_id'])->get();
        $sub_array = array();
        foreach ($subcategory as $key => $sub) {
            $sub_array[] = $sub->category_id;
        }
        array_push($sub_array, $data['cate_id']);
        $product = Product::whereIn('category_id', $sub_array)->orderBY('product_id', 'DESC')->orderBy('product_price', 'DESC')->take(8)->get();
        $product_count = $product->count();
        if ($product_count > 0) {
            $output .= '
            <div class="tab-content">';
            foreach ($product as $key => $pro) {
                $output .= '
                <input type="hidden" value="' . $pro->product_id . '" class="cart_product_id_' . $pro->product_id . '">
                <input type="hidden" value="' . $pro->product_name . '" class="cart_product_name_' . $pro->product_id . '" id="wishlist_productname' . $pro->product_id . '">
                <input type="hidden" value="' . $pro->product_image . '" class="cart_product_image_' . $pro->product_id . '" >
                <input type="hidden" value="' . $pro->product_price . '" class="cart_product_price_' . $pro->product_id . '" id="wishlist_productprice' . $pro->product_id . '">
                <input type="hidden" value="' . $pro->product_quantity . '" class="cart_product_quantity_' . $pro->product_id . '">
                <input type="hidden" value="1" class="cart_product_qty_' . $pro->product_id . '">
            <div class="tab-pane fade active in" id="tshirt">
                <div class="col-sm-3">
                <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <a href="' . url('chi-tiet-san-pham/' . $pro->product_slug) . '">
                        <img src="' . url('public/uploads/product/' . $pro->product_image) . '" width="100" height="180" />
                        <h2>' . number_format($pro->product_price) . '.VND</h2>
                        <p>' . $pro->product_name . '</p>
                        </a>
                        <button class="btn btn-default" id="' . $pro->product_id . '" onclick="Addtocart(this.id);">
                        <i class="fa fa-shopping-cart"></i>Thêm Giỏ Hàng
                        </button>
                    </div>
                </div>
            </div>
                </div>
            </div>
            
        </div>
            ';
            }
        } else {
            $output .= '<div class="tab-content">
            <div class="tab-pane fade active in" id="tshirt">
                <div class="col-sm-12">
                <p style = "color: red; text-align: center">Danh Mục Hiện Chưa Có Sản Phẩm Nào</p>
                </div>
            </div>
        </div>';
        }
        echo $output;
    }
    public function show_category_parent(Request $request, $category_slug)
    {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '0')->take(4)->get();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        $category = Category::where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand = Brand::where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        $category_by_slug = Category::where('category_slug', $category_slug)->first();
        $cate_id = $category_by_slug->category_id;
        $subcategory = Category::where('category_parent', $cate_id)->get();
        $sub_array = array();
        foreach ($subcategory as $key => $sub) {
            $sub_array[] = $sub->category_id;
        }
        array_push($sub_array, $cate_id);
        $product = Product::whereIn('category_id', $sub_array)->orderBY('product_id', 'DESC')->orderBy('product_price', 'DESC')->take(8)->get();
        if (isset($_GET['sort_by'])) {

            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'giam_dan') {
                $category_by_id = Product::with('category')->whereIn('category_id', $sub_array)->orderby('product_price', 'DESC')->paginate(36)->appends(request()->query());
            } elseif ($sort_by == 'tang_dan') {
                $category_by_id = Product::with('category')->whereIn('category_id', $sub_array)->orderby('product_price', 'ASC')->paginate(36)->appends(request()->query());
            } elseif ($sort_by == 'kytu_za') {
                $category_by_id = Product::with('category')->whereIn('category_id', $sub_array)->orderby('product_name', 'DESC')->paginate(36)->appends(request()->query());
            } elseif ($sort_by == 'kytu_az') {
                $category_by_id = Product::with('category')->whereIn('category_id', $sub_array)->orderby('product_name', 'ASC')->paginate(36)->appends(request()->query());
            }
        } elseif (isset($_GET['start_price']) && $_GET['end_price']) {
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];
            $category_by_id = Product::with('category')->whereIn('category_id', $sub_array)->whereBetween('product_price', [$min_price, $max_price])->orderby('product_price', 'DESC')->paginate(36)->appends(request()->query());
        } else {
            $category_by_id = Product::with('category')->whereIn('category_id', $sub_array)->orderby('product_id', 'DESC')->paginate(36)->appends(request()->query());
        }
        $meta_desc = $category_by_slug->category_desc;
        $meta_keywords = $category_by_slug->meta_keywords;
        $meta_title = $category_by_slug->category_name;
        $url_canonical = $request->url();
        return view('pages.category.show_category_parent')
        ->with(compact(
            'category',
            'brand',
            'category_by_id',
            'meta_desc',
            'meta_keywords',
            'meta_title',
            'url_canonical',
            'category_post',
            'slider'
        ));
    }
}
