<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Coupon;
use App\Models\Slider;
use App\Models\CatePost;
use Carbon\Carbon;

session_start();

class CartController extends Controller
{
    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();
        print_r($data);
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session()->get('cart');
        if ($cart == true) {
            $is_avaiable = 0;
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_avaiable++;
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session()->put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
            Session()->put('cart', $cart);
        }
        Session()->save();
    }
    public function gio_hang(Request $request)
    {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '0')->take(4)->get();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        $meta_desc = "Giỏ Hàng Của Bạn";
        $meta_keywords = "Giỏ Hàng";
        $meta_title = "Giỏ Hàng";
        $url_canonical = $request->url();
        $category = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        return view('pages.cart.cart_ajax')
            ->with(compact(
                'category',
                'brand',
                'meta_desc',
                'meta_keywords',
                'meta_title',
                'url_canonical',
                'category_post'
            ));
    }
    public function delete_product_ajax($session_id)
    {
        $cart = Session()->get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session()->put('cart', $cart);
            return Redirect()->back()->with('message', 'Xoá Sản Phẩm Thành Công');
        } else {
            return Redirect()->back()->with('message', 'Xoá Sản Phẩm Thất Bại');
        }
    }
    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session()->get('cart');
        if ($cart == true) {
            $message = '';
            foreach ($data['cart_qty'] as $key => $qty) {
                $i = 0;
                foreach ($cart as $session => $val) {
                    $i++;
                    if (
                        $val['session_id'] == $key && $qty < $cart[$session]['product_quantity']

                    ) {
                        $cart[$session]['product_qty'] = $qty;
                        $message .= '<p style="color: blue">' . $i . ') Cập Nhật Số Lượng' . $cart[$session]['product_name'] . ' Thành Công</p>';
                    } elseif ($val['session_id'] == $key && $qty > $cart[$session]['product_quantity']) {
                        $message .= '<p style="color: red">' . $i . ')Cập Nhật Số Lượng' . $cart[$session]['product_name'] . ' Thất Bại</p>';
                    }
                }
            }
            Session()->put('cart', $cart);
            return Redirect()->back()->with('message', $message);
        } else {
            return Redirect()->back()->with('message', 'Update Sản Phẩm Thất Bại');
        }
    }
    public function delete_all_product()
    {
        $cart = Session()->get('cart');
        if ($cart == true) {
            Session()->forget('cart');
            Session()->forget('coupon');
            return Redirect()->back()->with('message', 'Xoá Tất Cả Sản Phẩm Thành Công');
        }
    }
    public function check_coupon(Request $request)
    {
        $data = $request->all();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        $customer_id = Session()->get('customer_id');
        if ($customer_id) {
            $coupon = Coupon::where('coupon_code', $data['coupon'])->where('coupon_status', 1)->where('coupon_day_end', '>=', $today)
                ->where('coupon_used', 'LIKE', '%' . $customer_id . '%')->first();
            if ($coupon) {
                return Redirect()->back()->with('error', 'Mã Giảm Giá Đã Sử Dụng Vui Lòng Nhập Mã Khác');
            } else {
                $coupon = Coupon::where('coupon_code', $data['coupon'])->where('coupon_status', 1)->where('coupon_day_end', '>=', $today)->first();
                if ($coupon == true) {
                    $count_coupon = $coupon->count();
                    if ($count_coupon > 0) {
                        $coupon_session = Session()->get('coupon');
                        if ($coupon_session == true) {
                            $is_avaiable = 0;
                            if ($is_avaiable == 0) {
                                $cou[] = array(
                                    'coupon_code' => $coupon->coupon_code,
                                    'coupon_condition' => $coupon->coupon_condition,
                                    'coupon_number' => $coupon->coupon_number,
                                );
                                Session()->put('coupon', $cou);
                            }
                        } else {
                            $cou[] = array(
                                'coupon_code' => $coupon->coupon_code,
                                'coupon_condition' => $coupon->coupon_condition,
                                'coupon_number' => $coupon->coupon_number,
                            );
                            Session()->put('coupon', $cou);
                        }
                        Session()->save();
                        return Redirect()->back()->with('message', 'Thêm Mã Giảm Giá Thành Công');
                    }
                } else {
                    return Redirect()->back()->with('error', 'Mã Giảm Giá Không Đúng Hoặc Đã Hết Hạn');
                }
            }
        } else {
            $coupon_login = Coupon::where('coupon_code', $data['coupon'])->where('coupon_status', 1)->where('coupon_day_end', '>=', $today)->first();
            if ($coupon_login == true) {
                $count_coupon = $coupon_login->count();
                if ($count_coupon > 0) {
                    $coupon_session = Session()->get('coupon');
                    if ($coupon_session == true) {
                        $is_avaiable = 0;
                        if ($is_avaiable == 0) {
                            $cou[] = array(
                                'coupon_code' => $coupon_login->coupon_code,
                                'coupon_condition' => $coupon_login->coupon_condition,
                                'coupon_number' => $coupon_login->coupon_number,
                            );
                            Session()->put('coupon', $cou);
                        }
                    } else {
                        $cou[] = array(
                            'coupon_code' => $coupon_login->coupon_code,
                            'coupon_condition' => $coupon_login->coupon_condition,
                            'coupon_number' => $coupon_login->coupon_number,
                        );
                        Session()->put('coupon', $cou);
                    }
                    Session()->save();
                    return Redirect()->back()->with('message', 'Thêm Mã Giảm Giá Thành Công');
                }
            } else {
                return Redirect()->back()->with('error', 'Mã Giảm Giá Không Đúng Hoặc Đã Hết Hạn');
            }
        }
    }
    public function show_cart_menu()
    {
        $cart = count(Session()->get('cart'));

        $output = '';
        if ($cart > 0) {
            $output .= '
            <span class="badges">' . $cart . '
             </span>
        ';
        }
        echo $output;
    }
    public function hover_cart()
    {
        $cart = count(Session()->get('cart'));
        $output = '';
        if ($cart > 0) {

            $output .= '
                <ul class="hover-cart">';
            foreach (Session()->get('cart') as $key => $value) {
                $output .= ' <li>
                <a href="">
                  <img src="' . asset('public/uploads/product/' . $value['product_image']) . '">
                  <p>' . $value['product_name'] . '</p>
                     <p>' . number_format($value['product_price']) . ' vnđ</p>
                   <p>Số Lượng : ' . $value['product_qty'] . '</p>
                   </a>
                   <a class="" href="' . url('/delete-product-ajax/' . $value['session_id']) . '"><i class="fa fa-times cart_quantity_delete"></i></a>
                 </li>';
            }
            $output .= '
                </ul>
                ';
        } else {
            $output .= '
        <ul class="hover-cart">
            <li>
                <p>Giỏ Hàng Trống</p>
            </li>
        </ul>';
        }
        echo $output;
    }
    public function remove_item(Request $request)
    {
        $data = $request->all();
        $cart = Session()->get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['id']) {
                    unset($cart[$key]);
                };
            }
            Session()->put('cart', $cart);
        }
    }
    public function cart_session()
    {
        $output = '';
        if (Session()->get('cart') == true) {
            foreach (Session()->get('cart') as $key => $value) {
                $output .= '<input type="hidden" class="cart_id" value="' . $value['product_id'] . '">';
            }
        }
        echo $output;
    }
    public function show_quick_cart()
    {
        $output = ' 
        <form>
        ' . csrf_field() . '
        <table class=" table table-condensed">
        <thead>
            <tr class="cart_menu">
                <td class="image">Hình Ảnh</td>
                <td class="description">Tên Sản Phẩm</td>
                <td class="description">Số Lượng Kho</td>
                <td class="price">Giá</td>
                <td class="quantity">Số Lượng</td>
                <td class="total">Thành Tiền</td>
                <td></td>
            </tr>
        </thead>
        <tbody>';
        if (Session()->get('cart') == true) {
            $total = 0;
            foreach (Session()->get('cart') as $key => $cart) {
                $subtotal = $cart['product_price'] * $cart['product_qty'];
                $total += $subtotal;
                $output .= '
            <tr>
                <td>
                    <img src="' . url('public/uploads/product/' . $cart['product_image']) . '" alt="' . $cart['product_name'] . '" width="20%" />
                </td>
                <td class="cart_description">
                    <p>' . $cart['product_name'] . '</p>
                </td>
                <td class="cart_description">
                    <h4><a href=""></a></h4>
                    <p>' . $cart['product_quantity'] . '</p>
                </td>
                <td class="cart_price">
                    <p>' . number_format($cart['product_price']) . '.vnđ</p>
                </td>
                <td class="cart_quantity">
                    <div class="cart_quantity_button">
                        <input class="cart_quantity_update"  value="' . $cart['product_qty'] . '" data-session_id="' . $cart['session_id'] . '" type="number"  min="1">
                    </div>
                </td>
                <td class="cart_total">
                    <p class="cart_total_price">
                    ' . number_format($subtotal) . '.vnđ
                    </p>
                </td>
                <td class="cart_delete">
                <a style="pointer: cursor;" class="cart_quantity_delete" id="' . $cart['session_id'] . '" onclick="DeleteItemCart(this.id)"><i class="fa fa-times"></i></a>

                </td>
            </tr>';
            }
            $output .= '
        <tr>
            <td>
                <a class="btn btn-default check_out" href="' . url('/del-all-product') . '">Xóa Tất Cả</a>
            </td>
            <td>';

            if (Session()->get('customer_id')) {
                $output .= ' <a class="btn btn-default check_out" href="' . url('/checkout') . '">Đặt Hàng</a>';
            } else {
                $output .= '  <a class="btn btn-default check_out" href="' . url('/login-checkout') . '">Đặt Hàng</a>';
            }
            $output .= '
            </td>
            <td colspan="4">
                Tổng : ' . number_format($total) . '.vnđ
            </td>
        </tr>';
        } else {
            $output .= '
        <tr>
            <td colspan="5">
                <center>
                   <p>Làm ơn thêm sản phẩm vào giỏ hàng</p>
                </center>
            </td>
        </tr>';
        }
        $output .= '
    </tbody>
</table></form>';
        echo $output;
    }
    public function update_quick_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session()->get('cart');
        if ($cart == true) {
            foreach ($cart as $session => $val) {
                if ($val['session_id'] == $data['session_id']) {
                    $cart[$session]['product_qty'] = $data['quantity'];
                }
            }
            Session()->put('cart', $cart);
        }
    }
}
