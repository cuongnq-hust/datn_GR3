@extends('layout')
@section('content')
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Video Shop</h2>
    @foreach($video as $key=>$vid)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <style type="text/css">
                .single-products.single-products-video {
                    height: 370px;
                }
            </style>
            <form>
                @csrf
                <div class="single-products single-products-video">
                    <div class="productinfo text-center">
                        <a href="">
                            <img src="{{asset('public/uploads/videos/'.$vid->video_image)}}" width="100" height="180" />
                            <h2>{{$vid->video_name}}</h2>
                            <p>{{$vid->video_desc}}</p>
                        </a>

                        <button type="button" class="btn btn-primary watch-video" data-toggle="modal" data-target="#modal_video" id={{$vid->video_id}}>
                            Xem Video
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>
<div class="modal fade" id="modal_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="video_name"></h3>
            </div>
            <div class="modal-body">
                <div id="video_link"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection