@extends('admin.layouts.app')
@section('content')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Chỉnh sửa giảng viên</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Giảng viên</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="{{asset('uploads/teacher/'.$teacher->avatar.'')}}" class="rounded-circle" width="150" />
                                    <h4 class="card-title m-t-10">{{$teacher->name}}</h4>
                                    <h6 class="card-subtitle">{{$teacher->level}}</h6>
                                    <h6 class="card-subtitle">{{$teacher->faculty->name}}</h6>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Email</small>
                                <h6>{{$teacher->email}}</h6> <small class="text-muted p-t-30 db">Điện thoại</small>
                                <h6>0{{$teacher->phone}}</h6> <small class="text-muted p-t-30 db">Địa chỉ</small>
                                <h6>{{$teacher->address}}</h6>
                                <br/>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" action="" method="POST" enctype="multipart/form-data">
                                    @if(session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                        {{session('success')}}
                                    </div>
                                    @endif
                                    @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="col-md-12">Tên giảng viên</label>
                                        <div class="col-md-12">
                                            <input type="text" name="name" value="{{$teacher->name}}" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">                         
                                                <div class="col-md-12">
                                                    <label>Ngày sinh</label>
                                                    <input type="date" value="{{$teacher->birth}}" name="birth" class="form-control form-control-line" id="example-email">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="col-md-12">
                                                    <label>Quê quán</label>
                                                    <input type="text" value="{{$teacher->country}}" name="country" class="form-control form-control-line" id="example-email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">                         
                                                <div class="col-md-12">
                                                    <label>Trình độ</label>
                                                    <input type="text" value="{{$teacher->level}}" name="level" class="form-control form-control-line" id="example-email">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="col-md-12">
                                                    <label>Email</label>
                                                    <input type="text" value="{{$teacher->email}}" name="email" class="form-control form-control-line" id="example-email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">                         
                                                <div class="col-md-12">
                                                    <label>Khoa</label>
                                                    <select name="faculty_id" class="form-control form-control-line" id="example-email">
                                                        @foreach($faculties as $faculty)
                                                        <option value="{{$faculty->id}}" {{$faculty->id==$teacher->faculty_id ? 'selected' : ''}}>{{$faculty->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="col-md-12">
                                                    <label>Chức danh</label>
                                                    <select name="position" class="form-control form-control-line" id="example-email">
                                                        <option value="0" {{$teacher->position == 0 ? 'selected' : ''}}>Thành viên</option>
                                                        <option value="1" {{$teacher->position == 1 ? 'selected' : ''}}>Phó khoa</option>
                                                        <option value="2" {{$teacher->position == 2 ? 'selected' : ''}}>Trưởng khoa</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">                         
                                                <div class="col-md-12">
                                                    <label>Số điện thoại</label>
                                                    <input type="text" value="0{{$teacher->phone}}" name="phone" class="form-control form-control-line" id="example-email">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="col-md-12">
                                                    <label>Địa chỉ</label>
                                                    <input type="text" value="{{$teacher->address}}" name="address" class="form-control form-control-line" id="example-email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Ảnh đại diện</label>
                                        <div class="col-md-12">
                                            <input type="file" name="avatar" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Mật khẩu mới</label>
                                        <div class="col-md-12">
                                            <input type="password" name="password" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Xác nhận mật khẩu mới</label>
                                        <div class="col-md-12">
                                            <input type="password" name="confim_password" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Cập nhật thông tin giảng viên</button>
                                        </div>
                                    </div>
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Nice admin. Designed and Developed by
                <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
@endsection