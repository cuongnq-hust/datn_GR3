<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Danh mục sản phẩm</h2>
        <div class="panel-group category-products" id="accordian">
            <!--category-productsr-->
            @foreach($category as $key => $cate)
            <div class="panel panel-default">
                @if($cate->category_parent == 0)
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#{{$cate->category_id}}" data-parent='#accordian'>
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{$cate->category_name}}
                        </a>
                    </h4>
                </div>
                <div id="{{$cate->category_id}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach($category as $key => $cate_sub)
                            @if($cate_sub->category_parent == $cate->category_id)
                            <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate_sub->category_slug)}}">{{$cate_sub->category_name}}</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        <!--/category-products-->

        <div class="brands_products">
            <!--brands_products-->
            <h2>Thương hiệu sản phẩm</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach($brand as $key => $brand)
                    <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_slug)}}"> <span class="pull-right"></span>{{$brand->brand_name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="brands_products">
            <!--brands_products-->
            <h2>Sản Phẩm Đã Xem</h2>
            <div class="brands-name">
                <div id="row_viewed" class="row"></div>
            </div>
        </div>
        <div class="brands_products">
            <!--brands_products-->
            <h2>Sản Phẩm Yêu Thích</h2>
            <div class="brands-name">
                <div id="row_wishlist" class="row"></div>
            </div>
        </div>
        <!--/brands_products-->
    </div>
</div>