@extends('admin.layouts.app')
@section('content')
<div class="page-breadcrumb">
            <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Thêm lớp học phần</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Lớp học phần</li>
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
                                            <label class="col-md-12">Mã lớp học phần</label>
                                            <input type="text" name="code" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label class="col-md-12">Tên lớp học phần</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                    </div>  
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12">Học kỳ</label>
                                            <select id="semester" class="form-control">
                                                <option>--Chọn học kỳ--</option>
                                                @foreach($semesters as $semester)
                                                <option value="{{$semester->id}}">{{$semester->code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col" id="subject">
                                            
                                        </div>
                                    </div>  
                                </div>
                                <div class="form-group" id="teacher">

                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12">Khoa</label>
                                            <select id="select" class="form-control">
                                                <option>--Chọn khoa--</option>
                                                @foreach($faculties as $faculty)
                                                <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col" id="yeartrain">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col" id="branch">
                                            
                                        </div>
                                        <div class="col" id="group">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12">Phòng học</label>
                                            <input type="text" name="room" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label class="col-md-12">Số lượng sinh viên</label>
                                            <input type="text" name="count" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12">Tuần học</label>
                                            <input type="text" name="week" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label class="col-md-12">Trạng thái</label>
                                            <select name="active" class="form-control">
                                                <option value="1">Mở</option>
                                                <option value="0">Đóng</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Thời gian giảng dạy</label>
                                    <table class="table table-striped">
                                        <tr>
                                            <td></td>
                                            <td>Thứ 2</td>
                                            <td>Thứ 3</td>
                                            <td>Thứ 4</td>
                                            <td>Thứ 5</td>
                                            <td>Thứ 6</td>
                                            <td>Thứ 7</td>
                                            <td>Chủ nhật</td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 1</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="1">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="1">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="1">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="1">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="1">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="1">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="1">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 2</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="2">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="2">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="2">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="2">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="2">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="2">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 3</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="3">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="3">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="3">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="3">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="3">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="3">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="3">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 4</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="4">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="4">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="4">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="4">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="4">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="4">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="4">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 5</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="5">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="5">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="5">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="5">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="5">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="5">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 6</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="6">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="6">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="6">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="6">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="6">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="6">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="6">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 7</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="7">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="7">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="7">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="7">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="7">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="7">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="7">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 8</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="8">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="8">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="8">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="8">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="8">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="8">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="8">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 9</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="9">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="9">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="9">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="9">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="9">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="9">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="9">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 10</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="10">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="10">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="10">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="10">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="10">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="10">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="10">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success">Thêm lớp học phần</button>
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
                    let id;

                    $("#semester").on('change',function(){
                        var semester_id = $(this).val();
                        id = semester_id;
                        
                        $.ajax({
                            url:"{{URL('admin/ajax/post/subject')}}",
                            type:"POST",
                            data:{
                                id:semester_id
                            },
                            success:function(response){
                                if(response.length>0){
                                    $("#subject").empty();
                                    var subjectSelect = $(
                                        "<label class='col-md-12'>Môn học</label>"
                                        +"<select name='id_subject' id='id_subject' class='form-control'>"
                                            +"<option>--Chọn môn học--</option>"
                                        +"</select>"
                                    )
                                    $("#subject").append(subjectSelect);
                                    response.forEach(function(item){
                                        $("#subject").find("select").append("<option value='"+item.id+"'>"+item.name+"</option>")
                                    });
                                }
                            }
                        });
                    });

                    $("#subject").on('change','#id_subject',function(){
                        var subject_id = $(this).val();

                        $.ajax({
                            url:"{{URL('admin/ajax/post/one/subject')}}",
                            type:"POST",
                            data:{
                                id:subject_id
                            },
                            success:function(response){
                                var teacher_id = response.teacher;
                                $.ajax({
                                    url:"{{URL('admin/ajax/post/teacher')}}",
                                    type:"POST",
                                    data:{
                                        id:teacher_id
                                    },
                                    success:function(response){
                                        $("#teacher").empty();
                                        var teacher = $(
                                            "<label class='col-md-12'>Giảng viên giảng dạy</label>"
                                            +"<select name='id_teacher' class='form-control'></select>"
                                        );
                                        $("#teacher").append(teacher);
                                        response.forEach(function(item){
                                            $("#teacher").find("select").append("<option value='"+item.id+"'>"+item.name+"</option>")
                                        })
                                    }
                                });
                            }
                        });
                    });

                    $("#select").on('change',function(){
                        $("#yeartrain").empty();
                        var faculty_id = $(this).val();

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
                                        +"<select id='year' class='form-control'>"
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
                                        +"<select id='branch_id' class='form-control'>"
                                            +"<option>--Chọn ngành--</option>"
                                        +"</select>"
                                    );
                                    $("#branch").append(branchSelect);
                                    response.forEach(function(item){
                                        $("#branch").find('select').append("<option value='"+item.id+"'>"+item.name+"</option>");
                                    })
                                }
                            }
                        })
                    });

                    $("#branch").on('change','#branch_id',function(){
                        var branch_id = $(this).val();
                        $("#group").empty();
                        $.ajax({
                            url:"{{ URL('admin/ajax/post/group') }}",
                            type:"POST",
                            data:{
                                id_branch:branch_id,
                                id_semester:id
                            },
                            success:function(response){
                                if(response.length>0){
                                    var groupSelect = $(
                                        "<label class='col-md-12'>Nhóm học phần</label>"
                                        +"<select name='id_group' class='form-control'></select>"
                                    );
                                    $("#group").append(groupSelect);
                                    response.forEach(function(item){
                                        $("#group").find('select').append("<option value='"+item.id+"'>"+item.name+"</option>");
                                    })
                                }
                            }
                        })
                    });
                });
            </script>
@endsection
                                            
                                        
                                        
                                        
                                    