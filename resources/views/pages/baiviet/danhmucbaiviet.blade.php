@extends('layout')
@section('content')

<div class="features_items">
    <h2 class="title text-center">{{$meta_title}}</h2>
    @foreach($post as $key => $p)
    <div class="col-sm-12">
        <div class="product-image-wrapper" style="height: 200px;">
            <div class="single-products">
                <div class="productinfo text-center">
                    <div class="col-md-6">

                        <img style="height: 200px; padding: 5px" src="{{URL::to('public/uploads/post/'.$p->post_image)}}" alt="{{$p->post_slug}}" />

                    </div>

                    <div class="col-md-6">
                        <h4 style="color: black; padding: 5px">{{$p->post_title}}</h4>
                        <p>{!!$p->post_desc!!}</p>

                    </div>

                    <a href="{{URL::to('bai-viet/'.$p->post_slug)}}" class="btn btn-success btn-sm">
                        Xem Bài Viết
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection