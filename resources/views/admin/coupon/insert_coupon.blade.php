@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Mã Giảm Giá
            </header>
            <div class="panel-body">
                <?php
                $message = Session()->get('message');
                if ($message) {
                    echo '<span class="text-alert" style="text-align: center">' . $message . '</span>';
                    Session()->put('message', null);
                }
                ?>
                <div class="position-center">
                    <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Mã Giảm Giá</label>
                            <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ngày Bắt Đầu</label>
                            <input type="text" id="start_coupon" name="coupon_day_start" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ngày Kết Thúc</label>
                            <input type="text" name="coupon_day_end" class="form-control" id="end_coupon">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mã Giảm Giá</label>
                            <input type="text" name="coupon_code" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số Lượng Mã</label>
                            <input type="text" name="coupon_time" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tính Năng Mã</label>
                            <select name="coupon_condition" class="form-control input-sm m-bot15">
                                <option value="0">>---Chọn---<< /option>
                                <option value="1">Giảm Theo Phần Trăm</option>
                                <option value="2">Giảm Theo Tiền Mặt</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhập Số % Hoặc Tiền Giảm</label>
                            <input type="text" name="coupon_number" class="form-control" id="exampleInputEmail1">
                        </div>
                        <button type="submit" name="add_coupon" class="btn btn-info">Thêm Mã Giảm Giá</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection