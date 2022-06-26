@extends('layout')
@section('content')

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
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Thứ Tự</th>
                        <th>Mã Đơn Hàng</th>
                        <th>Ngày Đặt Hàng</th>
                        <th>Tình Trạng Đơn Hàng</th>
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
                            <p style="color: blue;">Đơn hàng Mới</p>
                            @elseif($ord->order_status == 2)
                            <p style="color: green;">Đã Xử Lý</p>
                            @else
                            <p style="color: red;">Đơn Hàng Đã Hủy</p>
                            @endif
                        </td>
                        <td>
                            @if($ord->order_status == 1)
                            <p><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#huydon">Hủy Đơn Hàng</button></p>
                            @elseif($ord->order_status == 2)
                            <p style="color: green;">Đơn Hàng Đã Được Xử Lý Không Thể Hủy</p>
                            @else
                            <p style="color: red;">Đơn Hàng Đã Được Hủy</p>
                            @endif
                            <div id="huydon" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content" style="margin-top: 200px;">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Lý Do Hủy Đơn Hàng</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><textarea required class="lydohuydon" placeholder="Lý Do Hủy Đơn Hàng...(bắt buộc)" rows="5"></textarea></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                            <button type="button" id="{{$ord->order_code}}" onclick="Huydonhang(this.id)" class="btn btn-success">Gửi</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <a href="{{URL::to('/view-history-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                                Xem Đơn Hàng
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