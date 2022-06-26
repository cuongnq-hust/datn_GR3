@extends('layout')
@section('content')
<style type="text/css">
    .baiviet ul li {
        padding: 2px;
        font-size: 16px;
    }

    .baiviet ul li a {
        color: #000;
    }

    .baiviet ul li a:hover {
        color: #FE980F;
    }

    .baiviet ul li {
        list-style-type: decimal-leading-zero;
    }

    .mucluc h1 {
        font-size: 20px;
        color: brown;
    }
</style>
<div class="fb-share-button" data-href="{{$url_canonical}}" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
<div class="features_items">
    <h2 class="title text-center" style="font-size: 22px;">{{$meta_title}}</h2>
    <div class="product-image-wrapper" style="border: none;">
        @foreach($post as $key => $p)
        <div class="single-products" style="margin: 10px 0; padding: 2px">
            {!!$p->post_content!!}
        </div>
        <div class="clearfix"></div>
        @endforeach
    </div>
</div>
<div class="features_items">
    <h2 class="title text-center">Tin Liên Quan</h2>
    @foreach($related as $key => $rela)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img style="height: 200px; padding: 5px" src="{{URL::to('public/uploads/post/'.$rela->post_image)}}" alt="{{$rela->post_slug}}" />
                    <h4 style="color: black; padding: 5px">{{$rela->post_title}}</h4>
                    <p>{!!$rela->post_desc!!}</p>
                    <a href="{{URL::to('bai-viet/'.$rela->post_slug)}}" class="btn btn-default btn-sm">
                        Xem Bài Viết
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection