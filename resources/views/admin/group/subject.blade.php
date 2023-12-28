@extends('admin.layouts.app')
@section('content')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-6 align-self-center">
                        <h4 class="page-title">Các môn học của nhóm: {{$group->name}}</h4>
                    </div>
                    <div class="col-6 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Môn học</li>
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
                                            <th scope="col">Mã lớp học phần</th>
                                            <th scope="col">Tên lớp học phần</th>
                                            <th scope="col">Giảng viên giảng dạy</th>
                                            <th scope="col">Quản lý điểm</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @foreach($sections as $section)
                                        @php $i++; @endphp
                                        <tr>
                                            <th scope="row">{{$i}}</th>
                                            <td>{{$section->code}}</td>
                                            <td>{{$section->name}}</td>
                                            <td>{{$section->teacher->name}}</td>
                                            <td>
                                                <a href="{{URL('admin/group/subject/score/'.$section->id.'')}}">Quản lý</a>
                                            </td>
                                            <td>
                                                @if($section->active==1)
                                                <span class="label label-success label-rounded">Hiển thị</span>
                                                @else
                                                <span class="label label-danger label-rounded">Ẩn</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{URL('admin/section/edit/'.$section->id.'')}}">
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
                        <a href="{{ URL('admin/section/add') }}" class="btn btn-success" id="btn">Thêm lớp học phần</a>
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