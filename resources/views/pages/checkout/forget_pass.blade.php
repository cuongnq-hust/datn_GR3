@extends('layout')
@section('content_category')

<section id="form">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->
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
                    <h2>Điền email để lấy lại mật khẩu</h2>
                    <form action="{{url('/recover-pass')}}" method="POST">
                        @csrf
                        <input type="text" name="email_account" placeholder="Nhập Email..." />
                        <button type="submit" class="btn btn-default">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection