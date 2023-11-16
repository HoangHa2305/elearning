@extends('admin.layouts.app')
@section('content')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Cập nhật thông tin sinh viên</h4>
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
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="{{asset('uploads/student/'.$student->avatar.'')}}" class="rounded-circle" width="150" />
                                    <h4 class="card-title m-t-10">{{$student->name}}</h4>
                                    <h6 class="card-subtitle">
                                        <span class="mdi mdi-lock"></span>MSV {{$student->code}}
                                        <br>
                                        <span class="mdi mdi-lock"></span>Lớp {{$student->activity_class->code}}
                                        <br> 
                                        <span class="mdi mdi-lock"></span>{{$student->get_yeartrain->name}}
                                        <br>
                                        <span class="mdi mdi-lock"></span>Ngành {{$student->get_branch->name}}
                                        <br>
                                        <span class="mdi mdi-lock"></span>{{$student->get_faculty->name}}
                                    </h6>
                                    <h6 class="card-subtitle"></h6>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Email</small>
                                <h6>{{$student->email}}</h6> <small class="text-muted p-t-30 db">Điện thoại</small>
                                <h6>0{{$student->phone}}</h6> <small class="text-muted p-t-30 db">Địa chỉ</small>
                                <h6>{{$student->address}}</h6>
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
                                        <div class="row">
                                            <div class="col">                         
                                                <div class="col-md-12">
                                                    <label>Mã sinh viên</label>
                                                    <input type="text" value="{{$student->code}}" name="code" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="col-md-12">
                                                    <label>Tên sinh viên</label>
                                                    <input type="text" value="{{$student->name}}" name="name" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">                         
                                                <div class="col-md-12">
                                                    <label>Ngày sinh</label>
                                                    <input type="date" value="{{$student->birth}}" name="birth" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="col-md-12">
                                                    <label>Quê quán</label>
                                                    <input type="text" value="{{$student->country}}" name="country" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">                         
                                                <div class="col-md-12">
                                                    <label>Giới tính</label>
                                                    <select name="sex" class="form-control form-control-line">
                                                        <option value="0" {{$student->sex == 0 ? 'selected' : ''}} >Nam</option>
                                                        <option value="1" {{$student->sex == 1 ? 'selected' : ''}} >Nữ</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="col-md-12">
                                                    <label>Số CCCD</label>
                                                    <input type="text" name="citizen" value="{{$student->citizen}}" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">                         
                                                <div class="col-md-12">
                                                    <label>Dân tộc</label>
                                                    <input type="text" value="{{$student->nation}}" name="nation" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="col-md-12">
                                                    <label>Tôn giáo</label>
                                                    <input type="text" value="{{$student->religion}}" name="religion" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">                         
                                                <div class="col-md-12">
                                                    <label>Số điện thoại</label>
                                                    <input type="text" value="0{{$student->phone}}" name="phone" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="col-md-12">
                                                    <label>Địa chỉ</label>
                                                    <input type="text" value="{{$student->address}}" name="address" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">                         
                                                <div class="col-md-12">
                                                    <label>Đoàn thể</label>
                                                    <input type="checkbox" name="union" id="union" value="1" {{$student->union == 1 ? 'checked' : ''}} class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="col-md-12" id="date">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">                         
                                                <div class="col-md-12">
                                                    <label>Khoa</label>
                                                    <select name="faculty_id" id="select" class="form-control form-control-line">
                                                        @foreach($faculties as $faculty)
                                                        @if($faculty->id!=5)
                                                        <option value="{{$faculty->id}}" {{$student->faculty_id == $faculty->id ? 'selected' : '' }}>{{$faculty->name}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">                         
                                                <div class="col-md-12" id="year">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">                         
                                                <div class="col-md-12" id="branch">
                                                    
                                                </div>
                                            </div>
                                            <div class="col">                         
                                                <div class="col-md-12" id="class">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">                         
                                                <div class="col-md-12">
                                                    <label>Chứng chỉ Thể chất</label>
                                                    <select name="physical" class="form-control form-control-line">
                                                        <option value="0" {{$student->physical == 0 ? 'selected' : '' }}>Không</option>
                                                        <option value="1" {{$student->physical == 1 ? 'selected' : '' }}>Có</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">                         
                                                <div class="col-md-12">
                                                    <label>Chứng chỉ Quốc phòng</label>
                                                    <select name="defense" class="form-control form-control-line">
                                                        <option value="0" {{$student->defense == 0 ? 'selected' : '' }}>Không</option>
                                                        <option value="1" {{$student->defense == 1 ? 'selected' : '' }}>Có</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">                         
                                                <div class="col-md-12">
                                                    <label>Chứng chỉ Ngoại ngữ</label>
                                                    <select name="english" class="form-control form-control-line">
                                                        <option value="0" {{$student->english == 0 ? 'selected' : '' }}>Không</option>
                                                        <option value="1" {{$student->english == 1 ? 'selected' : '' }}>Có</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="text" name="email" value="{{$student->email}}" class="form-control form-control-line">
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
                                            <button type="submit" class="btn btn-success">Cập nhật thông tin sinh viên</button>
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
            <script>
                $(document).ready(function(){
                    $.ajaxSetup({ 
                        headers: { 
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                        } 
                    });

                    var faculty_old = <?php echo json_encode($student->faculty_id) ?>;
                    var yeartrain_old = <?php echo json_encode($student->yeartrain_id) ?>;
                    var branch_old = <?php echo json_encode($student->branch_id) ?>;
                    var class_old = <?php echo json_encode($student->class_id) ?>; 
                    var union = <?php echo json_encode($student->union) ?>;
                    var date_admission = <?php echo json_encode($student->date_admission) ?>;
                    if(union){
                        $("#date").show();
                        $("#date").append(
                            "<label class='col-md-12'>Ngày kết nạp</label>"
                            +"<input type='date' name='date_admission' value='"+date_admission+"' class='form-control'>"
                        )
                    }else{
                        $("#date").empty();
                    }

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

                    $.ajax({
                        url:"{{URL('admin/ajax/get/yeartrain')}}/"+faculty_old,
                        type:"GET",
                        success:function(response){
                            if(response.length>0){
                                var yeartrain = $(
                                    "<label>Niên khóa</label>"
                                    +"<select name='yeartrain_id' id='yeartrain' class='form-control'></select>"
                                );
                                $("#year").append(yeartrain)
                            }
                            response.forEach(function(item){
                                $("#year").find("select").append(
                                    "<option value='"+item.id+"' "+(yeartrain_old==item.id ? 'selected' : '')+">"
                                        +item.name
                                    +"</option>")
                            });
                        }
                    });

                    $.ajax({
                        url:"{{URL('admin/ajax/get/branch')}}/"+yeartrain_old,
                        type:"GET",
                        success:function(response){
                            if(response.length>0){
                                var branch = $(
                                    "<label>Ngành</label>"
                                    +"<select name='branch_id' id='branch_id' class='form-control'></select>"
                                )
                            $("#branch").append(branch);
                            response.forEach(function(item){
                                $("#branch").find("select").append(
                                    "<option value='"+item.id+"' "+(branch_old==item.id ? 'selected' : '')+">"
                                        +item.name
                                    +"</option>");
                            });
                            }
                        }
                    });

                    $.ajax({
                        url:"{{URL('admin/ajax/get/class')}}/"+branch_old,
                        type:"GET",
                        success:function(response){
                            if(response.length>0){
                                var class_name = $(
                                    "<label class='col-md-12'>Lớp</label>"
                                    +"<select name='class_id' class='form-control'></select>"
                                )
                                $("#class").append(class_name);
                                response.forEach(function(item){
                                    $("#class").find("select").append(
                                        "<option value='"+item.id+"' "+(class_old==item.id ? 'selected' : '')+">"
                                            +item.code
                                        +"</option>");
                                })
                            }
                        }
                    })

                    $("#select").on('change',function(){
                        var faculty_id = $(this).val();
                        $("#year").empty();
                        $.ajax({
                            url:"{{URL('admin/ajax/post/yeartrain')}}",
                            type:"POST",
                            data:{
                                id: faculty_id
                            },
                            success:function(response){
                                if(response.length>0){
                                    var yearTrainSelect = $(
                                        "<label class='col-md-12'>Niên khoá</label>"
                                        +"<select name='yeartrain_id' id='yeartrain' class='form-control'></select>"
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
                        var branch_id = $(this).val();
                        $("#branch").empty();
                        $.ajax({
                            url:"{{ URL('admin/ajax/post/branch') }}",
                            type:"POST",
                            data:{
                                id: branch_id
                            },
                            success:function(response){
                                if(response.length>0){
                                    var branchSelect = $(
                                        "<label class='col-md-12'>Ngành</label>"
                                        +"<select name='branch_id' id='branch_id' class='form-control'></select>"
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
                        var class_id = $(this).val();
                        $("#class").empty();
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
                                        +"<select name='class_id' class='form-control'></select>"
                                    )
                                    $("#class").append(classSelect);
                                    response.forEach(function(item){
                                        $("#class").find("select").append("<option value='"+item.id+"'>"+item.code+"</option>");
                                    })
                                }
                            }
                        })
                    })
                });
            </script>        
@endsection
