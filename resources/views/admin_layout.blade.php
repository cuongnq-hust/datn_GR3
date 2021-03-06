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
                            <li><a href="{{URL::to('/logout-auth')}}"><i class="fa fa-key"></i> ????ng xu???t</a></li>
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
                                <span>T???ng Quan</span>
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
                                        <span>Th??m Slider-Banner</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>????n H??ng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/manage-order')}}">Qu???n L?? ????n H??ng</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>M?? Gi???m Gi??</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/insert-coupon')}}">Th??m M?? Gi???m Gi??</a></li>
                                <li><a href="{{URL::to('/list-coupon')}}">Danh S??ch M?? Gi???m Gi??</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Li??n H???</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/information')}}">Li??n H???</a></li>

                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>V???n Chuy???n</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/delivery')}}">Qu???n L?? V???n Chuy???n</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh M???c S???n Ph???m</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-category-product')}}">Th??m Danh M???c S???n Ph???m</a></li>
                                <li><a href="{{URL::to('/all-category-product')}}">Li???t K?? Danh M???c S???n Ph???m</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Th????ng Hi???u S???n Ph???m</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-brand-product')}}">Th??m Th????ng Hi???u S???n Ph???m</a></li>
                                <li><a href="{{URL::to('/all-brand-product')}}">Li???t K?? Th????ng Hi???u S???n Ph???m</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>S???n Ph???m</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-product')}}">Th??m S???n Ph???m</a></li>
                                <li><a href="{{URL::to('/all-product')}}">Li???t K?? S???n Ph???m</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh M???c B??i Vi???t</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-category-post')}}">Th??m Danh M???c B??i Vi???t</a></li>
                                <li><a href="{{URL::to('/all-category-post')}}">Li???t K?? Danh M???c B??i Vi???t</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>B??i Vi???t</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-post')}}">Th??m B??i Vi???t</a></li>
                                <li><a href="{{URL::to('/all-post')}}">Li???t K?? B??i Vi???t</a></li>
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
                                <li><a href="{{URL::to('/add-users')}}">Th??m User</a></li>
                                <li><a href="{{URL::to('/users')}}">Qu???n L?? User</a></li>
                            </ul>
                        </li>
                        @endhasrole
                        @impersonate()
                        <li>
                            <a href="{{URL::to('/impersonate-destroy')}}">
                                <i class="fa fa-dashboard"></i>
                                <span>Stop Chuy???n Quy???n</span>
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
                    <p>?? 2022 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
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
                        alert('S??? l?????ng b??n trong kho kh??ng ?????');
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
                        alert('Thay ?????i T??nh Tr???ng Th??nh C??ng');
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

            //L???y text t??? th??? input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //?????i k?? t??? c?? d???u th??nh kh??ng d???u
            slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
            slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
            slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
            slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
            slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
            slug = slug.replace(/??|???|???|???|???/gi, 'y');
            slug = slug.replace(/??/gi, 'd');
            //X??a c??c k?? t??? ?????t bi???t
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
            slug = slug.replace(/ /gi, "-");
            //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
            //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox c?? id ???slug???
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
                    error += '<p>Ch??? ???????c Ch???n T???i ??a 5 ???nh</p>';
                } else if (files.length == '') {
                    error += '<p>B???n Kh??ng Th??? B??? Tr???ng Tr?????ng N??y</p>';
                } else if (files.size > 2000000) {
                    error += '<p>File ???nh Kh??ng ???????c L???n H??n 2MB</p>';
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
                            '<span class="text-danger">C???p Nh???t T??n H??nh ???nh Th??nh C??ng</span>'
                        );
                    }
                });
            });
            $(document).on('click', '.delete-gallery', function() {
                var gal_id = $(this).data('gal_id');
                var _token = $('input[name="_token"]').val();
                if (confirm('B???n Mu???n X??a H??nh ???nh N??y Kh??ng')) {
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
                                '<span class="text-danger">X??a H??nh ???nh Th??nh C??ng</span>');
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
                            '<span class="text-danger">Update H??nh ???nh Th??nh C??ng</span>');
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
                            '<span class="text-success">Th??m Video Th??nh C??ng</span>');
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
                            '<span class="text-success">Update Video Th??nh C??ng</span>');
                    }
                });
            });
            $(document).on('click', '.btn-delete-video', function() {
                var video_id = $(this).data('video_id');
                if (confirm('B???n Mu???n X??a Video N??y Kh??ng')) {
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
                                '<span class="text-success">X??a Video Th??nh C??ng</span>');
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
                            '<span class="text-success">Update H??nh ???nh Th??nh C??ng</span>');
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
                        '<span class="text-success">X??? L?? B??nh Lu???n Th??nh C??ng</span>');

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
                        '<span class="text-success">Tr??? L???i B??nh Lu???n Th??nh C??ng</span>');
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
                prevText: "Th??ng tr?????c",
                nextText: "Th??ng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? Nh???t"],
                duration: "slow"
            });
            $("#datepicker2").datepicker({
                prevText: "Th??ng tr?????c",
                nextText: "Th??ng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? Nh???t"],
                duration: "slow"
            });
            $("#start_coupon").datepicker({
                prevText: "Th??ng tr?????c",
                nextText: "Th??ng sau",
                dateFormat: "dd/mm/yy",
                dayNamesMin: ["Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? Nh???t"],
                duration: "slow"
            });
            $("#end_coupon").datepicker({
                prevText: "Th??ng tr?????c",
                nextText: "Th??ng sau",
                dateFormat: "dd/mm/yy",
                dayNamesMin: ["Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? Nh???t"],
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
                labels: ['????n h??ng', 'doanh s???', 'l???i nhu???n', 's??? l?????ng'],

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
                        label: "S???n Ph???m",
                        value: <?php echo $product_count ?>
                    },
                    {
                        label: "B??i Vi???t",
                        value: <?php echo $post_count ?>
                    },
                    {
                        label: "????n H??ng",
                        value: <?php echo $order_count ?>
                    },
                    {
                        label: "Video",
                        value: <?php echo $video_count ?>
                    },
                    {
                        label: "Kh??ch H??ng",
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
                    alert('X??a file th??nh c??ng');
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
                        '<span class="text-success">X??a Icon Th??nh C??ng</span>');
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
                            '<span class="text-success">Th??m n??t th??nh c??ng</span>');
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
                        '<span class="text-success">X??a ?????i T??c Th??nh C??ng</span>');
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
                            '<span class="text-success">Th??m ?????i t??c th??nh c??ng</span>');
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