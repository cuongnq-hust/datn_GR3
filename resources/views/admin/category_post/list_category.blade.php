@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt Kê Danh Mục Bài Viết
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
                        <th>Tên Danh Mục Bài Viết</th>
                        <th>Slug</th>
                        <th>Hiển Thị</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category_post as $key => $cate_post)
                    <tr>
                        <td>{{$cate_post->cate_post_name}}</td>
                        <td>{{$cate_post->cate_post_slug}}</td>
                        <?php
                        if ($cate_post->cate_post_status == 0) {
                        ?>
                            <td>
                                <!-- <a href="{{URL::to('/unactive-cate_post-product/'.$cate_post->cate_post_id)}}"> -->
                                <!-- <i class="fa-thumb-styling fa fa-thumbs-up"></i> -->
                                <!-- </a> -->
                                Hiển Thị
                            </td>
                        <?php
                        } else {
                        ?>
                            <td>
                                <!-- <a href="{{URL::to('/active-cate_post-product/'.$cate_post->cate_post_id)}}"> -->
                                <!-- <i class="fa-thumb-styling fa fa-thumbs-down"></i> -->
                                <!-- </a> -->
                                Ẩn
                            </td>
                        <?php
                        }
                        ?>
                        <td>
                            <a href="{{URL::to('/edit-cate-post/'.$cate_post->cate_post_id)}}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a href="{{URL::to('/delete-cate-post/'.$cate_post->cate_post_id)}}" onclick="return confirm('Bạn có chắc muốn xóa danh mục bài viết này không?')" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection