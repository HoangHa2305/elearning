@extends('admin.layouts.app')
@section('content')
<div class="page-breadcrumb">
            <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Chỉnh sửa môn học</h4>
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
                                    <input type="text" name="code" value="{{$subject->code}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Tên môn học</label>
                                    <input type="text" name="name" value="{{$subject->name}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Khoa phụ trách</label>
                                    <select name="faculty_charge" id="select" class="form-control">
                                        <option>--Chọn khoa phụ trách--</option>
                                        @foreach($faculties as $faculty)
                                        <option value="{{$faculty->id}}" {{$subject->faculty_charge == $faculty->id ? 'selected' : ''}}>{{$faculty->name}}</option>
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
                                            <input type="number" name="credits" value="{{$subject->credits}}" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label class="col-md-12">Khoa</label>
                                            <select name="faculty_id" id="faculty" class="form-control">
                                                @foreach($faculties as $faculty)
                                                @if($faculty->id!=5)
                                                <option value="{{$faculty->id}}" {{$subject->faculty_id == $faculty->id ? 'selected':''}}>{{$faculty->name}}</option>
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
                                                <option value="0" {{$subject->type == 0 ? 'selected' : ''}}>Kiến thức giáo dục đại cương</option>
                                                <option value="1" {{$subject->type == 1 ? 'selected' : ''}}>Kiến thức cơ sở ngành</option>
                                                <option value="2" {{$subject->type == 2 ? 'selected' : ''}}>Kiến thức chuyên ngành</option>
                                                <option value="3" {{$subject->type == 3 ? 'selected' : ''}}>Kiến thức tự chọn</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="branch">
                                    
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Học kỳ</label>
                                    <select name="semester_id" class="form-control">
                                        @foreach($semesters as $semester)
                                        <option value="{{$semester->id}}">{{$semester->code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Mô tả</label>
                                    <input type="text" name="description" value="{{$subject->description}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success">Chỉnh sửa môn học</button>
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

                    $("#select").on('change',function(){
                       var teacher = $(this).val();

                        $.ajax({
                            url:"{{ URL('admin/subject/faculty/teacher') }}",
                            type:"POST",
                            data:{
                                id :teacher
                            },
                            success:function (response) {
                                $("#list").empty();
                                response.forEach(function(item){
                                    $("#list").append(
                                        "<div class='col-md-12'>"
                                            +"<input type='checkbox' name='teacher[]' "+(arr_teacher.includes(item.id) ? "checked" : "")+" value='"+item.id+"'>"
                                            +"<label class='teacher'>"+item.name+"</label>"
                                        +"</div>"
                                    );
                                });
                            }
                        })
                    });
                    $("#year").empty();
                    $("#branch").empty();
                    $("#pre").hide();

                    var branch = <?php echo json_encode($branchs) ?>;
                    var type = <?php echo json_encode($subject->type) ?>;
                    var branch_id = <?php echo json_encode($subject->branch_id) ?>;
                    var faculty_id = <?php echo json_encode($subject->faculty_id) ?>;
                    var yeartrain_id = <?php echo json_encode($subject->yeartrain_id) ?>;
                    var arr_teacher = <?php echo json_encode($subject->teacher) ?>;
                    var faculty_charge = <?php echo json_encode($subject->faculty_charge) ?>;
                    let yeartrain;
                    $.ajax({
                        url:"{{URL('admin/ajax/get/yeartrain')}}/"+faculty_id,
                        type:"GET",
                        success:function(response){
                            if(response.length>0){
                                var yeartrainSelect = $(
                                    "<label class='col-md-12'>Khóa học</label>"
                                    +"<select name='yeartrain_id' id='yeartrain' class='form-control'></select>"
                                )
                                $("#year").append(yeartrainSelect);
                                $("#pre").show();
                                response.forEach(function(item){
                                    $("#year").find("select").append(
                                        "<option value='"+item.id+"' "+(yeartrain_id==item.id?'selected':'')+">"
                                            +item.name
                                        +"</option>"
                                    )
                                })
                            }
                        }
                    });
                    
                    if(yeartrain_id){
                        $.ajax({
                            url:"{{URL('admin/ajax/get/branch')}}/"+yeartrain_id,
                            type:"GET",
                            success:function(response){
                                if(response.length>0){
                                    var branchSelect = $(
                                        "<label class='col-md-12'>Chuyên ngành</label>"
                                        +"<select name='branch_id' class='form-control'></select>"
                                    );
                                    $("#branch").append(branchSelect);
                                    response.forEach(function(item){
                                        $("#branch").find("select").append(
                                            "<option value='"+item.id+"' "+(branch_id==item.id?'selected':'')+">"
                                                +item.name
                                            +"</option>"
                                        )
                                    })
                                }
                            }
                        });
                    }

                    $("#faculty").on('change',function(){
                        var faculty_new = $(this).val();
                        $("#year").empty();

                        $.ajax({
                            url:"{{URL('admin/ajax/post/yeartrain')}}",
                            type:"POST",
                            data:{
                                id: faculty_new
                            },
                            success:function(response){
                                var yeartrainSelect = $(
                                    "<label class='col-md-12'>Khóa học</label>"
                                    +"<select name='yeartrain_id' id='yeartrain' class='form-control'></select>"
                                    )
                                $("#year").append(yeartrainSelect);
                                response.forEach(function(item){
                                    $("#year").find("select").append("<option value='"+item.id+"'>"+item.name+"</option>")
                                })
                            }
                        });
                    });

                    $("#type").on('change',function(){
                            $("#branch").empty();
                            var id = $("#yeartrain").val();
                            $.ajax({
                                url:"{{URL('admin/ajax/post/branch')}}",
                                type:"POST",
                                data:{
                                    id:id
                                },
                                success:function(response){
                                    if(response.length>0){
                                        var branch = $(
                                            "<label class='col-md-12'>Chuyên ngành</label>"
                                            +"<select name='branch_id' class='form-control'></select>"
                                        );
                                        $("#branch").append(branch);
                                        response.forEach(function(item){
                                            $("#branch").find("select").append("<option value='"+item.id+"'>"+item.name+"</option>")
                                        })
                                    }
                                }
                            });
                    });

                    $.ajax({
                        url:"{{URL('admin/subject/teacher')}}/"+faculty_charge,
                        type:"GET",
                        success:function (response) {
                            response.forEach(function(item){
                                $("#list").append(
                                    "<div class='col-md-12'>"
                                        +"<input type='checkbox' name='teacher[]' "+(arr_teacher.includes(item.id) ? "checked" : "")+" value='"+item.id+"'>"
                                        +"<label class='teacher'>"+item.name+"</label>"
                                    +"</div>"
                                );
                            });
                        }
                    });
                });
            </script>
@endsection
                                        
                                        
                                        
                                    