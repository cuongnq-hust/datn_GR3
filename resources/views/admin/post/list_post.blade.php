@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt Kê Bài Viết
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
                        <th>Tên Bài Viết</th>
                        <th>Hình Ảnh</th>
                        <th>Slug</th>
                        <th>Mô Tả Bài Viết</th>
                        <th>Từ Khóa Bài Viết</th>
                        <th>Danh Mục Bài Viết</th>
                        <th>Hiển Thị</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_post as $key => $post)
                    <tr>
                        <td>{{$post->post_title}}</td>
                        <td><img src="public/uploads/post/{{$post->post_image}}" height="100" width="100"></td>
                        <td>{{$post->post_slug}}</td>
                        <td>{{$post->post_desc}}</td>
                        <td>{{$post->post_meta_keywords}}</td>
                        <td>{{$post->cate_post->cate_post_name}}</td>
                        <td>
                            @if($post->post_status == 0)
                            Hiển Thị
                            @else
                            Ẩn
                            @endif
                        </td>
                        <td>
                            <a href="{{URL::to('/edit-post/'.$post->post_id)}}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a href="{{URL::to('/delete-post/'.$post->post_id)}}" onclick="return confirm('Bạn có chắc muốn xóa bài viết này không?')" class="active styling-edit" ui-toggle-class="">
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