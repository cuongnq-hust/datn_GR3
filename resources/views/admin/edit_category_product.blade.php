@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập Nhật Danh Mục Sản Phẩm
            </header>
            <div class="panel-body">
                <?php
                $message = Session()->get('message');
                if ($message) {
                    echo '<span class="text-alert" style="text-align: center">' . $message . '</span>';
                    Session()->put('message', null);
                }
                ?>
                @foreach($edit_category_product as $key => $edit_value)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Danh Mục</label>
                            <input type="text" value="{{$edit_value->category_name}}" name="category_product_name" class="form-control" onkeyup="ChangeToSlug();" id="slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Slug</label>
                            <input class="form-control" type="text" id="convert_slug" name="category_slug" value="{{$edit_value->category_slug}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea class="form-control" style="resize: none;" id="add"    rows="8" name="category_product_desc">{{$edit_value->category_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">Thuộc Danh Mục</label>
                            <select class="form-control input-sm m-bot15" name="category_parent">
                                <option value="0">------Danh Mục Cha------</option>
                                @foreach($category as $key => $val)
                                @if($val->category_parent == 0)
                                <option {{$val->category_id == $edit_value->category_id ? 'selected' : ''}} value="{{$val->category_id}}">{{$val->category_name}}</option>
                                @endif
                                @foreach($category as $key => $val2)
                                @if($val2->category_parent == $val->category_id)
                                <option {{$val2->category_id == $edit_value->category_id ? 'selected' : ''}} value="{{$val2->category_id}}">---{{$val2->category_name}}---</option>
                                @endif
                                @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ Khóa Danh Mục</label>
                            <textarea class="form-control" style="resize: none;" rows="8" name="category_product_keywords">{{$edit_value->meta_keywords}}</textarea>
                        </div>
                        <button type="submit" name="update_category_product" class="btn btn-info">Update Danh mục</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>

    </div>
</div>
@endsection