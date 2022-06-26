<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link rel="icon" href="{{asset('public/frontend/images/op.png')}}" type="image/gif" sizes="32x32">
    <link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet" />
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css" />
    <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/backend/css/bootstrap-tagsinput.css')}}" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}" type="text/css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="index.html" class="logo">
                    ADMIN
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{asset('public/backend/images/2.png')}}">
                            <span class="username"><?php
                                                    $name = Auth::user()->admin_name;
                                                    if ($name) {
                                                        echo  $name;
                                                    }
                                                    ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="{{URL::to('/logout-auth')}}"><i class="fa fa-key"></i> Đăng xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{URL::to('/dashboard')}}">
                                <i class="fa fa-dashboard"></i>
                                <span>Tổng Quan</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Slider - Banner</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/manage-slider')}}">
                                        <i class="fa fa-book"></i>
                                        <span>Slider-Banner</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-slider')}}">
                                        <i class="fa fa-book"></i>
                                        <span>Thêm Slider-Banner</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Đơn Hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/manage-order')}}">Quản Lý Đơn Hàng</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Mã Giảm Giá</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/insert-coupon')}}">Thêm Mã Giảm Giá</a></li>
                                <li><a href="{{URL::to('/list-coupon')}}">Danh Sách Mã Giảm Giá</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Liên Hệ</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/information')}}">Liên Hệ</a></li>

                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Vận Chuyển</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/delivery')}}">Quản Lý Vận Chuyển</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh Mục Sản Phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-category-product')}}">Thêm Danh Mục Sản Phẩm</a></li>
                                <li><a href="{{URL::to('/all-category-product')}}">Liệt Kê Danh Mục Sản Phẩm</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Thương Hiệu Sản Phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-brand-product')}}">Thêm Thương Hiệu Sản Phẩm</a></li>
                                <li><a href="{{URL::to('/all-brand-product')}}">Liệt Kê Thương Hiệu Sản Phẩm</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Sản Phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-product')}}">Thêm Sản Phẩm</a></li>
                                <li><a href="{{URL::to('/all-product')}}">Liệt Kê Sản Phẩm</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh Mục Bài Viết</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-category-post')}}">Thêm Danh Mục Bài Viết</a></li>
                                <li><a href="{{URL::to('/all-category-post')}}">Liệt Kê Danh Mục Bài Viết</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Bài Viết</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-post')}}">Thêm Bài Viết</a></li>
                                <li><a href="{{URL::to('/all-post')}}">Liệt Kê Bài Viết</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Video</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/video')}}">Video</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Comment</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/comment')}}">Comment</a></li>
                            </ul>
                        </li>
                        @hasrole(['admin','author'])
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>User</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-users')}}">Thêm User</a></li>
                                <li><a href="{{URL::to('/users')}}">Quản Lý User</a></li>
                            </ul>
                        </li>
                        @endhasrole
                        @impersonate()
                        <li>
                            <a href="{{URL::to('/impersonate-destroy')}}">
                                <i class="fa fa-dashboard"></i>
                                <span>Stop Chuyển Quyền</span>
                            </a>
                        </li>
                        @endimpersonate
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
            </section>
            @yield('admin_content')
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p>© 2022 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/backend/js/scripts.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
    <script src="{{asset('public/backend/js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('public/backend/js/simple.money.format.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $('.price_format').simpleMoneyFormat();
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();
        })
    </script>
    <script>
        CKEDITOR.replace('add', {
            filebrowserImageUploadUrl: "{{url('uploads-ckeditor?_token='.csrf_token())}}",
            filebrowserBrowseUrl: "{{url('file-browser?_token='.csrf_token())}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('add2', {
            filebrowserImageUploadUrl: "{{url('uploads-ckeditor?_token-'.csrf_token())}}",
            filebrowserBrowseUrl: "{{url('file-browser?_token='.csrf_token())}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript">
        $(document).ready(function() {
            fetch_delivery();

            function fetch_delivery() {
                $.ajax({
                    url: "{{ url('/select-feeship') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#load_delivery').html(data);
                    }
                });
            };
            $(document).on('blur', '.fee_feeship_edit', function() {
                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                $.ajax({
                    url: "{{ url('/update-delivery') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        feeship_id: feeship_id,
                        fee_value: fee_value,
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });
            })
            $('.add_delivery').click(function() {
                var city = $('.city').val();
                var province = $('.province').val();
                var wards = $('.wards').val();
                var fee_ship = $('.fee_ship').val();
                $.ajax({
                    url: "{{ url('/insert-delivery') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        city: city,
                        province: province,
                        wards: wards,
                        fee_ship: fee_ship,
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });

            });
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
                    url: "{{ url('/select-delivery') }}",
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
        $('.order_details').change(function() {
            var order_status = $(this).val();
            var order_id = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();
            quantity = [];
            $("input[name = 'product_sales_quantity']").each(function() {
                quantity.push($(this).val());
            });
            order_product_id = [];
            $("input[name = 'order_product_id']").each(function() {
                order_product_id.push($(this).val());
            });
            j = 0;
            for (i = 0; i < order_product_id.length; i++) {
                var order_qty = $('.order_qty_' + order_product_id[i]).val();
                var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();
                if (parseInt(order_qty) > parseInt(order_qty_storage)) {
                    j = j + 1;
                    if (j == 1) {
                        alert('Số lượng bán trong kho không đủ');
                    }
                    $('.color_qty_' + order_product_id[i]).css('background', 'red');
                }
            }
            if (j == 0) {
                $.ajax({
                    url: "{{ url('/update-order-qty') }}",
                    method: 'POST',
                    data: {
                        order_status: order_status,
                        order_id: order_id,
                        quantity: quantity,
                        order_product_id: order_product_id,
                        _token: _token
                    },
                    success: function(data) {
                        alert('Thay Đổi Tình Trạng Thành Công');
                        location.reload();
                    }
                });
            }
        });
    </script>
    <script type="text/javascript">
        $('.update_quantity_order').click(function() {
            var order_product_id = $(this).data('product_id');
            var order_qty = $('.order_qty_' + order_product_id).val();
            var order_code = $('.order_code').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/update-qty') }}",
                method: 'POST',
                data: {
                    order_product_id: order_product_id,
                    order_qty: order_qty,
                    order_code: order_code,
                    _token: _token
                },
                success: function(data) {
                    alert('cap nhat so luong thanh cong');
                    location.reload();
                }
            });
        })
    </script>
    <script type="text/javascript">
        function ChangeToSlug() {
            var slug;

            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            load_gallery();

            function load_gallery() {
                var pro_id = $('.pro_id').val();
                $.ajax({
                    url: "{{ url('/select-gallery') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        pro_id: pro_id,
                    },
                    success: function(data) {
                        $('#gallery_load').html(data);
                    }
                });
            }
            $('#file').change(function() {
                var error = '';
                var files = $('#file')[0].files;
                if (files.length > 5) {
                    error += '<p>Chỉ Được Chọn Tối Đa 5 Ảnh</p>';
                } else if (files.length == '') {
                    error += '<p>Bạn Không Thể Bỏ Trống Trường Này</p>';
                } else if (files.size > 2000000) {
                    error += '<p>File Ảnh Không Được Lớn Hơn 2MB</p>';
                }
                if (error == '') {

                } else {
                    $('#file').val('');
                    $('#error_gallery').html('<span class="text-danger">' + error + '</span>');
                    return false;
                }
            });
            $(document).on('blur', '.edit_gal_name', function() {
                var gal_id = $(this).data('gal_id');
                var gal_text = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/update-gallery-name') }}",
                    method: 'POST',
                    data: {
                        gal_id: gal_id,
                        gal_text: gal_text,
                        _token: _token,
                    },
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<span class="text-danger">Cập Nhật Tên Hình Ảnh Thành Công</span>'
                        );
                    }
                });
            });
            $(document).on('click', '.delete-gallery', function() {
                var gal_id = $(this).data('gal_id');
                var _token = $('input[name="_token"]').val();
                if (confirm('Bạn Muốn Xóa Hình Ảnh Này Không')) {
                    $.ajax({
                        url: "{{ url('/delete-gallery') }}",
                        method: 'POST',
                        data: {
                            gal_id: gal_id,
                            _token: _token,
                        },
                        success: function(data) {
                            load_gallery();
                            $('#error_gallery').html(
                                '<span class="text-danger">Xóa Hình Ảnh Thành Công</span>');
                        }
                    });
                }
            });
            $(document).on('change', '.file-image', function() {
                var gal_id = $(this).data('gal_id');
                var form_data = new FormData();
                form_data.append("file", document.getElementById('file-' + gal_id).files[0]);
                form_data.append("gal_id", gal_id);
                $.ajax({
                    url: "{{ url('/update-gallery') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<span class="text-danger">Update Hình Ảnh Thành Công</span>');
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            load_video();

            function load_video() {
                $.ajax({
                    url: "{{ url('/select-video') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#video_load').html(data);
                    }
                });
            }
            $(document).on('click', '.btn-add-video', function() {
                var video_name = $('.video_name').val();
                var video_slug = $('.video_slug').val();
                var video_link = $('.video_link').val();
                var video_desc = $('.video_desc').val();
                form_data = new FormData();
                form_data.append("file", document.getElementById('file_img_video').files[0]);
                form_data.append("video_name", video_name);
                form_data.append("video_slug", video_slug);
                form_data.append("video_link", video_link);
                form_data.append("video_desc", video_desc);
                $.ajax({
                    url: "{{ url('/insert-video') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        load_video();
                        $('#notify').html(
                            '<span class="text-success">Thêm Video Thành Công</span>');
                    }
                });
            });
            $(document).on('blur', '.video_edit', function() {
                var video_type = $(this).data('video_type');
                var video_id = $(this).data('video_id');
                if (video_type == 'video_name') {
                    var video_edit = $('#' + video_type + '_' + video_id).text();
                } else if (video_type == 'video_desc') {
                    var video_edit = $('#' + video_type + '_' + video_id).text();
                } else if (video_type == 'video_link') {
                    var video_edit = $('#' + video_type + '_' + video_id).text();
                } else if (video_type == 'video_slug') {
                    var video_edit = $('#' + video_type + '_' + video_id).text();
                }
                var video_check = video_type;

                $.ajax({
                    url: "{{ url('/update-video') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        video_edit: video_edit,
                        video_id: video_id,
                        video_check: video_check
                    },
                    success: function(data) {
                        load_video();
                        $('#notify').html(
                            '<span class="text-success">Update Video Thành Công</span>');
                    }
                });
            });
            $(document).on('click', '.btn-delete-video', function() {
                var video_id = $(this).data('video_id');
                if (confirm('Bạn Muốn Xóa Video Này Không')) {
                    $.ajax({
                        url: "{{ url('/delete-video') }}",
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            video_id: video_id,
                        },
                        success: function(data) {
                            load_video();
                            $('#notify').html(
                                '<span class="text-success">Xóa Video Thành Công</span>');
                        }
                    });
                };
            });
            $(document).on('change', '.file_img_video', function() {
                var video_id = $(this).data('video_id');
                var form_data = new FormData();
                form_data.append("file", document.getElementById('file-video-' + video_id).files[0]);
                form_data.append("video_id", video_id);
                $.ajax({
                    url: "{{ url('/update-video-image') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        load_video();
                        $('#notify').html(
                            '<span class="text-success">Update Hình Ảnh Thành Công</span>');
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $('.comment_duyet_btn').click(function() {
            var comment_status = $(this).data('comment_status');
            var comment_id = $(this).data('comment_id');
            var comment_product_id = $(this).attr('id');
            $.ajax({
                url: "{{ url('/allow-comment') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    comment_status: comment_status,
                    comment_id: comment_id,
                    comment_product_id: comment_product_id,
                },
                success: function(data) {
                    location.reload();
                    $('#notify_comment_status').html(
                        '<span class="text-success">Xử Lý Bình Luận Thành Công</span>');

                }
            });
        });

        $('.btn-reply-comment').click(function() {
            var comment_id = $(this).data('comment_id');
            var comment = $('.reply_comment_' + comment_id).val();
            var comment_product_id = $(this).data('product_id');
            $.ajax({
                url: "{{ url('/reply-comment') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    comment: comment,
                    comment_id: comment_id,
                    comment_product_id: comment_product_id,
                },
                success: function(data) {
                    $('.reply_comment_' + comment_id).val('');
                    $('#notify_comment_status').html(
                        '<span class="text-success">Trả Lời Bình Luận Thành Công</span>');
                }
            });
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#category_order').sortable({
                placeholder: 'ui-state-highlight',
                update: function(event, ui) {
                    var page_id_array = new Array();
                    $('#category_order tr').each(function() {
                        page_id_array.push($(this).attr("id"));
                    });

                    $.ajax({
                        url: "{{ url('/arrange-category') }}",
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            page_id_array: page_id_array,
                        },
                        success: function(data) {
                            alert(data);
                        }
                    })
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $("#datepicker").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
                duration: "slow"
            });
            $("#datepicker2").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
                duration: "slow"
            });
            $("#start_coupon").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "dd/mm/yy",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
                duration: "slow"
            });
            $("#end_coupon").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "dd/mm/yy",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
                duration: "slow"
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            chart30daysorder();
            var chart = new Morris.Bar({
                element: 'chart',
                lineColors: ['#819C79', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
                parseTime: false,
                hideHover: 'auto',
                xkey: 'period',
                ykeys: ['order', 'sales', 'profit', 'quantity'],
                labels: ['đơn hàng', 'doanh số', 'lợi nhuận', 'số lượng'],

            });

            function chart30daysorder() {
                $.ajax({
                    url: "{{ url('/days-order') }}",
                    method: 'POST',
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        chart.setData(data);
                    }
                });
            };
            $('.dashboard-filter').change(function() {
                var dashboard_value = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/dashboard-filter') }}",
                    method: 'POST',
                    dataType: "JSON",
                    data: {
                        _token: _token,
                        dashboard_value: dashboard_value,
                    },
                    success: function(data) {
                        chart.setData(data);
                    }
                });
            });


            $('#btn-dashboard-filter').click(function() {
                var _token = $('input[name="_token"]').val();
                var from_date = $('#datepicker').val();
                var to_date = $('#datepicker2').val();
                $.ajax({
                    url: "{{ url('/filter-by-day') }}",
                    method: 'POST',
                    dataType: "JSON",
                    data: {
                        _token: _token,
                        from_date: from_date,
                        to_date: to_date,
                    },
                    success: function(data) {
                        chart.setData(data);
                    }
                })
            })
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            new Morris.Donut({
                // ID of the element in which to draw the chart.
                element: 'donut',
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                labelColor: "#cccccc",
                resize: true,

                colors: [
                    '#E0F7FA',
                    '#B2EBF2',
                    '#80DEEA',
                    '#4DD0E1',
                    '#26C6DA',
                ],
                data: [{
                        label: "Sản Phẩm",
                        value: <?php echo $product_count ?>
                    },
                    {
                        label: "Bài Viết",
                        value: <?php echo $post_count ?>
                    },
                    {
                        label: "Đơn Hàng",
                        value: <?php echo $order_count ?>
                    },
                    {
                        label: "Video",
                        value: <?php echo $video_count ?>
                    },
                    {
                        label: "Khách Hàng",
                        value: <?php echo $customer_count ?>
                    }
                ],
                backgroundColor: '#333333', // border color

            });
        })
    </script>
    <script type="text/javascript">
        $('.btn-delete-document').click(function() {
            var product_id = $(this).data('document_id');
            $.ajax({
                url: "{{ url('/delete-document') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    product_id: product_id,
                },
                success: function(data) {
                    alert('Xóa file thành công');
                    location.reload();
                }
            });
        })
    </script>
    <script type="text/javascript">
        list_nut()

        function list_nut() {
            $.ajax({
                url: "{{ url('/list-nut') }}",
                method: 'GET',
                success: function(data) {
                    $('#list_nut').html(data);
                }
            });
        }

        function delete_icons(id) {
            $.ajax({
                url: "{{ url('/delete-icons') }}",
                method: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    list_nut();
                    $('#notify_icons').html(
                        '<span class="text-success">Xóa Icon Thành Công</span>');
                }
            });
        }
        $('.add-nut').click(function() {
            {
                var name = $('#name_icon').val();
                var link = $('#link_icon').val();
                var image = $('#image_icon')[0].files[0];
                var form_data = new FormData();
                form_data.append('file', image);
                form_data.append('name', name);
                form_data.append('link', link);
                $.ajax({
                    url: "{{ url('/add-nut') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        list_nut();
                        $('#notify_icons').html(
                            '<span class="text-success">Thêm nút thành công</span>');
                    }
                });
            }
        })
    </script>
    <script type="text/javascript">
        list_doitac()

        function list_doitac() {
            $.ajax({
                url: "{{ url('/list-doitac') }}",
                method: 'GET',
                success: function(data) {
                    $('#list_doitac').html(data);
                }
            });
        }

        function delete_doitac(id) {
            $.ajax({
                url: "{{ url('/delete-doitac') }}",
                method: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    list_doitac();
                    $('#notify_doitac').html(
                        '<span class="text-success">Xóa Đối Tác Thành Công</span>');
                }
            });
        }
        $('.add-doitac').click(function() {
            {
                var name = $('#name_doitac').val();
                var link = $('#link_doitac').val();
                var image = $('#image_doitac')[0].files[0];
                var form_data = new FormData();
                form_data.append('file', image);
                form_data.append('name', name);
                form_data.append('link', link);
                $.ajax({
                    url: "{{ url('/add-doitac') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        list_doitac();
                        $('#notify_doitac').html(
                            '<span class="text-success">Thêm đối tác thành công</span>');
                    }
                });
            }
        })
    </script>
    <script type="text/javascript">
        function previewFile(input) {
            var file = $(".image-preview").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $("#previewImage").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>