@extends('admin.layouts.app')
@section('content')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <p class="page-title" id="title">Danh sách sinh viên thuộc nhóm {{$grouproject->title}}</p>
                    </div>
                    <div class="col-5 align-self-center">
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
                                            <th scope="col">Mã sinh viên</th>
                                            <th scope="col">Tên sinh viên</th>
                                            <th scope="col">Đề cương</th>
                                            <th scope="col">Báo cáo</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @foreach($reports as $report)
                                        @php $i++; @endphp
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$report->code_student}}</td>
                                            <td>{{$report->student->name}}</td>
                                            <td>
                                                @if(isset($report->topic))
                                                <p>Đã nộp</p>
                                                @else
                                                <p>Chưa nộp</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($report->report))
                                                <p>Đã nộp</p>   
                                                @else
                                                <p>Chưa nộp</p>
                                                @endif
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
                        <a href="{{URL('admin/project/list/student/'.$grouproject->id.'/add')}}" class="btn btn-success" id="btn">Thêm sinh viên</a>
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
        #title{
            font-size: 16px;
        }
    </style>
@endsection