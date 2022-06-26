@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập Nhật Thương Hiệu Sản Phẩm
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
                    <form role="form" action="{{URL::to('/update-brand-product/'.$edit_brand_product->brand_id)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Thương Hiệu</label>
                            <input type="text" value="{{$edit_brand_product->brand_name}}" onkeyup="ChangeToSlug();" id="slug" name="brand_product_name" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Slug</label>
                            <input class="form-control" type="text" id="convert_slug" name="brand_slug" value="{{$edit_brand_product->brand_slug}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Thương Hiệu</label>
                            <textarea class="form-control" style="resize: none;" rows="8" id="add" name="brand_product_desc">{{$edit_brand_product->brand_desc}}</textarea>
                        </div>
                        <button type="submit" name="update_brand_product" class="btn btn-info">Update Thương Hiệu</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection