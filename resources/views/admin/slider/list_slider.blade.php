@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt Kê Banner
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
                        <th>Tên Slide</th>
                        <th>Hình Ảnh</th>
                        <th>Mô Tả</th>
                        <th>Tình Trạng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_slide as $key => $slide)
                    <tr>
                        <td>{{$slide->slider_name}}</td>
                        <td><img src="public/uploads/slider/{{$slide->slider_image}}" height="100" width="200"></td>
                        <td>{{$slide->slider_desc}}</td>
                        <?php
                        if ($slide->slider_status == 0) {
                        ?>
                            <td>
                                <a href="{{URL::to('/unactive-slide/'.$slide->slider_id)}}">
                                    <i class="fa-thumb-styling fa fa-thumbs-up"></i>
                                </a>
                            </td>
                        <?php
                        } else {
                        ?>
                            <td>
                                <a href="{{URL::to('/active-slide/'.$slide->slider_id)}}">
                                    <i class="fa-thumb-styling fa fa-thumbs-down"></i>
                                </a>
                            </td>
                        <?php
                        }
                        ?>
                        <td>
                            <a href="{{URL::to('/delete-slide/'.$slide->slider_id)}}" onclick="return confirm('Bạn có chắc muốn xóa slide này không?')" class="active styling-edit">
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