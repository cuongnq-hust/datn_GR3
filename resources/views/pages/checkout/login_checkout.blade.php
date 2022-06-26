@extends('layout')
@section('content')


<section id="form">
    <!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-sm-offset-1">
                <?php
                $message = Session()->get('message');
                $error = Session()->get('error');

                if ($message) {
                    echo '<div class="alert alert-success">' . $message . '</div>';
                    Session()->put('message', null);
                } elseif ($error) {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                    Session()->put('error', null);
                }
                ?>
                <div class="login-form">
                    <h2>Đăng Nhập Tài Khoản</h2>
                    <form action="{{URL::to('/login-customer')}}" method="POST">
                        {{csrf_field()}}
                        <input type="text" name="email_account" placeholder="Tài khoản" />
                        <input type="password" name="password_account" placeholder="Password" />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Ghi nhớ Đăng Nhập
                        </span>
                        <span>
                            <a href="{{url('/quen-mat-khau')}}">Quên Mật Khẩu</a>

                        </span>
                        <button type="submit" class="btn btn-default">Đăng Nhập</button>
                    </form>
                    <style type="text/css">
                        ul.list-login {
                            margin: 10px;
                            padding: 0;
                        }

                        ul.list-login li {
                            display: inline;
                            margin: 5px;
                        }
                    </style>
                    <ul class="list-login">
                        <li>
                            <a href="{{url('/login-customer-google')}}">
                                <img src="{{asset('public/frontend/images/gg.png')}}" width="10%" alt="Đăng nhập tài khoản bằng google">
                            </a>
                        </li>
                    </ul>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-3">
                <div class="signup-form">
                    <!--sign up form-->
                    <h2>Đăng ký</h2>
                    <form action="{{URL::to('/add-customer')}}" method="POST">
                        {{csrf_field()}}
                        <input type="text" name="customer_name" placeholder="Họ Và Tên" />
                        <input type="email" name="customer_email" placeholder="Địa Chỉ Email" />
                        <input type="password" name="customer_password" placeholder="Mật Khẩu" />
                        <input type="text" name="customer_phone" placeholder="Phone" />
                        <button type="submit" class="btn btn-default">Đăng Ký</button>
                    </form>
                </div>
                <!--/sign up form-->
            </div>
        </div>
    </div>
</section>
<!--/form-->

@endsection