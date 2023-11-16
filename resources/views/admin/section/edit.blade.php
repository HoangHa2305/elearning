@extends('admin.layouts.app')
@section('content')
<div class="page-breadcrumb">
            <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Chỉnh sửa lớp học phần</h4>
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
                                            <input type="text" name="code" value="{{$section->code}}" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label class="col-md-12">Tên lớp học phần</label>
                                            <input type="text" name="name" value="{{$section->name}}" class="form-control">
                                        </div>
                                    </div>  
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12">Học kỳ</label>
                                            <select id="semester" class="form-control">
                                                @foreach($semesters as $semester)
                                                <option value="{{$semester->id}}" {{$section->subject->semester_id == $semester->id ? 'selected' : ''}}>{{$semester->code}}</option>
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
                                                @foreach($faculties as $faculty)
                                                <option value="{{$faculty->id}}" {{$section->subject->faculty_id==$faculty->id ? 'selected':''}}>{{$faculty->name}}</option>
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
                                            <input type="text" name="room" value="{{$section->room}}" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label class="col-md-12">Số lượng sinh viên</label>
                                            <input type="text" name="count" value="{{$section->count}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-md-12">Tuần học</label>
                                            <input type="text" name="week" value="{{$section->week}}" class="form-control">
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
                                                <input type="checkbox" name="monday[]" value="1" @if(isset($section->monday)) @if(in_array(1,json_decode($section->monday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="1" @if(isset($section->tuesday)) @if(in_array(1,json_decode($section->tuesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="1" @if(isset($section->wednesday)) @if(in_array(1,json_decode($section->wednesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="1" @if(isset($section->thursday)) @if(in_array(1,json_decode($section->thursday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="1" @if(isset($section->friday)) @if(in_array(1,json_decode($section->friday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="1" @if(isset($section->saturday)) @if(in_array(1,json_decode($section->saturday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="1" @if(isset($section->sunday)) @if(in_array(1,json_decode($section->sunday))) checked  @endif @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 2</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="2" @if(isset($section->monday)) @if(in_array(2,json_decode($section->monday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="2" @if(isset($section->tuesday)) @if(in_array(2,json_decode($section->tuesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="2" @if(isset($section->wednesday)) @if(in_array(2,json_decode($section->wednesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="2" @if(isset($section->thursday)) @if(in_array(2,json_decode($section->thursday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="2" @if(isset($section->friday)) @if(in_array(2,json_decode($section->friday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="2" @if(isset($section->saturday)) @if(in_array(2,json_decode($section->saturday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="2" @if(isset($section->sunday)) @if(in_array(2,json_decode($section->sunday))) checked  @endif @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 3</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="3" @if(isset($section->monday)) @if(in_array(3,json_decode($section->monday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="3" @if(isset($section->tuesday)) @if(in_array(3,json_decode($section->tuesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="3" @if(isset($section->wednesday)) @if(in_array(3,json_decode($section->wednesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="3" @if(isset($section->thursday)) @if(in_array(3,json_decode($section->thursday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="3" @if(isset($section->friday)) @if(in_array(3,json_decode($section->friday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="3" @if(isset($section->saturday)) @if(in_array(3,json_decode($section->saturday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="3" @if(isset($section->sunday)) @if(in_array(3,json_decode($section->sunday))) checked  @endif @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 4</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="4" @if(isset($section->monday)) @if(in_array(4,json_decode($section->monday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="4" @if(isset($section->tuesday)) @if(in_array(4,json_decode($section->tuesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="4" @if(isset($section->wednesday)) @if(in_array(4,json_decode($section->wednesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="4" @if(isset($section->thursday)) @if(in_array(4,json_decode($section->thursday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="4" @if(isset($section->friday)) @if(in_array(4,json_decode($section->friday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="4" @if(isset($section->saturday)) @if(in_array(4,json_decode($section->saturday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="4" @if(isset($section->sunday)) @if(in_array(4,json_decode($section->sunday))) checked  @endif @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 5</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="5" @if(isset($section->monday)) @if(in_array(5,json_decode($section->monday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="5" @if(isset($section->tuesday)) @if(in_array(5,json_decode($section->tuesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="5" @if(isset($section->wednesday)) @if(in_array(5,json_decode($section->wednesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="5" @if(isset($section->thursday)) @if(in_array(5,json_decode($section->thursday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="5" @if(isset($section->friday)) @if(in_array(5,json_decode($section->friday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="5" @if(isset($section->saturday)) @if(in_array(5,json_decode($section->saturday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="5" @if(isset($section->sunday)) @if(in_array(5,json_decode($section->sunday))) checked  @endif @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 6</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="6" @if(isset($section->monday)) @if(in_array(6,json_decode($section->monday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="6" @if(isset($section->tuesday)) @if(in_array(6,json_decode($section->tuesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="6" @if(isset($section->wednesday)) @if(in_array(6,json_decode($section->wednesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="6" @if(isset($section->thursday)) @if(in_array(6,json_decode($section->thursday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="6" @if(isset($section->friday)) @if(in_array(6,json_decode($section->friday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="6" @if(isset($section->saturday)) @if(in_array(6,json_decode($section->saturday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="6" @if(isset($section->sunday)) @if(in_array(6,json_decode($section->sunday))) checked  @endif @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 7</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="7" @if(isset($section->monday)) @if(in_array(7,json_decode($section->monday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="7" @if(isset($section->tuesday)) @if(in_array(7,json_decode($section->tuesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="7" @if(isset($section->wednesday)) @if(in_array(7,json_decode($section->wednesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="7" @if(isset($section->thursday)) @if(in_array(7,json_decode($section->thursday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="7" @if(isset($section->friday)) @if(in_array(7,json_decode($section->friday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="7" @if(isset($section->saturday)) @if(in_array(7,json_decode($section->saturday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="7" @if(isset($section->sunday)) @if(in_array(7,json_decode($section->sunday))) checked  @endif @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 8</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="8" @if(isset($section->monday)) @if(in_array(8,json_decode($section->monday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="8" @if(isset($section->tuesday)) @if(in_array(8,json_decode($section->tuesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="8" @if(isset($section->wednesday)) @if(in_array(8,json_decode($section->wednesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="8" @if(isset($section->thursday)) @if(in_array(8,json_decode($section->thursday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="8" @if(isset($section->friday)) @if(in_array(8,json_decode($section->friday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="8" @if(isset($section->saturday)) @if(in_array(8,json_decode($section->saturday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="8" @if(isset($section->sunday)) @if(in_array(8,json_decode($section->sunday))) checked  @endif @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 9</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="9" @if(isset($section->monday)) @if(in_array(9,json_decode($section->monday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="9" @if(isset($section->tuesday)) @if(in_array(9,json_decode($section->tuesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="9" @if(isset($section->wednesday)) @if(in_array(9,json_decode($section->wednesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="9" @if(isset($section->thursday)) @if(in_array(9,json_decode($section->thursday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="9" @if(isset($section->friday)) @if(in_array(9,json_decode($section->friday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="9" @if(isset($section->saturday)) @if(in_array(9,json_decode($section->saturday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="9" @if(isset($section->sunday)) @if(in_array(9,json_decode($section->sunday))) checked  @endif @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiết 10</td>
                                            <td>
                                                <input type="checkbox" name="monday[]" value="10" @if(isset($section->monday)) @if(in_array(10,json_decode($section->monday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="tuesday[]" value="10" @if(isset($section->tuesday)) @if(in_array(10,json_decode($section->tuesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="wednesday[]" value="10" @if(isset($section->wednesday)) @if(in_array(10,json_decode($section->wednesday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="thursday[]" value="10" @if(isset($section->thursday)) @if(in_array(10,json_decode($section->thursday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="friday[]" value="10" @if(isset($section->friday)) @if(in_array(10,json_decode($section->friday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="saturday[]" value="10" @if(isset($section->saturday)) @if(in_array(10,json_decode($section->saturday))) checked  @endif @endif>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sunday[]" value="10" @if(isset($section->sunday)) @if(in_array(10,json_decode($section->sunday))) checked  @endif @endif>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success">Chỉnh sửa lớp học phần</button>
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

                    var id = <?php echo json_encode($section->id_subject) ?>;
                    var teacher_id = <?php echo json_encode($section->id_teacher) ?>;
                    var semester_id = <?php echo json_encode($section->subject->semester_id ) ?>;
                    var faculty_id = <?php echo json_encode($section->subject->faculty_id) ?>;
                    var yeartrain_id = <?php echo json_encode($section->subject->yeartrain_id) ?>;
                    var branch_id = <?php echo json_encode($section->subject->branch_id) ?>;
                    var group_id = <?php echo json_encode($section->id_group) ?>;
                    $.ajax({
                        url:"{{URL('admin/ajax/get/subject')}}/"+id,
                        type:"GET",
                        success:function(response){
                            if(response.length>0){
                                $("#subject").empty();
                                var newSubject = $(
                                    "<label class='col-md-12'>Môn học</label>"
                                    +"<select name='id_subject' id='id_subject' class='form-control'></select>"
                                );
                                $("#subject").append(newSubject);
                                response.forEach(function(item){
                                    $("#subject").find("select").append(
                                        "<option value='"+item.id+"' "+(id==item.id ? 'selected':'')+">"
                                            +item.name
                                        +"</option>")
                                });
                                var xx = $("#id_subject").val();
                                $.ajax({
                                    url:"{{URL('admin/ajax/get/teacher')}}/"+xx,
                                    type:"GET",
                                    success:function(response){
                                        if(response.length>0){
                                            $("#teacher").empty();
                                            var newTeacher = $(
                                                "<label class='col-md-12'>Giảng viên giảng dạy</label>"
                                                +"<select name='id_teacher' class='form-control'></select>"
                                            );
                                            $("#teacher").append(newTeacher);
                                            response.forEach(function(item){
                                                $("#teacher").find("select").append(
                                                    "<option value='"+item.id+"' "+(teacher_id==item.id?'selected':'')+">"
                                                        +item.name
                                                    +"</option>")
                                            })
                                        }
                                    }
                                })
                            }
                        }
                    });

                    $.ajax({
                        url:"{{URL('admin/ajax/get/yeartrain')}}/"+faculty_id,
                        type:"GET",
                        success:function(response){
                            if(response.length>0){
                                var yeartrainSelect = $(
                                    "<label class='col-md-12'>Khóa học</label>"
                                    +"<select id='yeartrain_id' class='form-control'></select>"
                                )
                                $("#yeartrain").append(yeartrainSelect);
                                response.forEach(function(item){
                                    $("#yeartrain").find("select").append(
                                        "<option value='"+item.id+"' "+(yeartrain_id==item.id?'selected':'')+">"
                                            +item.name
                                        +"</option>"
                                    )
                                })
                            }
                        }
                    });

                    $.ajax({
                        url:"{{URL('admin/ajax/get/branch')}}/"+yeartrain_id,
                        type:"GET",
                        success:function(response){
                            if(response.length>0){
                                var branchSelect = $(
                                    "<label class='col-md-12'>Chuyên ngành</label>"
                                    +"<select id='branch_id' class='form-control'></select>"
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

                    $.ajax({
                        url:"{{URL('admin/ajax/get/branch')}}/"+branch_id+"/semester/"+semester_id,
                        type:"GET",
                        success:function(response){
                            if(response.length>0){
                                var groupSelect = $(
                                        "<label class='col-md-12'>Nhóm học phần</label>"
                                        +"<select name='id_group' class='form-control'></select>"
                                    );
                                    $("#group").append(groupSelect);
                                    response.forEach(function(item){
                                        $("#group").find('select').append(
                                            "<option value='"+item.id+"' "+(group_id == item.id ? 'selected':'')+">"
                                                +item.name
                                            +"</option>");
                                    })
                            }
                        }
                    })

                    $("#semester").on('change',function(){
                        var semester_id = $(this).val();
                        
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
                                id_semester:semester_id
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
                                            
                                        
                                        
                                        
                                    