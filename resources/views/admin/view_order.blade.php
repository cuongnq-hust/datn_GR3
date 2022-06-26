@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông Tin Khách Hàng
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên Khách Hàng</th>
                        <th>Email</th>
                        <th>Số Điện Thoại</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$customer->customer_name}}</td>
                        <td>{{$customer->customer_email}}</td>
                        <td>{{$customer->customer_phone}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br></br>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông Tin Vận Chuyển
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên Người Vận Chuyển</th>
                        <th>Địa Chỉ</th>
                        <th>Số Điện Thoại</th>
                        <th>Email</th>
                        <th>Ghi Chú</th>
                        <th>Hình Thức Thanh Toán</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$shipping->shipping_name}}</td>
                        <td>{{$shipping->shipping_address}}</td>
                        <td>{{$shipping->shipping_phone}}</td>
                        <td>{{$shipping->shipping_email}}</td>
                        <td>{{$shipping->shipping_notes}}</td>
                        <td>
                            @if($shipping->shipping_method == 0)
                            Chuyển Khoản
                            @elseif($shipping->shipping_method == 1)
                            Tiền Mặt
                            @elseif($shipping->shipping_method == 2)
                            Đã Thanh Toán Bằng Paypal
                            @elseif($shipping->shipping_method == 3)
                            Đã Thanh Toán Bằng OnePay
                            @elseif($shipping->shipping_method == 4)
                            Đã Thanh Toán Bằng MoMo
                            @endif
                        </td>


                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br></br>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt Kê Đơn Hàng
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Thứ Tự</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Số Lượng Kho Còn</th>
                        <th>Mã Giảm Giá</th>
                        <th>Phí Ship Hàng</th>
                        <th>Số lượng</th>
                        <th>Giá Bán</th>
                        <th>Giá Gốc</th>
                        <th>Tổng Tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $total = 0;
                    ?>
                    @foreach($order_details_product as $key => $details)
                    <?php
                    $i++;
                    $subtotal = $details->product_price * $details->product_sales_quantity;
                    $total += $subtotal;
                    ?>
                    <tr class="color_qty_{{$details->product_id}}">
                        <td>{{$i}}</td>
                        <td>{{$details->product_name}}</td>
                        <td>{{$details->product->product_quantity}}</td>
                        <td>@if($details->product_coupon != 'no')
                            {{$details->product_coupon}}
                            @else
                            Không có mã giảm giá
                            @endif
                        </td>
                        <td>{{number_format($details->product_feeship,0,',','.')}}</td>
                        <td>
                            <input type="number" {{$order_status==2 ? 'disabled' : ''}} min="1" style="width: 60px;" class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_quantity}}" name="product_sales_quantity">
                            <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">
                            <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">
                            <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">
                            @if($order_status != 2)
                            <button class="btn btn-default update_quantity_order" data-product_id="{{$details->product_id}}" name="update_quantity_order">Cập Nhật</button>
                            @endif
                        </td>
                        <td>{{number_format($details->product_price,0,',','.')}} vnđ</td>
                        <td>{{number_format($details->product->product_cost,0,',','.')}} vnđ</td>
                        <td>{{number_format($subtotal,0,',','.')}} vnđ</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">
                            Tổng tiền :
                            {{number_format($total,0,',','.')}} vnđ
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">

                            <?php
                            $total_coupon = 0;
                            ?>
                            @if($coupon_condition == 1)
                            <?php
                            $total_after_coupon = ($total * $coupon_number) / 100;
                            echo 'Tổng giảm : ' . number_format($total_after_coupon, 0, ',', '.') . ' vnđ';
                            $total_coupon = $total - $total_after_coupon
                            ?>
                            @else
                            <?php
                            echo 'Tổng giảm : ' . number_format($coupon_number, 0, ',', '.') . ' vnđ';
                            $total_coupon = $total - $coupon_number;
                            ?>
                            @endif

                        </td>
                    </tr>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Phí ship :
                            {{number_format($details->product_feeship,0,',','.')}} vnđ
                        </td>
                    </tr>
                    <?php
                    $total_sum = $total_coupon + $details->product_feeship;
                    ?>
                    <tr>
                        <td colspan="2">
                            Tổng tiền đơn hàng :
                            {{number_format($total_sum,0,',','.')}} vnđ
                        </td>
                    </tr>
                    <input type="hidden" value="{{$total_sum}}" class="total_coupon">
                    <tr>
                        <td colspan="2">
                            @foreach($order as $key => $or)
                            @if($or->order_status ==1)
                            <form>
                                @csrf
                                <select class="form-control order_details">
                                    <option value="">Hình Thức Đơn Hàng</option>
                                    <option id="{{$or->order_id}}" selected value="1">Chưa Xử Lý</option>
                                    <option id="{{$or->order_id}}" value="2">Đã Xử Lý-Đã Giao Hàng</option>
                                </select>
                            </form>
                            @elseif($or->order_status ==2)
                            <form>
                                @csrf
                                <select class="form-control order_details">
                                    <option value="">Hình Thức Đơn Hàng</option>
                                    <option id="{{$or->order_id}}" selected value="2">Đã Xử Lý-Đã Giao Hàng</option>
                                </select>
                            </form>
                            @endif
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <a target="_blank_" href="{{URL('/print-order/'.$details->order_code)}}">In Đơn Hàng</a>
        </div>
    </div>
</div>
@endsection