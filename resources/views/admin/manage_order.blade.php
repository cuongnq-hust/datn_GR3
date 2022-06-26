@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt Kê Đơn Hàng
        </div>
        <div class="table-responsive">
            <?php
            $message = Session()->get('message');
            if ($message) {
                echo '<span class="text-alert">' . $message . '</span>';
                Session()->put('message', null);
            }
            ?>
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Thứ Tự</th>
                        <th>Mã Đơn Hàng</th>
                        <th>Ngày Đặt Hàng</th>
                        <th>Tình Trạng Đơn Hàng</th>
                        <th>Lý Do Hủy</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    ?>
                    @foreach($order as $key => $ord)
                    <?php
                    $i++;
                    ?>
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$ord->order_code}}</td>
                        <td>{{$ord->created_at}}</td>
                        <td>
                            @if($ord->order_status == 1)
                            <span style="color: orange;">Đơn Hàng Mới</span>
                            @elseif($ord->order_status == 2)
                            <span style="color: green;">Đã Xử Lý-Đã Giao Hàng</span>
                            @else
                            <span style="color: red;">Đơn Hàng Đã Hủy</span>
                            @endif
                        </td>
                        <td>

                            {{$ord->order_destroy}}
                        </td>
                        <td>
                            <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-eye text-success text-active"></i>
                            </a>
                            <a href="{{URL::to('/delete-order/'.$ord->order_code)}}" onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này không?')" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection