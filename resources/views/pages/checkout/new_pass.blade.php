@extends('layout')
@section('content_category')

<section id="form">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-sm-offset-1">
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
                    <!--login form-->
                    @php
                    $token = $_GET['token'];
                    $email = $_GET['email'];
                    @endphp
                    <h2>Điền Mật Khẩu Mới</h2>
                    <form action="{{url('/reset-new-pass')}}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{$email}}" />
                        <input type="hidden" name="token" value="{{$token}}" />
                        <input type="password" name="password_account" placeholder="Nhập Mật Khẩu Mới..." />
                        <button type="submit" class="btn btn-default">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection