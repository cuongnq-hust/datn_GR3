@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt Kê Danh Mục Sản Phẩm
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
                        <th>Tên Danh Mục</th>
                        <th>Thuộc Danh Mục</th>
                        <th>Slug</th>
                        <th>Hiển Thị</th>
                        <th></th>
                    </tr>
                </thead>
                <style type="text/css">
                    #category_order .ui-state-highlight{
                        padding: 24px;
                        background-color: #ffffcc;
                        border: 1px dotted #ccc;
                        cursor: move;
                        margin-top: 12px;
                    }
                </style>
                <tbody id="category_order">
                    @foreach($all_category_product as $key => $cate_pro)
                    <tr id="{{$cate_pro->category_id}}">
                        <td>{{$cate_pro->category_name}}</td>
                        <td>
                            @if($cate_pro->category_parent ==0)
                            <span style="color: red">Danh mục cha</span>
                            @else
                            @foreach($category_product as $key => $cate_sub_pro)
                            @if($cate_sub_pro->category_id==$cate_pro->category_parent)
                            <span style="color: green">{{$cate_sub_pro->category_name}}</span>
                            @endif
                            @endforeach
                            @endif
                        </td>
                        <td>{{$cate_pro->category_slug}}</td>
                        <?php
                        if ($cate_pro->category_status == 0) {
                        ?>
                            <td>
                                <a href="{{URL::to('/unactive-category-product/'.$cate_pro->category_id)}}">
                                    <i class="fa-thumb-styling fa fa-thumbs-up"></i>
                                </a>
                            </td>
                        <?php
                        } else {
                        ?>
                            <td>
                                <a href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}">
                                    <i class="fa-thumb-styling fa fa-thumbs-down"></i>
                                </a>
                            </td>
                        <?php
                        }
                        ?>
                        <td>
                            <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a href="{{URL::to('/delete-category-product/'.$cate_pro->category_id)}}" onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?')" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- <form action="{{url('import-csv')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" accept=".xlsx"><br>
                <input type="submit" value="Import file Excel" name="import_csv" class="btn btn-warning">
            </form>
            <form action="{{url('export-csv')}}" method="POST">
                @csrf
                <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
            </form> -->
        </div>
    </div>
</div>
@endsection