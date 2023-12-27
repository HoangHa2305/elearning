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
                                <div>
                                    <a href="{{ URL('admin/tution') }}" class="btn btn-success" id="btn">Sinh viên đã nộp học phí</a>
                                    <a href="{{ URL('admin/tution/not/submit') }}" class="btn btn-danger" id="btn">Sinh viên chưa nộp học phí</a>
                                </div>
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Mã sinh viên</th>
                                            <th scope="col">Tên sinh viên</th>
                                            <th scope="col">Tình trạng nộp học phí</th>
                                            <th scope="col">Mã học phí</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @if(!empty($tutions))
                                        @foreach($tutions as $tution)
                                        @php $i++; @endphp
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$tution->student->code}}</td>
                                            <td>{{$tution->student->name}}</td>
                                            <td>
                                                <a href="#">
                                                    Đã nộp học phí
                                                </a>
                                            </td>
                                            <td>{{$tution->code}}</td>
                                        </tr>
                                        @endforeach
                                        @elseif(!empty($datas))
                                            @foreach($datas as $data)
                                                @php $i++; @endphp
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$data['code']}}</td>
                                                    <td>{{$data['name']}}</td>
                                                    <td colspan="2">
                                                        <p>
                                                            Chưa nộp học phí
                                                        </p>
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
                        <a href="{{ URL('admin/tution/add') }}" class="btn btn-success" id="btn">Nhập học phí</a>
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