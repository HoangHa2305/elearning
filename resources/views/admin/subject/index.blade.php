@extends('admin.layouts.app')
@section('content')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Danh sách môn học</h4>
                    </div>
                    <div class="col-7 align-self-center">
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
                                            <th scope="col">Mã môn học</th>
                                            <th scope="col">Tên môn học</th>
                                            <th scope="col">Khóa học</th>
                                            <th scope="col">Lớp học phần</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @foreach($subjects as $subject)
                                        @php $i++; @endphp
                                        <tr>
                                            <th scope="row">{{$i}}</th>
                                            <td>{{$subject->code}}</td>
                                            <td>{{$subject->name}}</td>
                                            <td>{{$subject->yeartrain->name}}</td>
                                            <td>
                                                <a href="{{ URL('admin/subject/section/'.$subject->id.'') }}">Xem danh sách</a>
                                            </td>
                                            <td>
                                                <a href="{{ URL('admin/subject/edit/'.$subject->id.'') }}">
                                                    <i class="fa-solid fa-pen-to-square"></i> Sửa
                                                </a>                                              
                                                |
                                                <a href="{{ URL('admin/subject/delete/'.$subject->id.'') }}">
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
                        <a href="{{ URL('admin/subject/add') }}" class="btn btn-success" id="btn">Thêm môn học</a>
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
                .avatar {
                    width: 50px;
                    border-radius: 50%;
                }
            </style>
@endsection