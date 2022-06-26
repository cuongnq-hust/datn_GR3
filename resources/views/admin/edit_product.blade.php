@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập Nhật Sản Phẩm
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
                    @foreach($edit_product as $key=>$pro)
                    <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                            <input type="text" value="{{$pro->product_name}}" name="product_name" class="form-control" onkeyup="ChangeToSlug();" id="slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Slug</label>
                            <input type="text" class="form-control" id="convert_slug" value="{{$pro->product_slug}}" name="product_slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số Lượng</label>
                            <input type="number" value="{{$pro->product_quantity}}" name="product_quantity" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá Bán</label>
                            <input type="text" value="{{$pro->product_price}}" name="product_price" class="form-control price_format">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá Gốc</label>
                            <input type="text" value="{{$pro->product_cost}}" name="product_cost" class="form-control price_format">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                            <input type="file" onchange="previewFile(this);" name="product_image" class="form-control image-preview" id="exampleInputEmail1">
                            <img id="previewImage" src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" height="100" width="100">

                        </div>
                        <style type="text/css">
                            p.cofile {
                                text-align: left;
                                font-size: 16px;
                                margin: 5px 0;
                            }
                        </style>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tài Liệu</label>
                            <input type="file" name="document" class="form-control">
                            @if($pro->product_file)
                            <p class="cofile">
                                <a target="blank" href="{{asset('/public/uploads/document/'.$pro->product_file)}}">{{$pro->product_file}}
                                </a>
                                <button type="button" data-document_id="{{$pro->product_id}}" class="btn btn-sm btn-danger btn-delete-document"><i class="fa fa-times"></i>
                                </button>
                            </p>
                            @else
                            <p class="cofile">Không có file</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Sản Phẩm</label>
                            <textarea class="form-control" id="add" style="resize: none;" rows="8" name="product_desc">{{$pro->product_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội Dung Sản Phẩm</label>
                            <textarea id="add2" class="form-control" style="resize: none;" rows="8" name="product_content">{{$pro->product_content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh Mục Sản Phẩm</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key =>$cate)
                                @if($cate->category_id==$pro->category_id)
                                <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @else
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương Hiệu</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach($brand_product as $key =>$brand)
                                @if($brand->brand_id==$pro->brand_id)
                                <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @else
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tags Sản Phẩm</label>
                            <input type="text" name="product_tags" class="form-control" value="{{$pro->product_tags}}" data-role="tagsinput">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                @if($pro->product_status == 0)
                                <option selected value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                                @else
                                <option value="0">Hiển thị</option>
                                <option selected value="1">Ẩn</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" name="update_product" class="btn btn-info">Cập Nhật Sản Phẩm</button>
                    </form>
                    @endforeach
                </div>

            </div>
        </section>

    </div>
</div>
@endsection