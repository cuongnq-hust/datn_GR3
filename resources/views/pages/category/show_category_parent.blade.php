@extends('layout')
@section('content')
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Danh Mục {{$meta_title}}</h2>
    <div class="row">
        <div class="col-md-4">
            <label for="amount">Sắp Xếp Theo</label>
            <form>
                @csrf
                <select name="sort" id="sort" class="form-control">
                    <option value="{{Request::url()}}?sort_by=none">--Lọc--</option>
                    <option value="{{Request::url()}}?sort_by=tang_dan">--Giá Tăng Dần--</option>
                    <option value="{{Request::url()}}?sort_by=giam_dan">--Giá Giảm Dần--</option>
                    <option value="{{Request::url()}}?sort_by=kytu_az">--Lọc Theo Tên A Đến Z--</option>
                    <option value="{{Request::url()}}?sort_by=kytu_za">--Lọc Theo Tên Z Đến A--</option>
                </select>
            </form>
        </div>

        <div class="col-md-4">
            <label for="amount">Lọc Giá Theo</label>
            <form action="">
                <div id="slider-range"></div>
                <style type="text/css">
                    .style_range p {
                        float: left;
                        width: 25%;
                    }
                </style>
                <div class="style_range">
                    <p><input type="text" id="amount_start" readonly style="border:0; color:#f6931f; font-weight:bold;"></p>
                    <p> <input type="text" id="amount_end" readonly style="border:0; color:#f6931f; font-weight:bold;"></p>
                </div>
                <input type="hidden" name="start_price" id="start_price">
                <input type="hidden" name="end_price" id="end_price">
                <br>
                <div class="clearfix"></div>
                <input type="submit" name="filter_price" value="Lọc Giá" class="btn btn-sm btn-default">
            </form>
        </div>
    </div>
    <br>
    @foreach($category_by_id as $key=>$product)
    <a href="{{URL::to('chi-tiet-san-pham/'.$product->product_slug)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <form>
                            @csrf
                            <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                            <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                            <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                            <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

                            <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_slug)}}">
                                <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" width="100" height="180" />
                                <h2>{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</h2>
                                <p>{{$product->product_name}}</p>
                            </a>
                            <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">
                        </form>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu Thích</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>So Sánh</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </a>
    @endforeach
</div>
</div>
@endsection