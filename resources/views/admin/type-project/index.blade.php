@extends('admin.layouts.app')
@section('content')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Đồ án / Đề án</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Đồ án / Đề án</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                            {{session('success')}}
                        </div>
                        @endif
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Loại đồ án</th>
                                            <th scope="col">Thời gian duyệt đề cương</th>
                                            <th scope="col">Thời gian duyệt báo cáo</th>
                                            <th scope="col">Nhóm đồ án</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @foreach($types as $type)
                                        @php $i++; @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$type->title}}</td>
                                                <td>
                                                    {{$type->date_start}}
                                                    {{$type->time_start}}
                                                </td>
                                                <td>
                                                    {{$type->date_end}}
                                                    {{$type->time_end}}
                                                </td>
                                                <td>
                                                    <a href="{{URL('admin/group/project/'.$type->id.'')}}">Xem nhóm đồ án</a>
                                                </td>
                                                <td>
                                                    <a href="#">
                                                        <i class="fa-solid fa-pen-to-square"></i> Sửa
                                                    </a>
                                                    |
                                                    <a href="#">
                                                        <i class="fa-solid fa-trash"></i> Xóa
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <a href="{{URL('admin/type/branch/'.$branch.'/semester/'.$semester.'/project/add')}}" class="btn btn-success" id="btn">Thêm nhóm đồ án</a>
                    </div>
                </div>
            </div>
            <footer class="footer text-center">
                All Rights Reserved by Nice admin. Designed and Developed by
                <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
    <style>
        #btn {
            color: white;
        }
    </style>
@endsection