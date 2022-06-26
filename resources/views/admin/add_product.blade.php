@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Sản Phẩm
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
                    <form autocomplete="off" role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                            <input type="text" name="product_name" class="form-control" onkeyup="ChangeToSlug();" id="slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Slug</label>
                            <input type="text" class="form-control" id="convert_slug" name="product_slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số Lượng</label>
                            <input type="number" name="product_quantity" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá Bán</label>
                            <input type="text" name="product_price" class="form-control price_format">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá Gốc</label>
                            <input type="text" name="product_cost" class="form-control price_format">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                            <input type="file" name="product_image" class="form-control image-preview" onchange="previewFile(this);" id="exampleInputEmail1">
                            <img src="https://inantemnhan.com.vn/wp-content/uploads/2017/10/no-image.png" id="previewImage" alt="" width="30%">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tài Liệu</label>
                            <input type="file" name="document" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Sản Phẩm</label>
                            <textarea class="form-control" id="add" style="resize: none;" rows="8" name="product_desc" placeholder="Mô tả Sản Phẩm"></textarea>

                            <!-- <textarea id="add" class="form-control" style="resize: none;" rows="8" name="product_desc" placeholder="Mô tả Sản Phẩm"></textarea> -->
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội Dung Sản Phẩm</label>
                            <textarea id="add2" class="form-control" style="resize: none;" rows="8" name="product_content" placeholder="Mô tả Nội Dung Sản Phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh Mục Sản Phẩm</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key =>$cate)
                                @if($cate->category_parent == 0)
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @foreach($cate_product as $key2 => $cate_sub)
                                @if($cate_sub->category_parent != 0 && $cate_sub->category_parent==$cate->category_id)
                                <option style="color: green" value="{{$cate_sub->category_id}}">-->{{$cate_sub->category_name}}</option>
                                @endif
                                @endforeach
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương Hiệu</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach($brand_product as $key =>$brand)
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tags Sản Phẩm</label>
                            <input type="text" name="product_tags" class="form-control" data-role="tagsinput">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Thêm Sản Phẩm</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection