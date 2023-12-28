@extends('admin.layouts.app')
@section('content')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-6 align-self-center">
                        <h5 class="page-title">Nhóm đồ án thuộc {{$type->title}}</h5>
                    </div>
                    <div class="col-6 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Nhóm đồ án</li>
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
                                            <th scope="col">Tên nhóm đồ án</th>
                                            <th scope="col">Giảng viên hướng dẫn</th>
                                            <th scope="col">Danh sách sinh viên</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @if(!empty($groups))
                                        @foreach($groups as $group)
                                        @php $i++; @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$group->title}}</td>
                                                <td>{{$group->teacher->name}}</td>
                                                <td>
                                                    <a href="{{URL('admin/project/list/student/'.$group->id.'')}}">Xem danh sách</a>
                                                </td>
                                                <td>
                                                    <a href="#">
                                                        <i class="fa-solid fa-pen-to-square"></i> Sửa
                                                    </a>
                                                    |
                                                    <a href="{{URL('admin/group/project/delete/'.$group->id.'')}}">
                                                        <i class="fa-solid fa-trash"></i> Xóa
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <a href="{{URL('admin/group/project/'.$id.'/add')}}" class="btn btn-success" id="btn">Thêm nhóm đồ án</a>
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