@extends('admin.layouts.app')
@section('content')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Nhóm học phần</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Nhóm học phần</li>
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
                                            <th scope="col">Tên nhóm học phần</th>
                                            <th scope="col">Ngành</th>
                                            <th scope="col">Học kì</th>
                                            <th scope="col">Danh sách môn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @foreach($groups as $group)
                                        @php $i++; @endphp
                                        <tr>
                                            <th scope="row">{{$i}}</th>
                                            <td>{{$group->name}}</td>
                                            <td>
                                                {{$group->branch->name}}
                                            </td>
                                            <td>
                                                {{$group->semester->code}}
                                            </td>
                                            <td>
                                                <a href="{{URL('admin/group/subject/'.$group->id.'')}}">
                                                    Xem danh sách
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
                        <a href="{{ URL('admin/group/branch/'.$id.'/year/'.$year.'/semester/'.$semester.'/add') }}" class="btn btn-success" id="btn">Thêm nhóm học phần</a>
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