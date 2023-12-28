@extends('admin.layouts.app')
@section('content')
<div class="page-breadcrumb">
            <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Thêm thông báo</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Thông báo</li>
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
                <div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
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
                                    <label class="col-md-12">Tiêu đề</label>
                                    <input type="text" name="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Nội dung</label>
                                    <textarea id="demo" name="desc" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Tệp kính đèm</label>
                                    <input type="file" name="zip" accept=".doc, .docx" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Thông báo từ</label>
                                    <select id="semester" name="id_type" class="form-control">
                                        <option value="1">Phòng đào tạo</option>
                                        <option value="2">Kế hoạch Tài chính</option>
                                        <option value="3">Phòng Khảo thí và Đảm bảo chất lượng</option>
                                        <option value="4">Công tác sinh viên</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success">Thêm thông báo</button>
                                    </div>
                                </div>
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
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
            <style>
                .teacher {
                    padding-left: 10px;
                    padding-top: 10px;
                }
            </style>
@endsection                                                    