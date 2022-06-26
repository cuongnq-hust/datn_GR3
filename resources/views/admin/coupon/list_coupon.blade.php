@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt Kê Mã Giảm Giá
        </div>

        <div class="table-responsive">
            <?php
            $message = Session()->get('message');
            if ($message) {
                echo '<span class="text-alert">' . $message . '</span>';
                Session()->put('message', null);
            }
            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>

                        <th>Tên mã</th>
                        <th>Ngày Bắt Đầu</th>
                        <th>Ngày Kết Thúc</th>
                        <th>Mã giảm giá</th>
                        <th>Số lượng</th>
                        <th>Điều kiện kiảm giá</th>
                        <th>Số giảm</th>
                        <th>Tình Trạng</th>
                        <th>Hết Hạn</th>
                        <th>Tương Tác</th>
                        <th>Gửi Mã</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupon as $key => $cou)
                    <tr>
                        <td>{{$cou->coupon_name}}</td>
                        <td>{{$cou->coupon_day_start}}</td>
                        <td>{{$cou->coupon_day_end}}</td>
                        <td>{{$cou->coupon_code}}</td>
                        <td>{{$cou->coupon_time}}</td>
                        <td>
                            <?php
                            if ($cou->coupon_condition == 1) {
                            ?>
                                Giảm theo %
                            <?php
                            } else {
                            ?>
                                Giảm theo tiền
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($cou->coupon_condition == 1) {
                            ?>
                                Giảm {{$cou->coupon_number}} %
                            <?php
                            } else {
                            ?>
                                Giảm {{$cou->coupon_number}} vnđ
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($cou->coupon_status == 1) {
                            ?>
                                <span style="color: green;">Đang kích hoạt</span>
                            <?php
                            } else {
                            ?>
                                <span style="color: red;">Đã khóa</span>
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($cou->coupon_day_end >= $today) {
                            ?>
                                <span style="color: green;">Còn Hạn</span>
                            <?php
                            } else {
                            ?>
                                <span style="color: red;">Hết Hạn</span>
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <a href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" onclick="return confirm('Bạn có chắc muốn xóa mã này không?')" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                        <td>
                            <p><a href="{{url('/send-coupon-vip/'.$cou->coupon_id)}}" class="btn btn-success">Gửi mã giảm giá cho khách VIP</a></p>
                            <br>
                            <p><a href="{{url('/send-coupon/'.$cou->coupon_id)}}" class="btn btn-default">Gửi mã giảm giá cho khách thường</a></p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection