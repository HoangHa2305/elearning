@extends('admin.layouts.app')
@section('content')
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Thêm nhóm đồ án</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{URL('admin/faculty')}}">Khoa</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{URL('admin/faculty/detail/')}}">Ngành đào tạo</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Thêm nhóm đồ án</li>
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
                                    <label class="col-md-12">Tên nhóm đồ án</label>
                                    <input type="text" name="name" class="form-control">
                                    <input type="hidden" name="branch_id" value="{{$branch}}"/>
                                    <input type="hidden" name="semester_id" value="{{$semester}}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Giảng viên hướng dẫn</label>
                                    <select name="id_teacher" class="form-control">
                                        @foreach($teachers as $teacher)
                                        <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success">Thêm ngành đào tạo</button>
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

                    // var id = $("#select option:eq(0)").val();
                    // $.ajax({
                    //     url:"{{URL('admin/branch/get/year-train')}}/"+id,
                    //     type:"GET",
                    //     success:function(response){
                    //         if(response.length>0){
                    //             var newSelect = $("<select name='yeartrain_id' class='form-control'></select>");
                    //             $("#label").append(newSelect);
                    //             response.forEach(function(item){
                    //                 newSelect.append("<option value='"+item.id+"'>"+item.name+"</option>");
                    //             })  
                    //         }
                    //     }
                    // })

                    // $("#select").on('change',function(){
                    //     var faculty = $(this).val();
                    //     $("#label").empty();
                    //     $.ajax({
                    //         url:"{{URL('admin/branch/post/year-train')}}",
                    //         type:"POST",
                    //         data:{
                    //             id: faculty
                    //         },
                    //         success:function(response){
                    //             if(response.length>0){
                    //                 var newSelect = $("<select name='yeartrain_id' class='form-control'></select>");
                    //                 $("#label").append(newSelect);
                    //                 response.forEach(function(item){
                    //                     newSelect.append("<option value='"+item.id+"'>"+item.name+"</option>");
                    //                 })  
                    //             }
                    //         }
                    //     })
                    // });
                })
            </script>
@endsection