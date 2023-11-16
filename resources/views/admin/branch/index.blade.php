@extends('admin.layouts.app')
@section('content')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Ngành đào tạo</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{URL('admin/faculty')}}">Khoa</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Ngành đào tạo</li>
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
                                            <th scope="col">Tên ngành đào tạo</th>
                                            <th scope="col">Danh sách lớp</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @foreach($branchs as $branch)
                                        @php $i++; @endphp
                                        <tr>
                                            <th scope="row">{{$i}}</th>
                                            <td>{{$branch->name}}</td>
                                            <td>
                                                <a href="{{URL('admin/branch/class/'.$branch->id.'')}}">Xem danh sách</a>
                                            </td>
                                            <td>
                                                <a href="#">
                                                    <i class="fa-solid fa-pen-to-square"></i> Sửa
                                                </a>                                              
                                                |
                                                <a href="{{ URL('admin/branch/delete/'.$branch->id.'') }}">
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
                        <a href="{{ URL('admin/branch/add') }}" class="btn btn-success" id="btn">Thêm ngành đào tạo</a>
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