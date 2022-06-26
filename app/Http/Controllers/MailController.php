<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Category;
use App\Models\CatePost;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

session_start();


class MailController extends Controller
{
    //
    public function send_coupon_vip(Request $request, $coupon_id)
    {
        $customer_vip = Customers::where('customer_vip', 1)->get();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Mã khuyến mãi ngày" . ' ' . $now;
        $data = [];
        foreach ($customer_vip as $vip) {
            $data['email'][] = $vip->customer_email;
        }
        $coupon = Coupon::find($coupon_id);
        $coupon_item = array(
            'coupon_day_start' => $coupon->coupon_day_start,
            'coupon_day_end' => $coupon->coupon_day_end,
            'coupon_time' => $coupon->coupon_time,
            'coupon_condition' => $coupon->coupon_condition,
            'coupon_number' => $coupon->coupon_number,
            'coupon_code' => $coupon->coupon_code,
        );
        Mail::send('pages.mails.send_coupon_vip', ['coupon' => $coupon_item], function ($message) use ($title_mail, $data) {
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'], $title_mail);
        });
        return redirect()->back()->with('message', 'Gửi mã khuyến mãi cho khách VIP thành công');
    }
    public function send_coupon(Request $request, $coupon_id)
    {
        $customer_normal = Customers::where('customer_vip', '<>', 1)->get();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Mã khuyến mãi ngày" . ' ' . $now;
        $data = [];
        foreach ($customer_normal as $normal) {
            $data['email'][] = $normal->customer_email;
        }
        $coupon = Coupon::find($coupon_id);
        $coupon_item = array(
            'coupon_day_start' => $coupon->coupon_day_start,
            'coupon_day_end' => $coupon->coupon_day_end,
            'coupon_time' => $coupon->coupon_time,
            'coupon_condition' => $coupon->coupon_condition,
            'coupon_number' => $coupon->coupon_number,
            'coupon_code' => $coupon->coupon_code,
        );
        Mail::send('pages.mails.send_coupon', ['coupon' => $coupon_item], function ($message) use ($title_mail, $data) {
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'], $title_mail);
        });
        return redirect()->back()->with('message', 'Gửi mã khuyến mãi cho khách thường thành công');
    }
    public function forget_password(Request $request)
    {
        $meta_desc = "Quên mật khẩu";
        $meta_keywords = "Quên mật khẩu";
        $meta_title = "Quên mật khẩu";
        $url_canonical = $request->url();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        $category = Category::where('category_status', 0)->orderBy('category_parent', 'DESC')->orderBy('category_order', 'DESC')->get();
        $cate_pro_tabs = Category::where('category_parent', '<>', 0)->orderBy('category_order', 'ASC')->get();
        $brand = Brand::where('brand_status', 0)->orderBy('brand_id', 'DESC')->get();
        return view('pages.checkout.forget_pass')->with(compact(
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
    public function recover_pass(Request $request)
    {
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = "Lấy Lại Mật Khẩu Joy Boy" . ' ' . $now;
        $customer = Customers::where('customer_email', $data['email_account'])->get();
        foreach ($customer as $key => $value) {
            $customer_id = $value->customer_id;
        }
        if ($customer) {
            $count_customer = $customer->count();
            if ($count_customer == 0) {
                return redirect()->back()->with('error', 'Email chưa được đăng ký');
            } else {
                $token_random = Str::random(6);
                $customer_item = Customers::find($customer_id);
                $customer_item->customer_token = $token_random;
                $customer_item->save();
                $to_mail = $data['email_account'];
                $link_reset_pass = url('/update-new-pass?email=' . $to_mail . '&token=' . $token_random . '');
                $data = array(
                    "name" => $title_mail,
                    "body" => $link_reset_pass,
                    "email" => $data['email_account']
                );
                Mail::send('pages.mails.forget_pass_notify', ['data' => $data], function ($message) use ($title_mail, $data) {
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($data['email'], $title_mail);
                });
                return redirect()->back()->with('message', 'Bạn vui lòng vào Gmail để cấp lại mật khẩu');
            }
        }
    }
    public function update_new_pass(Request $request)
    {
        $meta_desc = "Reset mật khẩu";
        $meta_keywords = "Reset mật khẩu";
        $meta_title = "Reset mật khẩu";
        $url_canonical = $request->url();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        $category = Category::where('category_status', 0)->orderBy('category_parent', 'DESC')->orderBy('category_order', 'DESC')->get();
        $cate_pro_tabs = Category::where('category_parent', '<>', 0)->orderBy('category_order', 'ASC')->get();
        $brand = Brand::where('brand_status', 0)->orderBy('brand_id', 'DESC')->get();
        return view('pages.checkout.new_pass')->with(compact(
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
    public function reset_new_pass(Request $request)
    {
        $data = $request->all();
        $token_random = Str::random(6);
        $customer = Customers::where('customer_email', $data['email'])->where('customer_token', $data['token'])->get();
        $count = $customer->count();
        if ($count > 0) {
            foreach ($customer as $key => $cus) {
                $customer_id = $cus->customer_id;
            }
            $reset = Customers::find($customer_id);
            $reset->customer_password = md5($data['password_account']);
            $reset->customer_token = $token_random;
            $reset->save();
            return redirect('login-checkout')->with('message', 'Mật khẩu mới đã được cập nhật. Hãy quay lại trang đăng nhập');
        } else {
            return redirect('quen-mat-khau')->with('error', 'Vui lòng nhập lại email. Link đã quá hạn');
        }
    }
}
