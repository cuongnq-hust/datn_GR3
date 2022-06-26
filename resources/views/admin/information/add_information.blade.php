@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Thông Tin Website
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
                    @foreach($contact as $key=> $value)
                    <form role="form" action="{{URL::to('/update-info/'.$value->info_id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thông Tin Liên Hệ</label>
                            <textarea class="form-control" style="resize: none;" rows="8" id="add" name="info_contact">{{$value->info_contact}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Bản Đồ </label>
                            <textarea class="form-control" style="resize: none;" rows="8" name="info_map">{{$value->info_map}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Fanpage </label>
                            <textarea class="form-control" style="resize: none;" rows="8" name="info_fanpage">{{$value->info_fanpage}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình Ảnh Logo</label>
                            <input type="file" name="info_image" class="form-control">
                            <img src="{{URL::to('/public/uploads/info/'.$value->info_image)}}" height="100px" width="100px" alt="">
                        </div>
                        <button type="submit" name="add_info" class="btn btn-info">Cập Nhật Thông Tin</button>
                    </form>
                    @endforeach
                </div>

            </div>
        </section>
        <section class="panel">
            <header class="panel-heading">
                Cập nhật thông tin mạng xã hội
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
                    <form role="form" id="form-nut">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên Nút</label>
                            <input type="text" name="name_icon" class="form-control" id="name_icon">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Link</label>
                            <input type="text" name="link_icon" class="form-control" id="link_icon">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình Ảnh Logo</label>
                            <input type="file" name="image_icon" class="form-control" id="image_icon">
                        </div>
                        <button type="button" name="add_info" class="btn btn-info add-nut">Thêm nút</button>
                    </form>
                </div>
                <div class="position-center">
                    <div id="notify_icons"></div>
                    <div id="list_nut"></div>
                </div>
            </div>
        </section>
        <section class="panel">
            <header class="panel-heading">
                Cập nhật thông tin đối tác
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
                    <form role="form" id="form-nut">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên Đối Tác</label>
                            <input type="text" name="name_icon" class="form-control" id="name_doitac">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Link Đối Tác</label>
                            <input type="text" name="link_icon" class="form-control" id="link_doitac">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình Ảnh Logo</label>
                            <input type="file" name="image_icon" class="form-control" id="image_doitac">
                        </div>
                        <button type="button" name="add_info" class="btn btn-info add-doitac">Thêm đối tác</button>
                    </form>
                </div>
                <div class="position-center">
                    <div id="notify_doitac"></div>
                    <div id="list_doitac"></div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection