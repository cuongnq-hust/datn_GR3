@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt Kê Video
        </div>
        <div class="table-responsive">
            <?php
            $message = Session()->get('message');
            if ($message) {
                echo '<span class="text-alert">' . $message . '</span>';
                Session()->put('message', null);
            }
            ?>
            <div class="position-center">
                <form>
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên Video</label>
                        <input type="text" name="video_name" class="form-control video_name" onkeyup="ChangeToSlug();" id="slug">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Slug</label>
                        <input type="text" name="video_slug" class="form-control video_slug" id="convert_slug">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Hình Ảnh Video</label>
                        <input type="file" id="file_img_video" class="form-control" name="file" accept="image/*" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Link Video</label>
                        <input type="text" name="video_link" class="form-control video_link">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô Tả Video</label>
                        <textarea class="form-control video_desc" name="video_desc" style="resize: none;"></textarea>
                    </div>

                    <button type="submit" name="add_video" class="btn btn-info btn-add-video">Thêm Video</button>
                </form>
                <span id="notify"></span>
            </div>
            <div id="video_load">
            </div>
        </div>
    </div>
</div>
@endsection