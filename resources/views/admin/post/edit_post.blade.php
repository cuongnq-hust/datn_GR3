@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa Bài Viết
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
                    <form role="form" action="{{URL::to('/update-post/'.$post->post_id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Bài Viết</label>
                            <input type="text" value="{{$post->post_title}}" name="post_title" class="form-control" onkeyup="ChangeToSlug();" id="slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Slug</label>
                            <input type="text" value="{{$post->post_slug}}" name="post_slug" class="form-control" id="convert_slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tóm Tắt Bài Viết</label>
                            <textarea class="form-control" name="post_desc" style="resize: none;" rows="8">{{$post->post_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội Dung Bài Viết</label>
                            <textarea class="form-control" name="post_content" id="add"  style="resize: none;" rows="8">{{$post->post_content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Meta Từ Khóa</label>
                            <textarea class="form-control" name="post_meta_keywords" style="resize: none;" rows="8">{{$post->post_meta_keywords}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Meta Nội Dung</label>
                            <textarea class="form-control" name="post_meta_desc" style="resize: none;" rows="8">{{$post->post_meta_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình Ảnh Bài Viết</label>
                            <input type="file" name="post_image" class="form-control" id="exampleInputEmail1">
                            <img src="{{URL::to('public/uploads/post/'.$post->post_image)}}" height="100" width="100">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh Mục Bài Viết</label>
                            <select name="cate_post_id" class="form-control input-sm m-bot15">
                                @foreach($cate_post as $key=>$cate)
                                <option {{$post->cate_post_id == $cate->cate_post_id ? 'selected' : ''}} value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="post_status" class="form-control input-sm m-bot15">
                                @if($post->post_status == 0)
                                <option value="0" selected>Hiển thị</option>
                                <option value="1">Ẩn</option>
                                @else
                                <option value="0">Hiển thị</option>
                                <option value="1" selected>Ẩn</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" name="update_post" class="btn btn-info">Update Bài Viết</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection