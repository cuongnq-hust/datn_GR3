@extends('layout')
@section('content')
@foreach($product_details as $key=>$value)


<input type="hidden" value="{{$value->product_id}}" id="product_viewed_id">
<input type="hidden" value="{{$value->product_name}}" id="viewed_productname{{$value->product_id}}">
<input type="hidden" value="{{asset('public/uploads/product/'.$value->product_image)}}" id="viewed_productimage{{$value->product_id}}">
<input type="hidden" value="{{url('/chi-tiet-san-pham/'.$value->product_slug)}}" id="viewed_producturl{{$value->product_id}}">
<input type="hidden" value="{{$value->product_price}}" id="viewed_productprice{{$value->product_id}}">

<div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="false"></div>
<div class="fb-share-button" data-href="{{$url_canonical}}" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
<div class="product-details">
    <!--product-details-->
    <style type="text/css">
        .lSSlideOuter .lSPager.lSGallery img {
            height: 140px;
            width: 100%;
        }
        li.active {
            border: 2px solid #FE980F;
        }
    </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background: none;">
            <li class="breadcrumb-item"><a href="{{url('/trang-chu')}}">Trang Chủ</a></li>
            <li class="breadcrumb-item"><a href="{{url('/danh-muc-san-pham/'.$value->category_slug)}}">{{$value->category_name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$value->product_name}}</li>
        </ol>
    </nav>
    <div class="col-sm-5">
        <ul id="imageGallery">
            @foreach($gallery as $key => $gal)
            <li data-thumb="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" data-src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}">
                <img alt="{{$gal->gallery_name}}" src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" style="width: 100%; height: 390px" />
            </li>
            @endforeach
        </ul>
    </div>
    <div class="col-sm-7">

        <div class="product-information">
            <!--/product-information-->
            <img src="{{asset('public/frontend/images/new.jpg')}}" class="newarrival" alt="" />
            <h2>{{$value->product_name}}</h2>
            <p>ID:{{$value->product_id}}</p>
            <ul class="list-inline" title="Average Rating">
                @for($count=1; $count<=5; $count++) @php if($count<=$rating){ $color='color: #ffcc00' ; } else{ $color='color: #ccc' ; } @endphp <li title="star_rating" data-index="{{$count}}" data-rating="{{$rating}}" style="cursor: pointer; {{$color}}; font-size: 30px">
                    &#9733
                    </li>
                    @endfor
            </ul>
            <form action="{{URL::to('/save-cart')}}" method="POST">
                @csrf
                <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                <span>
                    <span>{{number_format($value->product_price,0,',','.').'VNĐ'}}</span>
                    <label>Số lượng:</label>
                    <input name="qty" type="number" min="1" class="cart_product_qty_{{$value->product_id}}" value="1" />
                    <input name="productid_hidden" type="hidden" value="{{$value->product_id}}" />
                </span>
                <input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">
            </form>
            <p><b>Tình Trạng:</b> Còn Hàng</p>
            <p><b>Điều Kiện:</b> Mới 100%</p>
            <p><b>Thương Hiệu:</b> {{$value->brand_name}}</p>
            <p><b>Danh Mục:</b> {{$value->category_name}}</p>
            <a href=""><img src="{{URL::to('public/frontend/images/share.png')}}" class="share img-responsive" alt="" /></a>
        </div>
        <!--/product-information-->
        <br>
        <style type="text/css">
            a.tags_style {
                margin: 3px 2px;
                border: 1px solid;
                height: auto;
                background: #428bca;
                color: #fff;
                padding: 0px;
            }

            a.tags_style:hover {
                background: black;
            }
        </style>
        <fieldset>
            <legend>Tags</legend>
            <p>
                <i class="fa fa-tag"></i>
            </p>
            @php
            $tags = $value->product_tags;
            $tags = explode(",",$tags);
            @endphp
            @foreach($tags as $tag)
            @php
            $tags = str_replace(" ", "-",$tag);
            $tags = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $tags);
            $tags = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $tags);
            $tags = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $tags);
            $tags = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $tags);
            $tags = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $tags);
            $tags = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $tags);
            $tags = preg_replace("/(đ)/", 'd', $tags);
            $tags = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $tags);
            $tags = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $tags);
            $tags = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $tags);
            $tags = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $tags);
            $tags = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $tags);
            $tags = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $tags);
            $tags = preg_replace("/(Đ)/", 'D', $tags);
            @endphp
            <a href="{{url('/tag/'.$tags)}}" class="tags_style">{{$tags}}</a>
            @endforeach
        </fieldset>
    </div>
</div>
<!--/product-details-->

<div class="category-tab shop-details-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li><a href="#details" data-toggle="tab">Mô Tả Sản Phẩm</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Chi Tiết Sản Phẩm</a></li>
            <li class="active"><a href="#reviews" data-toggle="tab">Đánh Giá</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade " id="details">
            <p>{!!$value->product_desc!!}</p>
        </div>

        <div class="tab-pane fade" id="companyprofile">
            <p>{!!$value->product_content!!}</p>
        </div>
        <div class="tab-pane fade active in " id="reviews">
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>Admin</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2022</a></li>
                </ul>
                <style type="text/css">
                    .row.style_comment {
                        border: 1px solid #ddd;
                        border-radius: 10px;
                        background: aliceblue;
                    }
                </style>
                <form>
                    @csrf
                    <input type="hidden" name="comment_product_id" value="{{$value->product_id}}" class="comment_product_id">
                    <div id="comment_show">
                    </div>
                </form>
                <p><b>Viết Bình Luận</b></p>
                <ul class="list-inline" title="Average Rating">
                    @for($count=1; $count<=5; $count++) @php if($count<=$rating){ $color='color: #ffcc00' ; } else{ $color='color: #ccc' ; } @endphp <li title="star_rating" id="{{$value->product_id}}-{{$count}}" data-index="{{$count}}" data-product_id="{{$value->product_id}}" data-rating="{{$rating}}" class="rating" style="cursor: pointer; {{$color}}; font-size: 30px">
                        &#9733
                        </li>
                        @endfor
                </ul>
                <form>
                    @csrf
                    <span>
                        <input style="width: 100%" type="text" class="comment_name" placeholder="Tên Của Bạn" />
                    </span>
                    <div id="notify_comment"></div>
                    <textarea name="comment" class="comment_content" placeholder="Nội Dung Bình Luận"></textarea>
                    <button type="button" class="btn btn-default pull-right send-comment">
                        Thêm Bình Luận
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/category-tab-->
@endforeach
<!-- <div class="fb-comments" data-href="{{$url_canonical}}" data-width="500" data-numposts="5"></div> -->

<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center">Sản Phẩm Liên Quan</h2>
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach($related as $key=>$lienquan)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <form action="">
                                    @csrf
                                    <input type="hidden" value="{{$lienquan->product_id}}" class="cart_product_id_{{$lienquan->product_id}}">
                                    <input type="hidden" value="{{$lienquan->product_name}}" class="cart_product_name_{{$lienquan->product_id}}">
                                    <input type="hidden" value="{{$lienquan->product_image}}" class="cart_product_image_{{$lienquan->product_id}}">
                                    <input type="hidden" value="{{$lienquan->product_price}}" class="cart_product_price_{{$lienquan->product_id}}">
                                    <input type="hidden" value="{{$lienquan->product_quantity}}" class="cart_product_quantity_{{$lienquan->product_id}}">
                                    <input type="hidden" value="1" class="cart_product_qty_{{$lienquan->product_id}}">
                                    <a href="{{URL::to('chi-tiet-san-pham/'.$lienquan->product_slug)}}">
                                        <img src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="" />
                                        <h2>{{number_format($lienquan->product_price)}}.VND</h2>
                                        <p>{{$lienquan->product_name}}</p>
                                    </a>
                                    <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$lienquan->product_id}}" name="add-to-cart">
                                        Thêm Giỏ Hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!--/recommended_items-->


@endsection