<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Đơn Hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="background: #222; border-radius: 12px; padding: 15px">
        <div class="col-md-12">
            <p style="text-align: center; color: #fff;">Đây là email tự động. Quý khách vui lòng không trả lời email này.</p>
            <div class="row" style="background: pink; padding: 15px">
                <div class="col-md-6" style="text-align: center; color: #fff; font-weight: bold;font-size: 30px">
                    <h4 style="margin: 0;">JOY BOY SHOP</h4>
                    <h6 style="margin: 0;">DỊCH VỤ BÁN HÀNG- GIAO HÀNG MỌI LÚC MỌI NƠI</h6>
                </div>
                <div class="col-md-6 logo" style="color: #fff">
                    <p>Chào bạn <strong style="color: #000; text-decoration: underline">{{$shipping_array['customer_name']}} chúng tôi xác nhận bạn đã đặt hàng tại shop. Hàng sẽ được giao tới tay bạn trong thời gian ngắn nhất.</strong></p>
                </div>
                <div class="col-md-12">
                    <p style="color: #fff; font-size: 17px;">Bạn hoặc một ai đó đã đăng ký dịch vụ tại shop với thông tin như sau: </p>
                    <h4 style="color: #000; text-transform: uppercase">Thông tin đơn hàng</h4>
                    <p>Mã đơn hàng: <strong style="text-transform: uppercase; color: #fff;">{{$code['order_code']}}</strong></p>
                    <p>Mã khuyến mãi áp dụng: <strong style="text-transform: uppercase; color: #fff;">{{$code['coupon_code']}}</strong></p>
                    <p>Phí ship hàng: <strong style="text-transform: uppercase; color: #fff;">{{$shipping_array['fee_ship']}}</strong></p>
                    <p>Dịch vụ : <strong style="text-transform: uppercase; color: #fff">Đặt hàng trực tuyến</strong></p>
                    <h4 style="color: #000; text-transform: uppercase">Thông tin người nhận</h4>
                    <p>
                        Email:
                        @if($shipping_array['shipping_email']=='')
                        Không có
                        @else
                        <span style="color: #fff">{{$shipping_array['shipping_email']}}</span>
                        @endif
                    </p>
                    <p>
                        Họ và tên người gửi:
                        @if($shipping_array['shipping_name']=='')
                        Không có
                        @else
                        <span style="color: #fff">{{$shipping_array['shipping_name']}}</span>
                        @endif
                    </p>
                    <p>
                        Địa chỉ nhận hàng:
                        @if($shipping_array['shipping_address']=='')
                        Không có
                        @else
                        <span style="color: #fff">{{$shipping_array['shipping_address']}}</span>
                        @endif
                    </p>
                    <p>
                        Hình thức thanh toán:
                        @if($shipping_array['shipping_method']=='0')
                        Chuyển khoản ATM
                        @else
                        Tiền mặt
                        @endif
                    </p>
                    <p style="color: #000;">Nếu thông tin người nhận hàng không có chúng tôi sẽ liên hệ với người đặt hàng để trao đổi thông tin về đơn hàng đã đặt.</p>
                    <h4 style="color: #000;text-transform: uppercase">Sản phẩm đã đặt</h4>
                    <table class="table table-striped" style="border: 1px;">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá tiền</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>

                        </thead>
                        <tbody>
                            @php
                            $sub_total =0;
                            $total = 0;
                            @endphp
                            @foreach($cart_array as $cart)
                            @php
                            $sub_total = $cart['product_qty']*$cart['product_price'];
                            $total+=$sub_total;
                            @endphp
                            <tr>
                                <td>{{$cart['product_name']}}</td>
                                <td>{{number_format($cart['product_price'])}}</td>
                                <td>{{$cart['product_qty']}}</td>
                                <td>{{number_format($sub_total)}}</td>
                            </tr>
                            @endforeach
                            @php
                            $total = $total+$shipping_array['fee_ship'];

                            @endphp
                            <tr>
                                <td colspan="4" align="right">Tổng tiền thanh toán chưa có mã giảm giá: {{number_format($total
                                    )}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p style="color: #fff; text-align: center; font-size: 15px;">Xem lại lịch sử đơn hàng đã đặt tại <a target="_blank" href="{{url('/history')}}">lịch sử đơn hàng</a></p>

                <p style="color: #fff; text-align: center; font-size: 15pxl">
                    Mọi chi tiết xin liên hệ website tại : <a target="_blank" href="http://joyboy.local.com">
                        Joy-Boy
                    </a>, hoặc liên hệ qua số hotline: 0971136949. Xin cảm ơn quý khách đã đặt hàng tại shop chúng tôi.
                </p>
            </div>
        </div>
    </div>
</body>

</html>