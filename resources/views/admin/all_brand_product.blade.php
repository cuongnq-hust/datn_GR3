@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt Kê Danh Mục Thương Hiệu
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
                        <th>Tên Thương Hiệu</th>
                        <th>Slug</th>
                        <th>Hiển Thị</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_brand_product as $key => $brand_pro)
                    <tr>
                        <td>{{$brand_pro->brand_name}}</td>
                        <td>{{$brand_pro->brand_slug}}</td>
                        <?php
                        if ($brand_pro->brand_status == 0) {
                        ?>
                            <td>
                                <a href="{{URL::to('/unactive-brand-product/'.$brand_pro->brand_id)}}">
                                    <i class="fa-thumb-styling fa fa-thumbs-up"></i>
                                </a>
                            </td>
                        <?php
                        } else {
                        ?>
                            <td>
                                <a href="{{URL::to('/active-brand-product/'.$brand_pro->brand_id)}}">
                                    <i class="fa-thumb-styling fa fa-thumbs-down"></i>
                                </a>
                            </td>
                        <?php
                        }
                        ?>
                        <td>
                            <a href="{{URL::to('/edit-brand-product/'.$brand_pro->brand_id)}}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a href="{{URL::to('/delete-brand-product/'.$brand_pro->brand_id)}}" onclick="return confirm('Bạn có chắc muốn xóa thương hiệu này không?')" class="active styling-edit" ui-toggle-class="">
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