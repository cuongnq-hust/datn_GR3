@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt Kê Sản Phẩm
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
                        <th>Tên Sản Phẩm</th>
                        <th>Thư Viện Ảnh</th>
                        <th>Tài Liệu</th>
                        <th>Số Lượng</th>
                        <th>Giá Bán</th>
                        <th>Giá Gốc</th>
                        <th>Hình Ảnh</th>
                        <th>Danh Mục </th>
                        <th>Thương Hiệu </th>
                        <th>Hiển Thị</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_product as $key => $pro)
                    <tr>
                        <td>{{$pro->product_name}}</td>
                        <td><a href="{{URL('/add-gallery/'.$pro->product_id)}}">Thêm Thư Viện Ảnh</a></td>
                        @if($pro->product_file)
                        <td><a target="blank" href="{{asset('/public/uploads/document/'.$pro->product_file)}}">Xem File</a></td>
                        @else
                        <td>Không có file</td>
                        @endif
                        <td>{{$pro->product_quantity}}</td>
                        <td>{{number_format($pro->product_price)}} vnđ</td>
                        <td>{{number_format($pro->product_cost)}} vnđ</td>
                        <td><img src="public/uploads/product/{{$pro->product_image}}" height="100" width="100"></td>
                        <td>{{$pro->category_name}}</td>
                        <td>{{$pro->brand_name}}</td>
                        <?php
                        if ($pro->product_status == 0) {
                        ?>
                            <td>
                                <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}">
                                    <i class="fa-thumb-styling fa fa-thumbs-up"></i>
                                </a>
                            </td>
                        <?php
                        } else {
                        ?>
                            <td>
                                <a href="{{URL::to('/active-product/'.$pro->product_id)}}">
                                    <i class="fa-thumb-styling fa fa-thumbs-down"></i>
                                </a>
                            </td>
                        <?php
                        }
                        ?>
                        <td>
                            <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a href="{{URL::to('/delete-product/'.$pro->product_id)}}" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" class="active styling-edit" ui-toggle-class="">
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