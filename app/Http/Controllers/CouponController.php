<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function insert_coupon()
    {
        return view('admin.coupon.insert_coupon');
    }
    public function insert_coupon_code(Request $request)
    {
        $data = $request->all();
        $coupon = new Coupon();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_day_start = $data['coupon_day_start'];
        $coupon->coupon_day_end = $data['coupon_day_end'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->save();
        Session()->put('message', 'Thêm Mã Code Thành Công');
        return Redirect::to('insert-coupon');
    }
    public function list_coupon()
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        $coupon = Coupon::orderby('coupon_id', 'DESC')->get();
        return view('admin.coupon.list_coupon')->with(compact('coupon','today'));
    }
    public function delete_coupon($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        Session()->put('message', 'Xóa Mã Code Thành Công');
        return Redirect::to('list-coupon');
    }
    public function unset_coupon()
    {
        $coupon = Session()->get('coupon');
        if ($coupon == true) {
            Session()->forget('coupon');
            return Redirect()->back()->with('message', 'Xoá Mã Thành Công');
        }
    }
}
