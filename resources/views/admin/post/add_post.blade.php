@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Bài Viết
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
                    <form role="form" action="{{URL::to('/save-post')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Bài Viết</label>
                            <input type="text" name="post_title" class="form-control" onkeyup="ChangeToSlug();" id="slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Slug</label>
                            <input type="text" name="post_slug" class="form-control" id="convert_slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tóm Tắt Bài Viết</label>
                            <textarea class="form-control" name="post_desc" style="resize: none;" rows="8"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội Dung Bài Viết</label>
                            <textarea class="form-control" name="post_content" id="add"  style="resize: none;"  rows="8"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Meta Từ Khóa</label>
                            <textarea class="form-control" name="post_meta_keywords" style="resize: none;" rows="8"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Meta Nội Dung</label>
                            <textarea class="form-control" name="post_meta_desc" style="resize: none;" rows="8"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình Ảnh Bài Viết</label>
                            <input type="file" name="post_image" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh Mục Bài Viết</label>
                            <select name="cate_post_id" class="form-control input-sm m-bot15">
                                @foreach($cate_post as $key=>$cate)
                                <option value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="post_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="add_post" class="btn btn-info">Thêm Bài Viết</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection