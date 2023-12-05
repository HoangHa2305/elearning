@extends('admin.layouts.app')
@section('content')
<div class="page-breadcrumb">
            <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Thêm môn học</h4>
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
                            <form class="form-horizontal" action="" method="post">
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
                                    <label class="col-md-12">Mã môn học</label>
                                    <input type="text" name="code" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Tên môn học</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Khoa phụ trách</label>
                                    <select name="faculty_charge" id="select" class="form-control">
                                        <option>--Chọn khoa phụ trách--</option>
                                        @foreach($faculties as $faculty)
                                        <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Giảng viên giảng dạy</label>
                                    <div id="list"></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12">Số tín chỉ</label>
                                            <input type="number" name="credits" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label class="col-md-12">Khoa</label>
                                            <select name="faculty_id" id="faculty" class="form-control">
                                                <option>---Chọn khoa---</option>
                                                @foreach($faculties as $faculty)
                                                @if($faculty->id!=5)
                                                <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col" id="year">
                                            
                                        </div>
                                        <div class="col" id="pre">
                                            <label class="col-md-12">Loại môn học</label>
                                            <select name="type" id="type" class="form-control">
                                                <option>--Chọn loại môn học--</option>
                                                <option value="0">Kiến thức giáo dục đại cương</option>
                                                <option value="1">Kiến thức cơ sở ngành</option>
                                                <option value="2">Kiến thức chuyên ngành</option>
                                                <option value="3">Kiến thức tự chọn</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="branch">
                                    
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12">Học kỳ</label>
                                            <select name="semester_id" class="form-control">
                                                @foreach($semesters as $semester)
                                                <option value="{{$semester->id}}">{{$semester->code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="col-md-12">Học phần đồ án</label>
                                            <div class="form-check">
                                                <input type="radio" value="1" name="section_project"/>
                                                <label class="form-check-label parent-radio" for="section_project">Có</label>
                                                <br>
                                                <input type="radio" value="0" name="section_project" checked/>
                                                <label class="form-check-label parent-radio" for="section_project">Không</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Mô tả</label>
                                    <input type="text" name="description" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success">Thêm môn học</button>
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
            <script>
                $(document).ready(function(){
                    $.ajaxSetup({ 
                        headers: { 
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                        } 
                    });

                    $("#year").empty();
                    $("#pre").hide();

                    $("#select").on('change',function(){
                        var faculty_charge = $(this).val();

                        $.ajax({
                            url:"{{ URL('admin/subject/faculty/teacher') }}",
                            type:"POST",
                            data:{
                                id :faculty_charge
                            },
                            success:function (response) {
                                $("#list").empty();
                                response.forEach(function(item){
                                    $("#list").append(
                                        "<div class='col-md-12'>"
                                            +"<input type='checkbox' name='teacher[]' value='"+item.id+"'>"
                                            +"<label class='teacher'>"+item.name+"</label>"
                                        +"</div>"
                                    );
                                });
                            }
                        })
                    });

                    $("#faculty").on('change',function(){
                        var faculty_id = $(this).val();
                        
                        $.ajax({
                            url:"{{URL('admin/ajax/post/yeartrain')}}",
                            type:"POST",
                            data:{
                                id:faculty_id
                            },
                            success:function(response){
                                if(response.length>0){
                                    $("#year").empty();
                                    $("#pre").show();
                                    var yeartrainSelect = $(
                                        "<label class='col-md-12'>Khóa học</label>"
                                        +"<select name='yeartrain_id' id='yeartrain' class='form-control'>"
                                            +"<option>---Chọn khóa học---</option>"
                                        +"</select>"
                                    )
                                    $("#year").append(yeartrainSelect);
                                    response.forEach(function(item){
                                        $("#year").find("select").append("<option value='"+item.id+"'>"+item.name+"</option>")
                                    })
                                }
                            }
                        })
                    });

                    $("#type").on('change',function(){
                        var id = $("#yeartrain").val();
                        $.ajax({
                                url:"{{URL('admin/ajax/post/branch')}}",
                                type:"POST",
                                data:{
                                    id:id
                                },
                                success:function(response){
                                    if(response.length>0){
                                        $("#branch").empty();
                                        var branch = $(
                                            "<label class='col-md-12'>Chuyên ngành</label>"
                                            +"<select name='branch_id' class='form-control'>"
                                                +"<option>---Chọn ngành---</option>"
                                            +"</select>"
                                        );
                                        $("#branch").append(branch);
                                        response.forEach(function(item){
                                            $("#branch").find("select").append("<option value='"+item.id+"'>"+item.name+"</option>")
                                        })
                                    }
                                }
                        });
                    });
                });
            </script>
@endsection                                                    