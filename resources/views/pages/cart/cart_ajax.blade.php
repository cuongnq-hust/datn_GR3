@extends('layout')
@section('content')

<section id="cart_items">

    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/trang-chu')}}">Trang Chủ</a></li>
            <li class="active"> Giỏ Hàng Của Bạn</li>
        </ol>
    </div>
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
                        <td class="description">Số Lượng Kho</td>
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
                        <td>
                            <img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" alt="{{$cart['product_name']}}" width="100px" />
                        </td>
                        <td class="cart_description">

                            <p>{{$cart['product_name']}}</p>
                        </td>
                        <td class="cart_description">

                            <p>{{$cart['product_quantity']}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($cart['product_price'])}}.vnđ</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <input class="cart_quantity" value="{{$cart['product_qty']}}" type="number" name="cart_qty[{{$cart['session_id']}}]" min="1">
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                {{number_format($subtotal)}}.vnđ
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a style="margin-right: 10px;" class="cart_quantity_delete" href="{{url('/delete-product-ajax/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
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
                        <td>
                            <?php
                            $customer_id = Session()->get('customer_id');
                            if ($customer_id != NUll) {
                            ?>
                                <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Đặt Hàng</a>
                            <?php
                            } else {
                            ?>
                                <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Đặt Hàng</a>
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <li>Tổng <span> {{number_format($total)}}.vnđ</span></li>
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
                                </p>
                            </li>
                            <p>
                                <li>
                                    Tổng Tiền Đơn Hàng :
                                    {{number_format($total-$total_coupon)}} vnđ
                                </li>
                            </p>
                            @else
                            Mã Giảm : {{number_format($cou['coupon_number'])}} vnđ
                            <p>
                                Số Tiền Được Giảm :
                                {{number_format($cou['coupon_number'])}} vnđ
                            </p>
                            <p>
                                Tổng Tiền Đơn Hàng :
                                {{number_format($total-$cou['coupon_number'])}} vnđ
                            </p>
                            @endif
                            @endforeach
                            </li>
                            @endif
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
        @if(Session()->get('cart'))
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
    </div>
</section>

@endsection