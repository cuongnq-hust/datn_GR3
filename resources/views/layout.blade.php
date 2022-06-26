<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$meta_desc}}">
    <meta name="author" content="">
    <meta name="keywords" content="{{$meta_keywords}}">
    <meta name="robots" content="INDEX,FOLLOW">
    <link rel="canonical" href="{{$url_canonical}}">
    <link rel="icon" type="image/x-icon" href="" />
    <link rel="icon" href="{{asset('public/frontend/images/op.png')}}" type="image/gif" sizes="32x32">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{$meta_title}}</title>
    <meta property="og:site_name" content="{{$meta_keywords}}" />
    <meta property="og:description" content="{{$meta_desc}}" />
    <meta property="og:title" content="{{$meta_title}}" />
    <meta property="og:url" content="{{$url_canonical}}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://ben.com.vn/tin-tuc/wp-content/uploads/2021/10/hinh-nen-one-piece-1_optimized.jpg" />
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/vlite.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/owl.theme.default.min.css')}}" rel="stylesheet">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<!--/head-->

<body>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a target="_blank" href="https://www.facebook.com/Joyboy2105"><i class="fa fa-phone"></i><span style="color: red;">Hotline :
                                            0971136949</span></a></li>
                                <li><a target="_blank" href="https://www.facebook.com/Joyboy2105"><i class="fa fa-envelope"></i>cuongnq.hust@gmail.com</a></li>
                                <li><a><i class="fa fa-shopping-cart"></i> MUA HÀNG: 8:00 AM - 22:00 PM</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                @foreach($icons as $key => $ico)
                                <li>
                                    <a target="_blank" href="{{$ico->link}}">
                                        <img src="{{asset('/public/uploads/icons/'.$ico->image)}}" alt="{{$ico->name}}" width="32px" style="margin: 5px">
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            @foreach($contact_footer as $key=> $logo)
                            <img width="200px" height="100px" src="{{asset('/public/uploads/info/'.$logo->info_image)}}" alt="" />
                            @endforeach
                        </div>
                        <!-- <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    Ngôn Ngữ
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="">Tiếng Việt</a></li>
                                    <li><a href="">Tiếng Anh</a></li>
                                    <li><a href="">Tiếng Trung</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">

                            <ul class="nav navbar-nav">
                                <!-- <li><a href="#"><i class="fa fa-star"></i> Yêu Thích</a></li> -->
                                <?php
                                $customer_id = Session()->get('customer_id');
                                if ($customer_id != NUll) {
                                ?>
                                    <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh Toán</a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh
                                            Toán</a></li>
                                <?php
                                }
                                ?>
                                <li class="cart-hover">
                                    <a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ Hàng
                                        <span class="show_cart"></span>
                                        <div class="clearfix"></div>
                                        <span class="giohang_hover">
                                        </span>
                                    </a>
                                </li>
                                <?php
                                $customer_id = Session()->get('customer_id');
                                if ($customer_id != NUll) {
                                ?>
                                    <li><a href="{{URL::to('/history')}}"><i class="fa fa-bell"></i> Lịch sử đơn hàng</p>
                                        </a></li>
                                <?php
                                } else {
                                ?>
                                <?php
                                }
                                ?>

                                <li><a href="{{URL::to('/video-shop')}}"><i class="fa fa-youtube"></i> Videos shop</a>
                                </li>
                                <?php
                                $customer_id = Session()->get('customer_id');
                                if ($customer_id != NUll) {
                                ?>
                                    <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng Xuất :
                                            <p>{{$customer_name}}</p>
                                        </a></li>
                                <?php
                                } else {
                                ?>
                                    <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng Nhập</a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom" id="navbar">

            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">Trang Chủ</a></li>

                                <li class="dropdown"><a href="">Sản Phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category as $key =>$danhmuc)
                                        @if($danhmuc->category_parent == 0)
                                        <li><a href="{{URL::to('/danh-muc/'.$danhmuc->category_slug)}}">{{$danhmuc->category_name}}</a></li>
                                        @foreach($category as $key =>$danhmuccon)
                                        @if($danhmuccon->category_parent == $danhmuc->category_id)
                                        <ul class="cate_sub">
                                            <li><a style="font-size: 15px;" href="{{URL::to('/danh-muc-san-pham/'.$danhmuccon->category_slug)}}">{{$danhmuccon->category_name}}</a>
                                            </li>
                                        </ul>
                                        @endif
                                        @endforeach
                                        @endif

                                        @endforeach
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Tin Tức<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category_post as $key =>$danhmucbaiviet)
                                        <li><a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug)}}">
                                                {{$danhmucbaiviet->cate_post_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{URL::to('/gio-hang')}}">Giỏ Hàng
                                        <span class="show_cart"></span>

                                    </a></li>
                                <li><a href="{{URL::to('/lien-he')}}">Liên Hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{URL::to('/tim-kiem')}}" autocomplete="off" method="POST">
                            {{csrf_field()}}
                            <div class="search_box pull-right" style="width: 100%;">
                                <input name="keywords_submit" style="width: 100%;" id="keywords" type="text" placeholder="Tìm Kiếm Sản Phẩm" />
                                <div style="position: absolute;" id="search_ajax"></div>
                                <input type="submit" style="margin-top: 0; color:black; float: right;" class="btn btn-primary btn-sm" value="Tìm Kiếm" name="search_items" />
                            </div>
                        </form>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->
    <section id="slider">
        <!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        <style type="text/css">
                            img.img.img-responsive.img-slider {
                                height: 350px;
                            }
                        </style>
                        <div class="carousel-inner">
                            @php
                            $i = 0;
                            @endphp
                            @foreach($slider as $key => $slide)
                            @php
                            $i++;
                            @endphp
                            <div class="item {{$i==1 ? 'active' : '' }}">
                                <div class="col-sm-12">
                                    <img alt="{{$slide->slider_desc}}" src="{{asset('public/uploads/slider/'.$slide->slider_image)}}" height="200" width="100%" class="img img-responsive img-slider">
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
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
                                            <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate_sub->category_slug)}}">{{$cate_sub->category_name}}</a>
                                            </li>
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
                <div class="col-sm-9 padding-right">
                    @yield('content')
                </div>
                <div class="col-md-12">
                    <h3 style="text-align: center">Đối Tác Của Chúng tôi</h3>
                    <div class="owl-carousel owl-theme">
                        @foreach($doitac as $key=> $doi)
                        <div class="item" style="padding-left: 0px;">
                            <a href="{{$doi->link}}" target="_blank">
                                <p><img height="160px" src="{{asset('/public/uploads/icons/'.$doi->image)}}" alt=""></p>
                                <h4 style="text-align: center;">{{$doi->name}}</h4>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>



        </div>
    </section>

    <!--/Footer-->
    <footer id="footer">
        <!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="address">
                            @foreach($contact_footer as $key=> $left)
                            <img width="100%" height="200px" src="{{asset('/public/uploads/info/'.$left->info_image)}}" alt="" />
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="video-gallery text-center">
                            <img width="500px" src="data:image/jpeg;base64,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" alt="" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img width="100%" height="200px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJ12dM9k-mN3e5k7X80Wvz81QtaHbXGYDZLuE4V8zYtraKwT0WvjOaNhL9WUdNe7N3kQk&usqp=CAU" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Dịch Vụ Chúng Tôi</h2>
                            <ul class="nav nav-pills nav-stacked">
                                @foreach($post_footer as $key=>$post_foot)
                                <li><a href="{{url('/bai-viet/'.$post_foot->post_slug)}}">{{$post_foot->post_title}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @foreach($contact_footer as $key=> $contactfo)
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>Thông Tin Shop</h2>
                            {!!$contactfo->info_contact!!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>Fanpage</h2>
                            {!!$contactfo->info_fanpage!!}
                        </div>
                    </div>
                    @endforeach
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>Đăng Ký Email</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Điền email của bạn" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Đăng ký để nhận những thông tin mới nhất</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Graduation project 08/2022</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="https://www.facebook.com/NguyenQuocCuong143/">JoyBoy</a></span></p>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
    <script src="{{asset('public/frontend/js/prettify.js')}}"></script>
    <script src="{{asset('public/frontend/js/vlite.js')}}"></script>
    <script src="{{asset('public/frontend/js/simple.money.format.js')}}"></script>
    <script src="{{asset('public/frontend/js/owl.carousel.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0&appId=1339749896514111&autoLogAppEvents=1" nonce="AGZbgMBP">
    </script>
    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            hover_cart();

            function hover_cart() {
                $.ajax({
                    url: "{{ url('/hover-cart') }}",
                    method: 'GET',
                    success: function(data) {
                        $('.giohang_hover').html(data);
                    }
                });
            }
            show_cart();

            function show_cart() {
                $.ajax({
                    url: "{{ url('/show-cart') }}",
                    method: 'GET',
                    success: function(data) {
                        $('.show_cart').html(data);
                    }
                });
            }

            $('.add-to-cart').click(function() {
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                    alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
                } else {
                    $.ajax({
                        url: "{{ url('/add-cart-ajax') }}",
                        method: 'POST',
                        data: {
                            cart_product_id: cart_product_id,
                            cart_product_name: cart_product_name,
                            cart_product_image: cart_product_image,
                            cart_product_price: cart_product_price,
                            cart_product_quantity: cart_product_quantity,
                            cart_product_qty: cart_product_qty,
                            _token: _token,
                        },
                        success: function(data) {
                            hover_cart();
                            show_cart();
                            cart_session();
                            Swal.fire('Sản Phẩm Đã Được Thêm Vào Giỏ Hàng')
                        }
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: "{{ url('/select-delivery-home') }}",
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.calculate_delivery').click(function() {
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if (matp == '' && maqh == '' && xaid == '') {
                    alert('Làm ơn chọn để tính phí vận chuyển')
                } else {
                    $.ajax({
                        url: "{{ url('/calculate-fee') }}",
                        method: 'POST',
                        data: {
                            matp: matp,
                            maqh: maqh,
                            xaid: xaid,
                            _token: _token
                        },
                        success: function(data) {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.send_order').click(function() {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Xác Nhận Đơn Hàng',
                    text: "Đơn Hàng Sẽ Không Được Hoàn Trả. Bạn Có Muốn Đặt Không!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Đặt Hàng!',
                    cancelButtonText: 'Hủy Đơn Hàng!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        if ($('.shipping_email').val()) {
                            var shipping_email = $('.shipping_email').val();
                        } else {
                            var shipping_email = 'Không có';
                        }
                        if ($('.shipping_name').val()) {
                            var shipping_name = $('.shipping_name').val();
                        } else {
                            var shipping_name = 'Không có';
                        }
                        if ($('.shipping_address').val()) {
                            var shipping_address = $('.shipping_address').val();

                        } else {
                            var shipping_address = 'Không có';
                        }
                        if ($('.shipping_phone').val()) {
                            var shipping_phone = $('.shipping_phone').val();
                        } else {
                            var shipping_phone = 'Không có';
                        }
                        if ($('.shipping_notes').val()) {
                            var shipping_notes = $('.shipping_notes').val();

                        } else {
                            var shipping_notes = 'Không có';
                        }
                        var shipping_method = $('.payment_select').val();
                        var order_fee = $('.order_fee').val();
                        var order_coupon = $('.order_coupon').val();
                        $.ajax({
                            url: "{{ url('/confirm-order') }}",
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                shipping_email: shipping_email,
                                shipping_name: shipping_name,
                                shipping_address: shipping_address,
                                shipping_phone: shipping_phone,
                                shipping_notes: shipping_notes,
                                shipping_method: shipping_method,
                                order_fee: order_fee,
                                order_coupon: order_coupon,
                            },
                            success: function(data) {
                                swalWithBootstrapButtons.fire(
                                    'Đơn Hàng!',
                                    'Đơn Hàng Của Bạn Đã Được Đặt!',
                                    'success'
                                );
                            }
                        });
                        window.setTimeout(function() {
                            window.location.href = "{{url('/history')}}";
                        }, 5000);

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Đơn Hàng',
                            'Đơn Hàng Của Bạn Đã Được Hủy!)',
                            'error'
                        )
                    }
                });

            });
        });
    </script>
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>
    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>
    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "101242195948714");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>
    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v14.0'
            });
        };
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 3,
                slideMargin: 0,
                enableDrag: false,
                currentPagerPosition: 'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).on('click', '.watch-video', function() {
            var video_id = $(this).attr('id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/watch-video') }}",
                method: 'POST',
                dataType: "JSON",
                data: {
                    video_id: video_id,
                    _token: _token
                },
                success: function(data) {
                    $('#video_name').html(data.video_name);
                    $('#video_link').html(data.video_link);
                }
            })
        })
    </script>
    <script type="text/javascript">
        $('#keywords').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/autocomplete-ajax') }}",
                    method: 'POST',
                    data: {
                        query: query,
                        _token: _token,
                    },
                    success: function(data) {
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });
            } else {
                $('#search_ajax').fadeOut();
            }
        });
        $(document).on('click', 'li', function() {
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    </script>
    <script type="text/javascript">
        function Xemnhanh(id) {
            var product_id = id;
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/quickview') }}",
                method: 'POST',
                dataType: "JSON",
                data: {
                    product_id: product_id,
                    _token: _token,
                },
                success: function(data) {
                    $('#product_quickview_title').html(data.product_name);
                    $('#product_quickview_id').html(data.product_id);
                    $('#product_quickview_price').html(data.product_price);
                    $('#product_quickview_image').html(data.product_image);
                    $('#product_quickview_gallery').html(data.product_gallery);
                    $('#product_quickview_desc').html(data.product_desc);
                    $('#product_quickview_content').html(data.product_content);
                    $('#product_quickview_value').html(data.product_quickview_value);
                    $('#product_quickview_button').html(data.product_quickview_button);
                }
            });
        }
    </script>
    <script type="text/javascript">
        $(document).on('click', '.add-to-cart-quickview', function() {
            var id = $(this).data('id_product');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name="_token"]').val();
            if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
            } else {
                $.ajax({
                    url: "{{ url('/add-cart-ajax') }}",
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_quantity: cart_product_quantity,
                        cart_product_qty: cart_product_qty,
                        _token: _token,
                    },
                    beforeSend: function() {
                        $("#beforesendquickview").html(
                            "<p class='text text-primary'>Đang Thêm Sản Phẩm Vào Giỏ Hàng</p>")
                    },
                    success: function(data) {
                        $("#beforesendquickview").html(
                            "<p class='text text-success'>Đã Thêm Sản Phẩm Vào Giỏ Hàng</p>")

                    }
                });
            }
            $(document).on('click', '.redirect-cart', function() {
                window.location.href = "{{ url('/gio-hang') }}"
            })
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            load_comment();

            function load_comment() {
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/load-comment') }}",
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        _token: _token,
                    },
                    success: function(data) {
                        $('#comment_show').html(data);
                    }
                });
            }
            $('.send-comment').click(function() {
                var product_id = $('.comment_product_id').val();
                var comment_name = $('.comment_name').val();
                var comment_content = $('.comment_content').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/send-comment') }}",
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        comment_name: comment_name,
                        comment_content: comment_content,
                        _token: _token,
                    },
                    success: function(data) {
                        $('#notify_comment').html(
                            '<span class="text text-success"> Thêm Bình Luận Thành Công. Bình Luận Đang Chờ Duyệt</span>'
                        );
                        load_comment();
                        $('#notify_comment').fadeOut(5000);
                        $('.comment_content').val('');
                        $('.comment_name').val('');
                    }
                });
            });
        })
    </script>
    <script type="text/javascript">
        function remove_background(product_id) {
            for (var count = 1; count <= 5; count++) {
                $('#' + product_id + '-' + count).css("color", "#ccc");
            }
        }
        $(document).on('mouseenter', '.rating', function() {
            var index = $(this).data('index');
            var product_id = $(this).data('product_id');
            remove_background(product_id);
            for (var count = 1; count <= index; count++) {
                $('#' + product_id + '-' + count).css("color", "#ffcc00");
            }
        });
        $(document).on('mouseleave', '.rating', function() {
            var index = $(this).data('index');
            var product_id = $(this).data('product_id');
            var rating = $(this).data('rating');
            remove_background(product_id);
            for (var count = 1; count <= rating; count++) {
                $('#' + product_id + '-' + count).css("color", "#ffcc00");
            }
        });
        $(document).on('click', '.rating', function() {
            var index = $(this).data('index');
            var product_id = $(this).data('product_id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/insert-comment') }}",
                method: 'POST',
                data: {
                    index: index,
                    product_id: product_id,
                    _token: _token,
                },
                success: function(data) {
                    if (data == 'done') {
                        Swal.fire('Bạn Đã Đánh Giá ' + index + ' trên 5');
                    }
                }
            });
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var cate_id = $('.tabs_pro').data('id');
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ url('/product-tabs') }}",
                method: 'POST',
                data: {
                    cate_id: cate_id,
                    _token: _token,
                },
                success: function(data) {
                    $('#tabs_product').html(data);
                }
            });
            $('.tabs_pro').click(function() {
                var cate_id = $(this).data('id');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/product-tabs') }}",
                    method: 'POST',
                    data: {
                        cate_id: cate_id,
                        _token: _token,
                    },
                    success: function(data) {
                        $('#tabs_product').html(data);
                    }
                })
            })
        })
    </script>
    <script type="text/javascript">
        function view() {
            if (localStorage.getItem('data') != null) {
                var data = JSON.parse(localStorage.getItem('data'));
                data.reverse();
                document.getElementById('row_wishlist').style.overflow = 'scroll';
                document.getElementById('row_wishlist').style.height = '200px';
                for (i = 0; i < data.length; i++) {

                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;
                    $('#row_wishlist').append(
                        '<div class="row" style="margin: 10px 0"><div class="col-md-4"><img src = "' + image +
                        '" width="100%"></div><div class="col-md-8 info_wishlist"><p>' + name +
                        '</p><p style="color: #FE980F">' + price + '</p><a href="' + url +
                        '">Xem Sản Phẩm</a></div></div>'
                    );
                }
            }
        }
        view();

        function add_wistlist(clicked_id) {
            var id = clicked_id;
            var name = document.getElementById('wishlist_productname' + id).value;
            var price = document.getElementById('wishlist_productprice' + id).value;
            var image = document.getElementById('wishlist_productimage' + id).src;
            var url = document.getElementById('wishlist_producturl' + id).href;
            var newItem = {
                'name': name,
                'id': id,
                'price': price,
                'image': image,
                'url': url
            }
            if (localStorage.getItem('data') == null) {
                localStorage.setItem('data', '[]');
            }
            var old_data = JSON.parse(localStorage.getItem('data'));
            var matches = $.grep(old_data, function(obj) {
                return obj.id == id;
            })
            if (matches.length) {
                Swal.fire('<span style="color: red;"> Sản Phẩm Đã Có Trong Phần Yêu Thích</span>')
            } else {
                Swal.fire('<span style="color: green;"> Sản Phẩm Đã Được Thêm Vào Yêu Thích</span>')
                old_data.push(newItem);
                $("#row_wishlist").append(
                    '<div class="row" style="margin: 10px 0"><div class="col-md-4"><img src = "' + newItem.image +
                    '" width="100%"></div><div class="col-md-8 info_wishlist"><p>' + newItem.name +
                    '</p><p style="color: #FE980F">' + newItem.price + '</p><a href="' + newItem.url +
                    '">Xem Sản Phẩm</a></div></div>'
                );
            }
            localStorage.setItem('data', JSON.stringify(old_data));
        }
    </script>
    <script type="text/javascript">
        function viewed() {
            if (localStorage.getItem('viewed') != null) {
                var data = JSON.parse(localStorage.getItem('viewed'));
                data.reverse();
                document.getElementById('row_viewed').style.overflow = 'scroll';
                document.getElementById('row_viewed').style.height = '200px';
                for (i = 0; i < data.length; i++) {
                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;
                    $('#row_viewed').append(
                        '<div class="row" style="margin: 10px 0"><div class="col-md-4"><img src = "' + image +
                        '" width="100%"></div><div class="col-md-8 info_wishlist"><p>' + name +
                        '</p><p style="color: #FE980F">' + price + '</p><a href="' + url +
                        '">Xem Sản Phẩm</a></div></div>'
                    );
                }
            }
        }
        viewed();
        product_viewed();

        function product_viewed() {
            var id_product = $('#product_viewed_id').val();
            if (id_product != undefined) {
                var id = id_product;
                var name = document.getElementById('viewed_productname' + id).value;
                var url = document.getElementById('viewed_producturl' + id).value;
                var price = document.getElementById('viewed_productprice' + id).value;
                var image = document.getElementById('viewed_productimage' + id).value;
                var newItem = {
                    'name': name,
                    'id': id,
                    'price': price,
                    'image': image,
                    'url': url
                }
                if (localStorage.getItem('viewed') == null) {
                    localStorage.setItem('viewed', '[]');
                }
                var old_data = JSON.parse(localStorage.getItem('viewed'));
                var matches = $.grep(old_data, function(obj) {
                    return obj.id == id;
                })
                if (matches.length) {} else {
                    old_data.push(newItem);
                    $("#row_viewed").append(
                        '<div class="row" style="margin: 10px 0"><div class="col-md-4"><img src = "' + newItem.image +
                        '" width="100%"></div><div class="col-md-8 info_wishlist"><p>' + newItem.name +
                        '</p><p style="color: #FE980F">' + newItem.price + '</p><a href="' + newItem.url +
                        '">Xem Sản Phẩm</a></div></div>'
                    );
                }
                localStorage.setItem('viewed', JSON.stringify(old_data));
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sort').on('change', function() {
                var url = $(this).val();
                if (url) {
                    window.location = url;
                }
                return false;
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#slider-range").slider({
                orientation: "horizontal",
                range: true,
                min: <?php echo $min_price ?>,
                max: <?php echo $max_price ?>,
                value: [<?php echo $min_price ?>, <?php echo $max_price ?>],
                step: 10000,
                slide: function(event, ui) {
                    $("#amount_start").val(ui.values[0] + 'đ').simpleMoneyFormat();
                    $("#amount_end").val(ui.values[1] + 'đ').simpleMoneyFormat()

                    $("#start_price").val(ui.values[0]).simpleMoneyFormat();
                    $("#end_price").val(ui.values[1]).simpleMoneyFormat();
                }
            });
            $("#amount_start").val($("#slider-range").slider("values", 0) + 'đ').simpleMoneyFormat();
            $("#amount_end").val($("#slider-range").slider("values", 1) + 'đ').simpleMoneyFormat();
        });
    </script>
    <script type="text/javascript">
        hover_cart();
        show_cart();

        function hover_cart() {
            $.ajax({
                url: "{{ url('/hover-cart') }}",
                method: 'GET',
                success: function(data) {
                    $('.giohang_hover').html(data);
                }
            });
        }

        function show_cart() {
            $.ajax({
                url: "{{ url('/show-cart') }}",
                method: 'GET',
                success: function(data) {
                    $('.show_cart').html(data);
                }
            });
        }

        function show_quick_cart() {
            $.ajax({
                url: "{{ url('/show-quick-cart') }}",
                method: 'GET',
                success: function(data) {
                    $('#show_quick_cart').html(data);
                    $('#quick-cart').modal();
                }
            });
        }

        function DeleteItemCart($session_id) {
            var session_id = $session_id;
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/delete-product-ajax') }}" + '/' + session_id,
                method: 'GET',
                data: {
                    _token: _token
                },
                success: function(data) {
                    $('#show_quick_cart_alert').append(
                        '<p class="text text-success">Xóa Sản Phẩm Thành Công<p>')
                    setTimeout(function() {
                        $('#show_quick_cart_alert').fadeOut(1000);
                    }, 1000)
                    show_quick_cart();
                }
            });
        }
        $(document).on('input', '.cart_quantity_update', function() {
            var quantity = $(this).val();
            var session_id = $(this).data('session_id');

            $.ajax({
                url: "{{ url('/update-quick-cart') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    quantity: quantity,
                    session_id: session_id
                },
                success: function(data) {

                    show_quick_cart();
                }
            });
        })

        function Addtocart($product_id) {
            var id = $product_id;
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name="_token"]').val();
            if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
            } else {
                $.ajax({
                    url: "{{ url('/add-cart-ajax') }}",
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_quantity: cart_product_quantity,
                        cart_product_qty: cart_product_qty,
                        _token: _token,
                    },
                    success: function(data) {
                        show_quick_cart();
                        document.getElementsByClassName("home_cart_" + id)[0].style.display = "none";
                        document.getElementsByClassName("rm_home_cart_" + id)[0].style.display = "inline";
                        hover_cart();
                        show_cart();
                        cart_session();
                    }
                });
            }
        }

        function Deletecart(id) {
            var id = id;

            $.ajax({
                url: "{{ url('/remove-item') }}",
                method: 'GET',
                data: {
                    id: id,
                },
                success: function(data) {
                    Swal.fire('<span style="color: red">Sản Phẩm Đã Được Xóa Khỏi Giỏ Hàng</span>');
                    document.getElementsByClassName("home_cart_" + id)[0].style.display = "inline";
                    document.getElementsByClassName("rm_home_cart_" + id)[0].style.display = "none";
                    hover_cart();
                    show_cart();
                    cart_session();
                }
            });
        }
    </script>
    <script type="text/javascript">
        function delete_compare(id) {
            if (localStorage.getItem('compare') != null) {

                var data = JSON.parse(localStorage.getItem('compare'));
                var index = data.findIndex(item => item.id === id);
                data.splice(index, 1);
                localStorage.setItem('compare', JSON.stringify(data));
                document.getElementById("row_compare" + id).remove();
            }
        }
        viewed_compare();

        function viewed_compare() {
            if (localStorage.getItem('compare') != null) {
                var data = JSON.parse(localStorage.getItem('compare'));

                for (i = 0; i < data.length; i++) {
                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;
                    var id = data[i].id;
                    $('#row_compare').find('tbody').append(`
                   <tr id="row_compare` + id + `">
                   <td>` + name + `</td>
                   <td>` + price + `</td>
                   <td><img width="200px" src="` + image + `"</td>
                   <td><a href="` + url + `">Xem sản phẩm</a></td>
                   <td><a style="cursor: pointer;" onclick="delete_compare(` + id + `)">Xóa so sánh</a></td> 
                   </tr>
                   `);
                }
            }
        }

        function add_compare(product_id) {
            // document.getElementById('title-compare').innerText = 'Chỉ cho phép so sánh tối đa 3 sản phẩm';
            var id = product_id;

            var name = document.getElementById('wishlist_productname' + id).value;
            var price = document.getElementById('wishlist_productprice' + id).value;
            var image = document.getElementById('wishlist_productimage' + id).src;
            var url = document.getElementById('wishlist_producturl' + id).href;



            var newItem = {
                'url': url,
                'id': id,
                'name': name,
                'price': price,
                'image': image,

            }
            if (localStorage.getItem('compare') == null) {
                localStorage.setItem('compare', '[]');
            }
            var old_data = JSON.parse(localStorage.getItem('compare'));
            var matches = $.grep(old_data, function(obj) {
                return obj.id == id;
            })
            if (matches.length) {
                // alert('Sản Phẩm Đã Được Thêm Vào Yêu Thích'); 
            } else {
                if (old_data.length <= 2) {
                    old_data.push(newItem);
                    $('#row_compare').find('tbody').append(`
                   <tr id="row_compare` + id + `">
                   <td>` + newItem.name + `</td>
                   <td>` + newItem.price + `</td>
                   <td><img width="200px" src="` + image + `"</td>
                   <td><a href="` + newItem.url + `">Xem sản phẩm</a></td>
                   <td ><a style="cursor: pointer;" onclick="delete_compare(` + id + `)">Xóa so sánh</a></td> 
                   </tr>
                   `);
                };
            }
            localStorage.setItem('compare', JSON.stringify(old_data));
            $('#sosanh').modal();
        }
    </script>
    <script type="text/javascript">
        window.onscroll = function() {
            sticky_navbar()
        };

        var navbar = document.getElementById("navbar");

        var sticky = navbar.offsetTop;

        function sticky_navbar() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script>
    <script>
        load_more_product();
        cart_session();
        htmlLoaded();

        function cart_session() {
            $.ajax({
                url: "{{ url('/cart-session') }}",
                method: 'GET',
                success: function(data) {
                    $('#cart_session').html(data);
                }
            });
        }

        function htmlLoaded() {
            $(window).load(function() {
                var id = [];
                $('.cart_id').each(function() {
                    id.push($(this).val());
                });
                for (var i = 0; i < id.length; i++) {
                    $('.home_cart_' + id[i]).hide();
                    $('.rm_home_cart_' + id[i]).show();
                }
            });
        }

        function load_more_product(id = '') {
            $.ajax({
                url: "{{ url('/load-more-product') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function(data) {
                    $('#load_more_button').remove();
                    $('#all_product').append(data);
                    var id = [];
                    $('.cart_id').each(function() {
                        id.push($(this).val());
                    });
                    for (var i = 0; i < id.length; i++) {
                        $('.home_cart_' + id[i]).hide();
                        $('.rm_home_cart_' + id[i]).show();
                    }
                }
            });
        }
        $(document).on('click', '#load_more_button', function() {
            var id = $(this).data('id');
            load_more_product(id);
        })
    </script>
    <script type="text/javascript">
        function Huydonhang(id) {
            var order_code = id;
            var lydo = $('.lydohuydon').val();
            $.ajax({
                url: "{{ url('/huy-don-hang') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    order_code: order_code,
                    lydo: lydo
                },
                success: function(data) {
                    alert('Hủy Đơn Hàng Thành Công');
                    location.reload();
                }
            });
        }
    </script>
</body>

</html>