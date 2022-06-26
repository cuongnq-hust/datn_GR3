@extends('layout')

@section('sidebar')
@include('pages.include.sidebar')
@endsection

@section('content')
<div class="features_items">
    <div class="category-tab">
        <!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                @php
                $i = 0;
                @endphp
                @foreach($cate_pro_tabs as $key => $cat_tab)
                @php
                $i++;
                @endphp
                <li class="tabs_pro {{$i==1 ? 'active' : ''}}" data-id="{{$cat_tab->category_id}}">
                    <a href="#tshirt" data-toggle="tab">{{$cat_tab->category_name}}</a>
                </li>
                @endforeach
            </ul>
        </div>
        <div id="tabs_product"></div>
    </div>
    <!--features_items-->
    <h2 class="title text-center">Sản Phẩm Mới Nhất</h2>
    <div id="all_product"></div>
    <div id="cart_session"></div>

</div>


<div class="modal fade" id="quick-cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="margin-top: 100px">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Giỏ Hàng Của Bạn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="show_quick_cart_alert"></div>
                <div id="show_quick_cart"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="sosanh" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top: 100px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span id="title-compare"></span></h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover" id="row_compare">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Hình ảnh</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title product_quickview_title" id="exampleModalLabel">
                    <span id="product_quickview_title"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-5">
                    <span id="product_quickview_image"></span>
                    <span id="product_quickview_gallery"></span>
                </div>
                <form>
                    @csrf
                    <div id="product_quickview_value"></div>
                    <div class="col-md-7">
                        <style type="text/css">
                            span#product_quickview_content img {
                                width: 100%;
                            }

                            span#product_quickview_desc img {
                                width: 100%;
                            }

                            span#product_quickview_content iframe {
                                width: 100%;
                            }

                            span#product_quickview_desc iframe {
                                width: 100%;
                            }
                        </style>
                        <h2 class="quickview">
                            <span id="product_quickview_title"></span>
                        </h2>
                        <p>Mã ID: <span id="product_quickview_id"></span></p>
                        <h2 style="font-size: 20px; color: brown; font-weight: bold">Giá Sản Phẩm : <span id="product_quickview_price"></span></h2>
                        <label> Số Lượng :</label>
                        <input name="qty" disabled type="number" min="1" value="1" />
                        <h4 style="font-size: 20px; color: brown; font-weight: bold">Mô Tả Sản Phẩm</h4>
                        <hr>
                        <p><span id="product_quickview_desc"></span></p>
                        <p><span id="product_quickview_content"></span></p>
                        <div id="product_quickview_button"></div>
                        <div id="beforesendquickview"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-secondary redirect-cart">Đi Tới Giỏ Hàng</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection