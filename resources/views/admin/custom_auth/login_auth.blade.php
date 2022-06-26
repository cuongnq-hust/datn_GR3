<!DOCTYPE html>

<head>
    <title>Đăng Nhập Auth</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet" />
    <!-- font CSS -->
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css" />
    <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <script src="js/jquery2.0.3.min.js"></script>
</head>

<body>
    <div class="log-w3">
        <div class="w3layouts-main">
            <h2>Đăng Nhập</h2>
            <?php
            $message = Session()->get('message');
            if ($message) {
                echo '<span class="text-alert">' . $message . '</span>';
                Session()->put('message', null);
            }
            ?>
            <form action="{{URL::to('/login')}}" method="post">
                {{csrf_field()}}
                @foreach($errors->all() as $val)
                <ul>
                    <li>{{$val}}</li>
                </ul>
                @endforeach
                <input type="text" class="ggg" name="admin_email" placeholder="Điền Email">
                <input type="password" class="ggg" name="admin_password" placeholder="Điền Password">
                <span><input type="checkbox" />Ghi nhớ mật khâu</span>
                <h6><a href="#">Quên Mật Khẩu?</a></h6>
                <div class="clearfix"></div>
                <input type="submit" value="Đăng Nhập" name="login">
                <br />
            </form>
            <a href="{{URL::to('/register-auth')}}">Đăng ký</a> |
            <a href="{{URL::to('login-facebook')}}">Đăng Nhập Bằng FaceBook</a> |
            <a href="{{URL::to('login-google')}}">Đăng Nhập Bằng Google</a>
        </div>
    </div>
    <script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/backend/js/scripts.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v13.0" nonce="6SH7VZ6c"></script>
    <script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>