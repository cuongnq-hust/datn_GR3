@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt Kê Bình Luận
        </div>
        <div id="notify_comment_status"></div>
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
                        <th>Duyệt</th>
                        <th>Người Gửi</th>
                        <th>Ngày Gửi</th>
                        <th>Bình Luận</th>
                        <th>Sản Phẩm</th>
                        <th>Quản Lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comment as $key => $comm)
                    <tr>
                        <td>
                            @if($comm->comment_status == 0)
                            <input type="button" data-comment_status="1" data-comment_id="{{$comm->comment_id}}" id="{{$comm->comment_product_id}}" class="btn btn-danger btn-xs comment_duyet_btn" value="Bỏ Duyệt">
                            @else
                            <input type="button" data-comment_status="0" data-comment_id="{{$comm->comment_id}}" id="{{$comm->comment_product_id}}" class="btn btn-primary btn-xs comment_duyet_btn" value="Duyệt">
                            @endif
                        </td>
                        <td>{{$comm->comment_name}}</td>
                        <td>{{$comm->comment_date}}</td>
                        <td>
                            {{$comm->comment}}
                            <style type="text/css">
                                ul.list_rep li {
                                    list-style-type: decimal;
                                    color: blue;

                                }
                            </style>
                            <ul class="list_rep">
                                Trả lời :
                                @foreach($comment_rep as $key =>$com_reply)
                                @if($com_reply->comment_parent_comment == $comm->comment_id)
                                <li> {{$com_reply->comment}}</li>
                                @endif
                                @endforeach
                            </ul>
                            @if($comm->comment_status == 0)
                            <br />
                            <textarea class="form-control reply_comment_{{$comm->comment_id}}" cols="50" rows="1"></textarea>
                            <br />
                            <button class="btn btn-success btn-xs btn-reply-comment" data-comment_id="{{$comm->comment_id}}" data-product_id="{{$comm->comment_product_id}}">Trả Lời Bình Luận</button>

                            @endif
                        </td>
                        <td>
                            <a href="{{URL::to('chi-tiet-san-pham/'.$comm->product->product_slug)}}" target="_blank">
                                {{$comm->product->product_name}}
                            </a>
                        </td>
                        <td>
                            <a href="" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a href="" onclick="return confirm('Bạn có chắc muốn xóa bình luận này không?')" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection