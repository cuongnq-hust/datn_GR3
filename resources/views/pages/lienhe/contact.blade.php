@extends('layout')
@section('content')

<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Liên Hệ Với Chúng Tôi</h2>
    <div class="row">
        @foreach($contact as $key =>$cont)
        <div class="col-md-12">
            <div class="col-md-6">
                <h4>Thông Tin Liên Hệ</h4>
                {!!$cont->info_contact!!}

            </div>
            <div class="col-md-6">
                {!!$cont->info_fanpage!!}
            </div>
        </div>
        <div class="col-md-12">
            <h4>Bản Đồ</h4>
            {!!$cont->info_map!!}
        </div>
        @endforeach
    </div>

    @endsection