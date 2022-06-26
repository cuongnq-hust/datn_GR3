@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/trang-chu')}}">Trang Chủ</a></li>
                <li class="active"> Thanh Toán Giỏ Hàng</li>
            </ol>
        </div>
        <!--/breadcrums-->
        <div class="register-req">
            <p>Làm ơn đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
        </div>
        <!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                @if(Session()->get('cart'))
                <div class="col-sm-12 clearfix">
                    @if(\Session::has('error'))
                    <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                    {{ \Session::forget('error') }}
                    @endif
                    @if(\Session::has('success'))
                    <div class="alert alert-success">{{ \Session::get('success') }}</div>
                    {{ \Session::forget('success') }}
                    @endif
                    <div class="bill-to">
                        <div class="form-one">
                            <div class="col-md-6">
                                <p>Điền Thông Tin Địa chỉ</p>
                                <form>
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn Thành Phố</label>
                                        <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                            <option value="">--Chọn Tỉnh/Thành Phố--</option>
                                            @foreach($city as $key => $ci)
                                            <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn Quận Huyện</label>
                                        <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                            <option value="">--Chọn Quận Huyện--</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn Xã Phường</label>
                                        <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                            <option value="">--Chọn Xã Phường--</option>
                                        </select>
                                    </div>
                                    <input type="button" value="Tính Phí Vận Chuyển" name="calculate_order" class="btn btn-primary btn-sm calculate_delivery">
                                </form>
                            </div>
                            <div class="col-md-6">
                                <p>Điền Thông Tin Gửi Hàng</p>
                                <form method="POST">
                                    @csrf
                                    <input style="width: 80%; margin: 5px" type="text" name="shipping_email" class="shipping_email" placeholder="Email*">
                                    <input style="width: 80%; margin: 5px" type="text" name="shipping_name" class="shipping_name" placeholder="Họ Và Tên">
                                    <input style="width: 80%; margin: 5px" type="text" name="shipping_address" class="shipping_address" placeholder="Địa Chỉ">
                                    <input style="width: 80%; margin: 5px" type="text" name="shipping_phone" class="shipping_phone" placeholder="Điện Thoại">
                                    <textarea name="shipping_notes" class="shipping_notes" placeholder="Ghi Chú Đơn Hàng Của Bạn" rows="5"></textarea>
                                    @if(Session()->get('fee'))
                                    <input type="hidden" name="order_fee" class="order_fee" value="{{Session()->get('fee')}}">
                                    @else
                                    <input type="hidden" name="order_fee" class="order_fee" value="10000">
                                    @endif
                                    @if(Session()->get('coupon'))
                                    @foreach(Session()->get('coupon') as $key => $cou)
                                    <input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
                                    @endforeach
                                    @else
                                    <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                                    @endif
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn Hình Thức Thanh Toán</label>
                                        @if(!Session()->get('success_paypal') == true)
                                        <select name="payment_select" class="form-control input-sm m-bot15 payment_select">
                                            <option value="0">Thanhh toán bằng ATM</option>
                                            <option value="1">Thanhh toán bằng Tiền Mặt</option>
                                        </select>
                                        @elseif(Session()->get('success_paypal') == 1)
                                        <select name="payment_select" class="form-control input-sm m-bot15 payment_select">
                                            <option value="2">Đã thanh toán bằng Paypal</option>
                                        </select>
                                        @elseif(Session()->get('success_paypal') == 2 )
                                        <select name="payment_select" class="form-control input-sm m-bot15 payment_select">
                                            <option value="3">Đã thanh toán bằng OnePay</option>
                                        </select>
                                        @elseif(Session()->get('success_paypal') == 3 )
                                        <select name="payment_select" class="form-control input-sm m-bot15 payment_select">
                                            <option value="4">Đã thanh toán bằng MoMo</option>
                                        </select>
                                        @endif
                                        <input type="button" value="Xác Nhận Đơn Hàng" name="send_order" class="btn btn-primary btn-sm send_order">
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                @endif
                <div class="col-sm-12 clearfix">

                    <?php
                    $message = Session()->get('message');
                    $error = Session()->get('error');

                    if ($message) {
                        echo '<div class="alert alert-success">' . $message . '</div>';
                        Session()->put('message', null);
                    } elseif ($error) {
                        echo '<div class="alert alert-danger">' . $error . '</div>';
                        Session()->put('error', null);
                    }
                    ?>
                    <div class="table-responsive cart_info">
                        <form action="{{URL::to('/update-cart')}}" method="POST">
                            {{csrf_field()}}
                            <table class=" table table-condensed">
                                <thead>
                                    <tr class="cart_menu">
                                        <td class="image">Hình Ảnh</td>
                                        <td class="description">Tên Sản Phẩm</td>
                                        <td class="price">Giá</td>
                                        <td class="quantity">Số Lượng</td>
                                        <td class="total">Thành Tiền</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(Session()->get('cart') == true)
                                    <?php
                                    $total = 0;
                                    ?>
                                    @foreach(Session()->get('cart') as $key => $cart)
                                    <?php
                                    $subtotal = $cart['product_price'] * $cart['product_qty'];
                                    $total += $subtotal;
                                    ?>
                                    <tr>
                                        <td class="cart_product">
                                            <a href=""><img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" alt="{{$cart['product_name']}}" width="50" /></a>
                                        </td>
                                        <td class="cart_description">
                                            <h4><a href=""></a></h4>
                                            <p>{{$cart['product_name']}}</p>
                                        </td>
                                        <td class="cart_price">
                                            <p>{{number_format($cart['product_price'])}}.vnđ</p>
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                <input class="cart_quantity" @if(Session()->get('success_paypal') == true)
                                                readonly
                                                @endif
                                                value="{{$cart['product_qty']}}" type="number" name="cart_qty[{{$cart['session_id']}}]" min="1">
                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price">
                                                {{number_format($subtotal)}}.vnđ
                                            </p>
                                        </td>
                                        <td class="cart_delete">
                                            @if(!Session()->get('success_paypal') == true)
                                            <a style="margin-right: 10px;" class="cart_quantity_delete" href="{{url('/delete-product-ajax/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        @if(!Session()->get('success_paypal') == true)
                                        <td>
                                            <input type="submit" value="Cập Nhật Giỏ Hàng" name="update_qty" class="btn btn-default check_out">
                                        </td>
                                        <td>
                                            <a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa Tất Cả</a>
                                        </td>
                                        <td>
                                            @if(Session()->get('coupon'))
                                            <a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa Mã Giảm Giá</a>
                                            @endif
                                        </td>
                                        @endif

                                        <td>
                                            <li>Tổng : <span> {{number_format($total)}}.vnđ</span></li>
                                            @if(Session()->get('coupon'))
                                            <li>
                                                @foreach(Session()->get('coupon') as $key=>$cou)
                                                @if($cou['coupon_condition'] == 1)
                                                Mã Giảm : {{$cou['coupon_number']}} %
                                                <p>
                                            <li>
                                                Số Tiền Được Giảm :
                                                @php
                                                $total_coupon = ($total * $cou['coupon_number'])/100;
                                                echo number_format($total_coupon);
                                                @endphp
                                                vnđ
                                            </li>
                                            </p>
                                            @else
                                            Mã Giảm : {{number_format($cou['coupon_number'])}} vnđ
                                            <p>
                                                <li>
                                                    Số Tiền Được Giảm :
                                                    @php
                                                    $total_coupon = $cou['coupon_number'];
                                                    echo number_format($total_coupon);
                                                    @endphp
                                                    vnđ
                                                </li>
                                            </p>
                                            @endif
                                            @endforeach
                                            </li>
                                            @endif
                                            @if(Session()->get('fee'))
                                            <li>
                                                <a class="cart_quantity_delete" href="{{url('/del-fee')}}"><i class="fa fa-times"></i></a>
                                                Phí vận chuyển: <span>{{number_format(Session()->get('fee'))}} vnđ</span>
                                            </li>
                                            @endif
                                            <p>
                                                <li>Tổng Tiền :
                                                    <?php
                                                    if (Session()->get('fee') && !Session()->get('coupon')) {
                                                        $total = $total + Session()->get('fee');
                                                        echo number_format($total);
                                                    } elseif (!Session()->get('fee') && Session()->get('coupon')) {
                                                        $total = $total - $total_coupon;
                                                        echo number_format($total);
                                                    } elseif (Session()->get('fee') && Session()->get('coupon')) {
                                                        $total = $total - $total_coupon + Session()->get('fee');
                                                        echo number_format($total);
                                                    } elseif (!Session()->get('fee') && !Session()->get('coupon')) {
                                                        echo number_format($total);
                                                    }
                                                    ?>
                                                    .vnđ
                                                </li>
                                            </p>


                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="5">
                                            <center>
                                                <?php
                                                echo 'Làm ơn thêm sản phẩm vào giỏ hàng!!'
                                                ?>
                                            </center>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </form>
                        @if(Session()->get('cart') == true)
                        @if(!Session()->get('success_paypal') == true)
                        <div class="col-md-2">
                            <?php
                            if (isset($total)) {
                                $vnd_to_usd = $total / 23182;
                                $total_paypal = round($vnd_to_usd, 2);
                                \Session()->put('total_paypal', $total_paypal);
                            }
                            ?>
                            <a href="{{ route('processTransaction') }}"><img style="width: 100%;" src="{{asset('/public/frontend/images/paypal.png')}}"></a>
                        </div>
                        <!-- <div class="col-md-2">
                            <form action="{{URL('/vnpay-payment')}}" method="POST">
                                @csrf
                                @if(isset($total))
                                <input type="hidden" name="total_vnpay" value="{{$total}}">
                                @endif
                                <button style="background: none; border: none" type="submit" name="redirect"><img style="width: 84%;" src="{{asset('/public/frontend/images/vnpay.png')}}"></button>
                            </form>
                        </div> -->
                        <div class="col-md-2">
                            <form action="{{URL('/momo-payment')}}" method="POST">
                                @csrf
                                @if(isset($total))
                                <input type="hidden" name="total_momo" value="{{$total}}">
                                @endif
                                <button style="background: none; border: none" type="submit" name="payUrl"><img style="width: 63%;" src="{{asset('/public/frontend/images/momo.jpg')}}"></button>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <form action="{{URL('/onepay-payment')}}" method="POST">
                                @csrf
                                @if(isset($total))
                                <input type="hidden" name="total_onepay" value="{{$total}}">
                                @endif
                                <button style="background: none; border: none" type="submit" name="payUrl"><img style="width: 100%;" src="{{asset('/public/frontend/images/onepay.png')}}"></button>
                            </form>
                        </div>
                        @endif
                        @endif
                        @if(Session()->get('cart'))
                        @if(!Session()->get('success_paypal') == true)
                        <tr>
                            <td colspan="5">
                                <form method="POST" action="{{URL('/check-coupon')}}">
                                    @csrf
                                    <input type="text" class="form-control" name="coupon" placeholder="Nhập Mã Giảm Giá"></input>
                                    <br>
                                    <input type="submit" name="check_coupon" class="btn btn-default check_coupon" value="Tính Mã Giảm Giá"></input>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#cart_items-->
@endsection