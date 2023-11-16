@extends('admin.layouts.app')
@section('content')
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Thêm lớp sinh hoạt</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Lớp sinh hoạt</li>
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
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12">Mã lớp sinh hoạt</label>
                                            <input type="text" name="code" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label class="col-md-12">Tên lớp sinh hoạt</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12">Khoa</label>
                                            <select name="faculty_id" id="select" class="form-control">
                                                @foreach($faculties as $faculty)
                                                <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col" id="teacher">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col" id="yeartrain">

                                        </div>
                                        <div class="col" id="branch">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="col-md-12">Số lượng sinh viên</label>
                                        <input type="text" name="count" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success">Thêm lớp sinh hoạt</button>
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

                    $("#select").on('change',function(){
                        $("#teacher").empty();
                        $("#yeartrain").empty();
                        var faculty_id = $(this).val();
                        $.ajax({
                            url:"{{ URL('admin/class/post/teacher') }}",
                            type:"POST",
                            data:{
                                id: faculty_id
                            },
                            success:function(response){
                                if(response.length>0){
                                    var teacherSelect = $(
                                        "<label class='col-md-12'>Giảng viên chủ nhiệm</label>"
                                        +"<select name='teacher_id' class='form-control'></select>"
                                    );
                                    $("#teacher").append(teacherSelect);
                                    response.forEach(function(item){
                                        $("#teacher").find('select').append("<option value='"+item.id+"'>"+item.name+"</option>");
                                    });
                                }
                            }
                        });

                        $.ajax({
                            url:"{{ URL('admin/class/post/yeartrain') }}",
                            type:"POST",
                            data:{
                                id:faculty_id
                            },
                            success:function(response){
                               if(response.length>0){
                                    var yearTrainSelect = $(
                                        "<label class='col-md-12'>Niên khóa</label>"
                                        +"<select name='yeartrain_id' id='year' class='form-control'>"
                                            +"<option>Chọn niên khóa</option>"
                                        +"</select>"
                                    );
                                    $("#yeartrain").append(yearTrainSelect);
                                    response.forEach(function(item){
                                        $("#yeartrain").find('select').append("<option value='"+item.id+"'>"+item.name+"</option>");
                                    });
                               }
                            }
                        });
                    });
                    $("#yeartrain").on('change','#year',function(){
                        var yeartrain_id = $(this).val();
                        $("#branch").empty();
                        $.ajax({
                            url:"{{ URL('admin/class/post/branch') }}",
                            type:"POST",
                            data:{
                                id:yeartrain_id
                            },
                            success:function(response){
                                if(response.length>0){
                                    var branchSelect = $(
                                        "<label class='col-md-12'>Ngành</label>"
                                        +"<select name='branch_id' class='form-control'></select>"
                                    );
                                    $("#branch").append(branchSelect);
                                    response.forEach(function(item){
                                        $("#branch").find('select').append("<option value='"+item.id+"'>"+item.name+"</option>");
                                    })
                                }
                            }
                        })
                    });
                });
            </script>
@endsection