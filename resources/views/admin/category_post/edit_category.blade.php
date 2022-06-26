@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Update Danh Mục Bài Viết
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
                    <form role="form" action="{{URL::to('/update-cate-post/'.$category_post->cate_post_id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Danh Mục</label>
                            <input type="text" name="cate_post_name" class="form-control" onkeyup="ChangeToSlug();" id="slug" value="{{$category_post->cate_post_name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Slug</label>
                            <input type="text" class="form-control" id="convert_slug" name="cate_post_slug" value="{{$category_post->cate_post_slug}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea class="form-control" style="resize: none;" rows="8" name="cate_post_desc">{{$category_post->cate_post_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="cate_post_status" class="form-control input-sm m-bot15">
                                @if($category_post->cate_post_status ==0)
                                <option value="0" selected>Hiển thị</option>
                                <option value="1">Ẩn</option>
                                @else
                                <option value="0">Hiển thị</option>
                                <option value="1" selected>Ẩn</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" name="add_post_cate" class="btn btn-info">Cập Nhật Danh Mục Bài Viết</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection