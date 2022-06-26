@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Danh Mục Sản Phẩm
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
                    <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Danh Mục</label>
                            <input type="text" name="category_product_name" class="form-control" onkeyup="ChangeToSlug();" id="slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Slug</label>
                            <input type="text" class="form-control" id="convert_slug" name="category_slug">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea class="form-control" id="add" style="resize: none;" rows="8" name="category_product_desc" placeholder="Mô tả danh mục"></textarea>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ Khóa Danh Mục</label>
                            <textarea class="form-control" style="resize: none;" rows="8" name="category_product_keywords" placeholder="Từ Khóa"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">Thuộc Danh Mục</label>
                            <select class="form-control input-sm m-bot15" name="category_parent">
                                <option value="0">---Danh Mục Cha---</option>
                                @foreach($category as $key => $val)
                                <option value="{{$val->category_id}}">{{$val->category_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="category_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm Danh Mục</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection