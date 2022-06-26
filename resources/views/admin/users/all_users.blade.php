@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt Kê Danh Mục Users
        </div>
        <div class="table-responsive">
            <?php
            $message = Session()->get('message');
            if ($message) {
                echo '<span class="text-alert">' . $message . '</span>';
                Session()->put('message', null);
            }
            ?>
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>

                        <th>Tên User</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Password</th>
                        <th>Author</th>
                        <th>Admin</th>
                        <th>User</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admin as $key => $user)
                    <form role="form" action="{{URL::to('/assign-roles')}}" method="POST">
                        @csrf
                        <tr>
                            <td>{{$user->admin_name}}</td>
                            <td>{{$user->admin_email}}
                                <input type="hidden" name="admin_email" value="{{$user->admin_email}}" />
                                <input type="hidden" name="admin_id" value="{{$user->admin_id}}" />
                            </td>
                            <td>{{$user->admin_phone}}</td>
                            <td>{{$user->admin_password}}</td>
                            <td><input type="checkbox" name="author_role" {{$user->hasRole('author')?'checked' : ''}}></td>
                            <td><input type="checkbox" name="admin_role" {{$user->hasRole('admin')?'checked' : ''}}></td>
                            <td><input type="checkbox" name="user_role" {{$user->hasRole('user')?'checked' : ''}}></td>
                            <td>
                                <p><input type="submit" value="Phân Quyền" class="btn btn-sm btn-default"></p>
                                <p><a style="margin-top: 5px;" class="btn btn-sm btn-danger" href="{{url('/delete-user-roles/'.$user->admin_id)}}">Xoá User</a></p>
                                <p><a style="margin-top: 5px;" class="btn btn-sm btn-success" href="{{url('/impersonate/'.$user->admin_id)}}">Đổi User</a></p>
                            </td>
                        </tr>
                    </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection