<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\Category;
use App\Models\CatePost;
use App\Models\Brand;
use App\Models\OrderDetails;
use App\Models\Customers;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Statistic;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    //
    public function manage_order()
    {
        $order = Order::orderby('created_at', 'DESC')->get();
        return view('admin.manage_order')->with(compact('order'));
    }
    public function view_order($order_code)
    {
        $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
        }
        $customer = Customers::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();
        foreach ($order_details_product as $key => $order_d) {
            $product_coupon = $order_d->product_coupon;
        }
        if ($product_coupon != 'no') {
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        } else {
            $coupon_condition = 2;
            $coupon_number = 0;
        }
        return view('admin.view_order')
            ->with(compact(
                'order_details',
                'customer',
                'shipping',
                'coupon_condition',
                'coupon_number',
                'order_details_product',
                'order',
                'order_status'
            ));
    }
    public function print_order($checkout_code)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code)
    {
        $order_details = OrderDetails::where('order_code', $checkout_code)->get();
        $order = Order::where('order_code', $checkout_code)->get();
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        $customer = Customers::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();
        foreach ($order_details_product as $key => $order_d) {
            $product_coupon = $order_d->product_coupon;
        }
        if ($product_coupon != 'no') {
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        } else {
            $coupon_condition = 2;
            $coupon_number = 0;
        }
        $ouput = '';

        $ouput .=
            '
        <style>body{
        font-family: DejaVu Sans;
    }
    .table-styling{
        border: 1px solid #000;
    }
    .table-styling tr td{
        border: 1px solid #000;
    }
        </style>
        <h1><center>Công Ty Trách Nhiệm Hết Hạn một Thành Viên Joy Boy</center></h1>
        <p> Người đặt hàng </p>
        <table class="table-styling">
        <thead>
        <tr>
        <th> Tên khách đặt </th>
        <th> Số điện thoại </th>
        <th> Email </th>
        </tr>
        </thead>
        <tbody>';

        $ouput .= '
        <tr>
        <td> ' . $customer->customer_name . '</td>
        <td> ' . $customer->customer_phone . '</td>
        <td> ' . $customer->customer_email . '</td>
        </tr>';
        $ouput .= '
        </tbody>
        </table>
        <p> Người nhận hàng </p>
        <table class="table-styling">
        <thead>
        <tr>
        <th> Tên người nhận </th>
        <th> Địa chỉ </th>
        <th> Số điện thoại </th>
        <th> Email </th>
        <th> Ghi chú </th>

        </tr>
        </thead>
        <tbody>';

        $ouput .= '
        <tr>
        <td> ' . $shipping->shipping_name . '</td>
        <td> ' . $shipping->shipping_address . '</td>
        <td> ' . $shipping->shipping_phone . '</td>
        <td> ' . $shipping->shipping_email . '</td>
        <td> ' . $shipping->shipping_notes . '</td>

       
        </tr>';
        $ouput .= '
        </tbody>
        </table>
        <p> Đơn hàng đã đặt </p>
        <table class="table-styling">
        <thead>
        <tr>
        <th> Tên sản phẩm </th>
        <th> Mã giảm giá </th>
        <th> Phí ship </th>
        <th> Số lượng </th>
        <th> Giá sản phẩm</th>
        <th> Thành tiền </th>
        </tr>
        </thead>
        <tbody>';

        $total = 0;

        foreach ($order_details_product as $key => $product) {
            $subtotal = $product->product_price * $product->product_sales_quantity;
            $total += $subtotal;
            if ($coupon_condition != 'no') {
                $product_coupon = $product->product_coupon;
            } else {
                $product_coupon = 'không mã';
            }
            $ouput .=
                '
        <tr>
        <td> ' . $product->product_name . '</td>
        <td> ' . $product->product_coupon . '</td>
        <td> ' . number_format($product->product_feeship, 0, ',', '.') . ' vnđ</td>
        <td> ' . $product->product_sales_quantity . '</td>
        <td> ' . number_format($product->product_price, 0, ',', '.') . ' vnđ</td>
        <td> ' . number_format($subtotal, 0, ',', '.') . ' vnđ</td>
        </tr>';
        }
        if ($coupon_condition == 1) {

            $total_after_coupon = ($total * $coupon_number) / 100;
            $total_coupon = $total - $total_after_coupon;
        } else {
            $total_coupon = $total - $coupon_number;
        }
        $ouput .= '
        <tr>
        <td colspan="2">
        <p>Tổng tiềm : ' . number_format($total, 0, ',', '.') . ' vnđ</p>
        <p>Tổng giảm : ' . number_format($total - $total_coupon, 0, ',', '.') . ' vnđ</p>
        <p>Phí ship : ' . number_format($product->product_feeship, 0, ',', '.') . ' vnđ</p>
        <p>Tổng tiền đơn hàng: ' . number_format($total_coupon + $product->product_feeship, 0, ',', '.') . ' </p>

        </td>
        </tr>
        ';
        $ouput .= '
        </tbody>
        </table>

        <p> Ký tên </p>
        <table>
        <thead>
        <tr>
        <th width="200px"> Người lập phiếu </th>
        <th width="750px"> Người nhận </th>
        </tr>
        </thead>
        <tbody>';
        $ouput .= '
        <tr>
        <td colspan = "2"> </td>
        <td colspan = "2"> </td>
        </tr>';
        $ouput .= '
        </tbody>
        </table>
        ';
        return $ouput;
    }
    public function update_order_qty(Request $request)
    {
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = 'Đơn đã đặt được xác nhận ' . ' ' . $now;
        $customer = Customers::where('customer_id', $order->customer_id)->first();
        $data['email'][] = $customer->customer_email;
        foreach ($data['order_product_id'] as $key => $product) {
            $product_mail = Product::find($product);
            foreach ($data['quantity'] as $key2 => $qty) {
                if ($key == $key2) {
                    $cart_array[] = array(
                        'product_name' => $product_mail['product_name'],
                        'product_price' => $product_mail['product_price'],
                        'product_qty' => $qty
                    );
                }
            }
        }
        $details = OrderDetails::where('order_code', $order->order_code)->first();
        $fee_ship = $details->product_feeship;
        $coupon_mail = $details->product_coupon;
        $shipping = Shipping::where('shipping_id', $order->shipping_id)->first();
        $shipping_array = array(
            'fee_ship' => $fee_ship,
            'customer_name' => $customer->customer_name,
            'shipping_name' => $shipping->shipping_name,
            'shipping_email' => $shipping->shipping_email,
            'shipping_phone' => $shipping->shipping_phone,
            'shipping_address' => $shipping->shipping_address,
            'shipping_notes' => $shipping->shipping_notes,
            'shipping_method' => $shipping->shipping_method
        );
        $ordercode_mail = array(
            'coupon_code' => $coupon_mail,
            'order_code' => $details->order_code
        );
        Mail::send('admin.confirm_order', ['cart_array' => $cart_array, 'shipping_array' => $shipping_array, 'code' => $ordercode_mail], function ($message) use ($title_mail, $data) {
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'], $title_mail);
        });

        $order_date = $order->order_date;
        $statistic = Statistic::where('order_date', $order_date)->get();
        if ($statistic) {
            $statistic_count = $statistic->count();
        } else {
            $statistic_count = 0;
        }
        if ($order->order_status == 2) {
            $total_order = 0;
            $sales = 0;
            $profit = 0;
            $quantity = 0;
            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;

                $product_price = $product->product_price;
                $product_cost = $product->product_cost;
                foreach ($data['quantity'] as $key2 => $qty) {

                    if ($key == $key2) {
                        $pro_remain = $product_quantity - $qty;
                        $product->product_quantity = $pro_remain;
                        $product->product_sold = $product_sold + $qty;
                        $product->save();

                        $quantity += $qty;
                        $total_order += 1;
                        $sales += $product_price * $qty;
                        $profit = $sales - ($product_cost * $qty);
                    }
                }
            }
            if ($statistic_count > 0) {
                $statistic_update = Statistic::where('order_date', $order_date)->first();
                $statistic_update->sales = $statistic_update->sales + $sales;
                $statistic_update->profit = $statistic_update->profit + $profit;
                $statistic_update->quantity = $statistic_update->quantity + $quantity;
                $statistic_update->total_order = $statistic_update->total_order + $total_order;
                $statistic_update->save();
            } else {
                $statistic_new = new Statistic();
                $statistic_new->order_date =  $order_date;
                $statistic_new->sales =  $sales;
                $statistic_new->profit =  $profit;
                $statistic_new->quantity =  $quantity;
                $statistic_new->total_order =  $total_order;
                $statistic_new->save();
            }
        }
    }
    public function update_qty(Request $request)
    {
        $data = $request->all();
        $order_details = OrderDetails::where('product_id', $data['order_product_id'])->where('order_code', $data['order_code'])->first();
        $order_details->product_sales_quantity = $data['order_qty'];
        $order_details->save();
    }
    public function delete_order($order_code)
    {
        $order = Order::where('order_code', $order_code)->first();
        $order->delete();
        return redirect()->back()->with('message', 'Xóa đơn hàng thành công');
    }
    public function history(Request $request)
    {
        if (!Session()->get('customer_id')) {
            return redirect('login-checkout')->with('error', 'Vui lòng đăng nhập để xem lịch sử');
        } else {
            $meta_desc = "Lịch sử đơn hàng";
            $meta_keywords = "Lịch sử đơn hàng";
            $meta_title = "Lịch sử đơn hàng";
            $url_canonical = $request->url();
            $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
            $category = Category::where('category_status', 0)->orderBy('category_parent', 'DESC')->orderBy('category_order', 'DESC')->get();
            $cate_pro_tabs = Category::where('category_parent', '<>', 0)->orderBy('category_order', 'ASC')->get();

            $brand = Brand::where('brand_status', 0)->orderBy('brand_id', 'DESC')->get();
            $order = Order::where('customer_id', Session()->get('customer_id'))->orderby('created_at', 'DESC')->get();
            return view('pages.history.history')->with(compact(
                'order',
                'meta_desc',
                'meta_keywords',
                'meta_title',
                'url_canonical',
                'category_post',
                'category',
                'cate_pro_tabs',
                'brand',
            ));
        }
    }

    public function view_history_order(Request $request, $order_code)
    {
        if (!Session()->get('customer_id')) {
            return redirect('login-checkout')->with('error', 'Vui lòng đăng nhập để xem lịch sử');
        } else {

            $meta_desc = "Lịch sử đơn hàng";
            $meta_keywords = "Lịch sử đơn hàng";
            $meta_title = "Lịch sử đơn hàng";
            $url_canonical = $request->url();
            $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
            $category = Category::where('category_status', 0)->orderBy('category_parent', 'DESC')->orderBy('category_order', 'DESC')->get();
            $cate_pro_tabs = Category::where('category_parent', '<>', 0)->orderBy('category_order', 'ASC')->get();

            $brand = Brand::where('brand_status', 0)->orderBy('brand_id', 'DESC')->get();
            $order = Order::where('customer_id', Session()->get('customer_id'))->orderby('created_at', 'DESC')->get();
            $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
            $order = Order::where('order_code', $order_code)->first();
            $customer_id = $order->customer_id;
            $shipping_id = $order->shipping_id;
            $order_status = $order->order_status;
            $customer = Customers::where('customer_id', $customer_id)->first();
            $shipping = Shipping::where('shipping_id', $shipping_id)->first();
            $order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();
            foreach ($order_details_product as $key => $order_d) {
                $product_coupon = $order_d->product_coupon;
            }
            if ($product_coupon != 'no') {
                $coupon = Coupon::where('coupon_code', $product_coupon)->first();
                $coupon_condition = $coupon->coupon_condition;
                $coupon_number = $coupon->coupon_number;
            } else {
                $coupon_condition = 2;
                $coupon_number = 0;
            }
            return view('pages.history.view_history_order')->with(compact(
                'order',
                'meta_desc',
                'meta_keywords',
                'meta_title',
                'url_canonical',
                'category_post',
                'category',
                'cate_pro_tabs',
                'brand',
                'order_details',
                'customer',
                'shipping',
                'coupon_condition',
                'coupon_number',
                'order_details_product',
                'order_status'
            ));
        }
    }
    public function huy_don_hang(Request $request)
    {
        $data = $request->all();
        $order = Order::where('order_code', $data['order_code'])->first();
        $order->order_destroy = $data['lydo'];
        $order->order_status = 3;
        $order->save();
    }
}
