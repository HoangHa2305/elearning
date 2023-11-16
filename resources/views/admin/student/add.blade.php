@extends('admin.layouts.app')
@section('content')
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Thêm sinh viên</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Sinh viên</li>
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
                                    <label class="col-md-12">Mã sinh viên<span class="text-danger">(*)</span></label>
                                    <input type="text" name="code" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Họ và tên sinh viên</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12">Ngày sinh</label>
                                            <input type="date" name="birth" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label class="col-md-12">Quê quán</label>
                                            <input type="text" name="country" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12">Giới tính</label>
                                            <select name="sex" class="form-control">
                                                <option value="0">Nam</option>
                                                <option value="1">Nữ</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="col-md-12">Số CCCD</label>
                                            <input type="text" name="citizen" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12">Dân tộc</label>
                                            <input type="text" name="nation" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label class="col-md-12">Tôn giáo</label>
                                            <input type="text" name="religion" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12">Số điện thoại</label>
                                            <input type="text" name="phone" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label class="col-md-12">Địa chỉ liên lạc</label>
                                            <input type="text" name="address" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12" for="union">Đoàn thể</label>
                                            <input type="checkbox" name="union" id="union" value="1" class="form-control">
                                        </div>
                                        <div class="col" id="date">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12">Khoa</label>
                                            <select name="faculty_id" id="select" class="form-control">
                                                <option>--Chọn khoa--</option>
                                                @foreach($faculties as $faculty)
                                                @if($faculty->id!=5)
                                                <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col" id="year">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col" id="branch">
                                            
                                        </div>
                                        <div class="col" id="class">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12">Chứng chỉ Thể chất</label>
                                            <select name="physical" class="form-control">
                                                <option value="0">Không</option>
                                                <option value="1">Có</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="col-md-12">Chứng chỉ Quốc phòng</label>
                                            <select name="defense" class="form-control">
                                                <option value="0">Không</option>
                                                <option value="1">Có</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="col-md-12">Chứng chỉ Ngoại ngữ</label>
                                            <select name="english" class="form-control">
                                                <option value="0">Không</option>
                                                <option value="1">Có</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Email</label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Ảnh đại diện</label>
                                    <input type="file" name="avatar" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Mật khẩu</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Xác nhận mật khẩu</label>
                                    <input type="password" name="confim_password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success">Thêm sinh viên</button>
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
            <script>
                $(document).ready(function(){
                    $.ajaxSetup({ 
                        headers: { 
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                        } 
                    });

                    $("#date").empty();
                    $("#union").on('click',function(){
                        if($("#union").is(':checked')){
                            $("#date").show();
                            $("#date").append(
                                "<label class='col-md-12'>Ngày kết nạp</label>"
                                +"<input type='date' name='date_admission' class='form-control'>"
                            )
                        }else{
                            $("#date").empty();
                        }
                    });

                    $("#select").on('change',function(){
                        $("#year").empty();
                        var faculty_id = $(this).val();
                        $.ajax({
                            url:"{{ URL('admin/ajax/post/yeartrain') }}",
                            type:"POST",
                            data:{
                                id: faculty_id
                            },
                            success:function(response){
                                if(response.length>0){
                                    var yearTrainSelect = $(
                                        "<label class='col-md-12'>Niên khoá</label>"
                                        +"<select name='yeartrain_id' id='yeartrain' class='form-control'>"
                                            +"<option>--Chọn niên khóa--</option>"
                                        +"</select>"
                                    );
                                    $("#year").append(yearTrainSelect);
                                    response.forEach(function(item){
                                        $("#year").find("select").append("<option value='"+item.id+"'>"+item.name+"</option>")
                                    })
                                }
                            }
                        });
                    });
                    
                    $("#year").on('change','#yeartrain',function(){
                        $("#branch").empty();
                        var yeartrain_id = $(this).val();
                        $.ajax({
                            url:"{{ URL('admin/ajax/post/branch') }}",
                            type:"POST",
                            data:{
                                id: yeartrain_id
                            },
                            success:function(response){
                                if(response.length>0){
                                    var branchSelect = $(
                                        "<label class='col-md-12'>Ngành</label>"
                                        +"<select name='branch_id' id='branch_id' class='form-control'>"
                                            +"<option>--Chọn ngành--</option>"
                                        +"</select>"
                                    )
                                    $("#branch").append(branchSelect);
                                    response.forEach(function(item){
                                        $("#branch").find("select").append("<option value='"+item.id+"'>"+item.name+"</option>");
                                    });
                                }
                            }
                        })
                    });

                    $("#branch").on('change','#branch_id',function(){
                        $("#class").empty();
                        var class_id = $(this).val();
                        $.ajax({
                            url:"{{ URL('admin/ajax/post/class') }}",
                            type:"POST",
                            data:{
                                id:class_id
                            },
                            success:function(response){
                                if(response.length>0){
                                    var classSelect = $(
                                        "<label class='col-md-12'>Lớp</label>"
                                        +"<select name='class_id' class='form-control'>"
                                            +"<option>--Chọn lớp--</option>"
                                        +"</select>"
                                    )
                                    $("#class").append(classSelect);
                                    response.forEach(function(item){
                                        $("#class").find("select").append("<option value='"+item.id+"'>"+item.code+"</option>");
                                    })
                                }
                            }
                        })
                    });
                });
            </script>
@endsection
                                         