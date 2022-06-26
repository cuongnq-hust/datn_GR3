@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm User
            </header>
            <div class="panel-body">
                <?php
                $message = Session()->get('message');
                if ($message) {
                    echo '<span class="text-alert" style="text-align: center">' . $message . '</span>';
                    Session()->put('message', null);
                }
                ?>
                <div class="position-center">
                    <form role="form" action="{{URL::to('/store-users')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên User</label>
                            <input type="text" name="admin_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="admin_email" class="form-control">
                        </div> <div class="form-group">
                            <label for="exampleInputEmail1">Điện Thoại</label>
                            <input type="text" name="admin_phone" class="form-control">
                        </div> <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="admin_password" class="form-control">
                        </div>
                        <button type="submit" name="add_user" class="btn btn-info">Thêm User</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection