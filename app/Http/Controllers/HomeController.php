<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\CatePost;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Icons;

session_start();

class HomeController extends Controller
{
    public function load_more_product(Request $request)
    {
        $data = $request->all();
        if ($data['id'] > 0) {
            $all_product = Product::where('product_status', 0)->where('product_id', '<', $data['id'])->orderBy('product_id', 'DESC')->take(6)->get();
        } else {
            $all_product = Product::where('product_status', 0)->orderBy('product_id', 'DESC')->take(6)->get();
        }
        $ouput = '';
        if (!$all_product->isEmpty()) {
            foreach ($all_product as $key => $pro) {
                $last_id = $pro->product_id;
                $ouput .= '
                <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                                <input type="hidden" value="' . $pro->product_id . '" class="cart_product_id_' . $pro->product_id . '">
                                <input type="hidden" value="' . $pro->product_name . '" class="cart_product_name_' . $pro->product_id . '" id="wishlist_productname' . $pro->product_id . '">
                                <input type="hidden" value="' . $pro->product_image . '" class="cart_product_image_' . $pro->product_id . '">
                                <input type="hidden" value="' . $pro->product_price . '" class="cart_product_price_' . $pro->product_id . '" id="wishlist_productprice' . $pro->product_id . '">
                                <input type="hidden" value="' . $pro->product_quantity . '" class="cart_product_quantity_' . $pro->product_id . '">
                                <input type="hidden" value="1" class="cart_product_qty_' . $pro->product_id . '">
                                <a id="wishlist_producturl' . $pro->product_id . '" href="' . url('/chi-tiet-san-pham/' . $pro->product_slug) . '">
                                    <img id="wishlist_productimage' . $pro->product_id . '" src="' . url('public/uploads/product/' . $pro->product_image) . '" width="100" height="180" />
                                    <h2>' . number_format($pro->product_price) . '.VND</h2>
                                    <p>' . $pro->product_name . '</p>
                                </a>
                                <button class="btn btn-default home_cart_' . $pro->product_id . '" id="' . $pro->product_id . '" onclick="Addtocart(this.id);">
                            Thêm Giỏ Hàng
                            </button>
                            <button style="display: none;" class="btn btn-danger rm_home_cart_' . $pro->product_id . '" id="' . $pro->product_id . '" onclick="Deletecart(this.id);">
                            Xóa Sản Phẩm
                            </button>
                                <input type="button" id="' . $pro->product_id . '" onclick="Xemnhanh(this.id);" value="Xem Nhanh" data-toggle="modal" data-target="#xemnhanh" class="btn btn-default" name="add-to-cart">
                                </input>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
        
                            <li>
                                <i class="fa fa-plus-square">
                                </i>
                                <button class="button_wishlist" id="' . $pro->product_id . '" onclick="add_wistlist(this.id);">
                                    <span>Yêu Thích</span>
                                </button>
                            </button>
                            </li>
                            <li>
                            <i class="fa fa-plus-square">
                            </i>
                            <button class="button_wishlist" id="' . $pro->product_id . '" onclick="add_compare(this.id);">
                                <span>So Sánh</span>
                            </button>
                        </button>
                        </li>
                           


                        </ul>
                    </div>
                </div>
            </div>';
            }
            $ouput .= '
                <div id="load_more">
                <button type="button" name="load_more_button" class="btn btn-success form-control" data-id="' . $last_id . '" id="load_more_button">Xem Thêm Sản Phẩm
                </div>
                ';
        } else {
            $ouput .= '
            <div id="load_more">
            <button type="button" name="load_more_button" class="btn btn-success form-control">Đang Cập Nhật THêm Sản Phẩm
            </div>
            ';
        }
        echo $ouput;
    }


    public function index(Request $request)
    {
        $icons = Icons::orderBy('id_icons', 'DESC')->get();
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '0')->take(4)->get();
        $meta_desc = "Chuyên bán những phụ kiện game";
        $meta_keywords = "Phụ Kiện Game, Máy Chơi Game";
        $meta_title = "Trải nghiệm tốt nhất khi chơi game";
        $url_canonical = $request->url();
        $category_post = CatePost::where('cate_post_id', '<>', 5)->orderBy('cate_post_id', 'DESC')->get();
        $category = Category::where('category_status', 0)->orderBy('category_parent', 'DESC')->orderBy('category_order', 'DESC')->get();
        $cate_pro_tabs = Category::where('category_parent', 0)->orderBy('category_order', 'DESC')->get();

        $brand = Brand::where('brand_status', 0)->orderBy('brand_id', 'DESC')->get();
        $all_product = Product::where('product_status', 0)->orderBy('product_id', 'DESC')->paginate(6);
        return view('pages.home')->with(compact(
            'slider',
            'meta_desc',
            'meta_keywords',
            'meta_title',
            'url_canonical',
            'category_post',
            'category',
            'all_product',
            'brand',
            'cate_pro_tabs',
            'icons'
        ));
    }
    public function search(Request $request)
    {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '0')->take(4)->get();
        $meta_desc = "Chuyên bán những phụ kiện game";
        $meta_keywords = "Phụ Kiện Game, Máy Chơi Game";
        $meta_title = "Trải nghiệm tốt nhất khi chơi game";
        $url_canonical = $request->url();
        $category = Category::where('category_status', 0)->orderBy('category_id', 'DESC')->get();
        $brand = Brand::where('brand_status', 0)->orderBy('brand_id', 'DESC')->get();
        $keywords = $request->keywords_submit;
        $search_product = Product::where('product_status', '0')->where('product_name', 'like', '%' . $keywords . '%')->get();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        return view('pages.sanpham.search')->with(compact(
            'slider',
            'meta_desc',
            'meta_keywords',
            'meta_title',
            'url_canonical',
            'search_product',
            'category',
            'category_post',
            'brand'
        ));
    }
    public function autocomplete_ajax(Request $request)
    {
        $data = $request->all();
        if ($data['query']) {
            $product = Product::where('product_status', 0)->where('product_name', 'LIKE', '%' . $data['query'] . '%')->get();
            $ouput = '<ul class="dropdown-menu" style = "display: block; position:relative">';
            foreach ($product as $key => $val) {
                $ouput .= '
                <li class="li_search_ajax"><a href = "#">' . $val->product_name . '</a></li>
                ';
            }
            $ouput .= '</ul>';
            echo $ouput;
        }
    }

    public function error_page()
    {
        return view('errors.404');
    }
}
