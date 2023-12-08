@extends('frontend.layouts.app')
@section('content')
<!--// Mini Header \\-->
<div class="wm-mini-header">
			<span class="wm-blue-transparent"></span>
			 <div class="container">
			    <div class="row">
				    <div class="col-md-12">
				        <div class="wm-mini-title">
				       		<h1>Quản lí điểm lớp học phần</h1> 
				        </div>
				        <div class="wm-breadcrumb">
				          	<ul>
				          	 	<li><a href="index-2.html">Trang chủ</a></li>
				          	 	<li><a href="#">Giảng viên</a></li>
				           		<li>Quản lí điểm</li>
				          	</ul>
				        </div>      
				    </div>
			    </div>
			</div>    
		</div>
  		<!--// Mini Header \\-->

		<!--// Main Content \\-->
		<div class="wm-main-content">
			<!--// Main Section \\-->
			<div class="wm-main-section">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="wm-plane-title">
								<b class="title">Lớp đồ án <u>{{$group->title}}</u></b>
                                <p>Giảng viên phụ trách: {{$group->teacher->name}}</p>						
							</div>
							<div class="wm-student-dashboard-statement wm-dashboard-statement">
								<table class="wm-article">
									<thead>
										<th>STT</th>
                                        <th>Mã SV</th>
										<th>Tên SV</th>
                                        <th>Lớp SH</th>
										<th>Điểm CC/GVHD</th>
										<th>Điểm bảo vệ</th>
										<th>Điểm T10</th>
										<th>Điểm chữ</th>
									</thead>
									<tbody>
										@php $i = 0; @endphp
                                        @foreach($projects as $project)
                                        @php 
                                            $i++; 
                                            $diligence_score = 0;
                                            $final_score = 0;
                                            if(!empty($project->diligence_score)){
                                                $diligence_score = $project->diligence_score;
                                            }
                                            if(!empty($project->final_score)){
                                                $final_score = $project->final_score;
                                            }
                                            $total_score =  ($diligence_score * 3 + $final_score * 7)/10;                                          
                                        @endphp
                                        <tr id="{{$project->type_id}}">
                                            <td>{{$i}}</td>
                                            <td>{{$project->code}}</td>
                                            <td>{{$project->name}}</td>
                                            <td>{{$project->class}}</td>
                                            <td>
                                                <input type="number" value="{{$project->diligence_score}}" id="input" class="diligence"/>
                                            </td>
                                            <td>
                                                <input type="number" value="{{$project->final_score}}" id="input" class="final"/>
                                            </td>
                                            <td>
                                                <input type="number" value="{{$total_score}}" id="input" class="total" readonly/>
                                            </td>
                                            <td class="score">
                                                @if($total_score >= 8.5)
												<b class="success_score">A</b>
												@elseif($total_score >= 7 && $total_score <= 8.4)
												<b class="primary_score">B</b>
												@elseif($total_score >= 5.5 && $total_score <= 6.9)
												<b class="basic_score">C</b>
												@elseif($total_score >= 4 && $total_score <= 5.4)
												<b class="warning_score">D</b>
												@else
												<b class="danger_score">F</b>
												@endif
                                            </td>
                                            <input type="hidden" id="student_id" value="{{$project->id}}"/>
                                        </tr>
                                        @endforeach
										<tr>
											<td colspan="10">
                                                <form action="#" method="POST">
                                                    <input type="hidden" name="section_id" value=""/>
                                                    <button type="submit" class="wm-register">Xác nhận</button>
                                                </form>
											</td>
										</tr>
										@csrf
									</tbody>
								</table>							
						</div>
					</div>
				</div>
			</div>
			<!--// Main Section \\-->
		</div>
		<div id="show"></div>
		<!--// Main Content \\-->
		<style>
			#box{
				display: flex;
			}
			.flex{
				margin-left: 38%;
			}
			#input{
				width: 50px;
				text-align: center;
			}
			.absent{
				display: flex;
			}
			span {
				color: #f0ad4e;
			}
			#p{
				margin-left: 20px;
			}
			.success_score{
				color: #008000;
			}
			.danger_score{
				color: red;
			}
			.primary_score{
				color: blue;
			}
			.basic_score{
				color: #73879C;
			}
			.warning_score{
				color: orange;
			}
			.wmicon-tool{
				color: #6c8391;
				font-size: 12px;
			}
			.note{
				color: #6c8391;
				font-size: 14px;
			}
			.wm-register{
				background-color: #26B99A;
				color: #fff;
				padding-left: 25px;
				padding-right: 25px;
				border: none;
				border-radius: 4px;
				font-size: 14px;
				cursor: pointer;
				transition: background-color 0.3s ease;
				width: 120px;
			}
			.submit-all{
				background-color: #26B99A;
				color: #fff;
				border: none;
				padding: 10px 10px 10px 10px;
				border-radius: 4px;
				font-size: 14px;
				cursor: pointer;
				transition: background-color 0.3s ease;
			}
			td{
				text-align: left;
				padding-top: 10px;
				padding-bottom: 30px;
			}
			.textarea{
				width: 120px;
			}
			#note{
				text-align: left;
			}
			#content{
				background-color: white;
				border: 1px solid black;
			}
			#submit{
				padding-top: 8px;
				padding-bottom: 8px;
				margin-top: 20px;
			}
			#center{
				text-align: center;
				align-items: center;
			}
			.wm-cancel{
				background-color: #f0ad4e;
				color: #fff;
				padding-left: 25px;
				padding-right: 25px;
				border: none;
				border-radius: 4px;
				font-size: 14px;
				cursor: pointer;
				width: 120px;
				transition: background-color 0.3s ease;
			}
			.vm-danger{
				background-color: #d9534f;
				color: #fff;
				padding-left: 25px;
				padding-right: 25px;
				border: none;
				border-radius: 4px;
				font-size: 14px;
				cursor: pointer;
				width: 120px;
				transition: background-color 0.3s ease;
			}
			.vm-primary{
				background-color: #286090;
				color: #fff;
				padding-left: 25px;
				padding-right: 25px;
				border: none;
				border-radius: 4px;
				font-size: 14px;
				cursor: pointer;
				width: 120px;
				transition: background-color 0.3s ease;
			}

			thead {
				background-color: #73879C;
				color: white;
				font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
			}
			#header{
				background-color: white;
				color: rgba(52,73,94,.94);
				font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
			}
			.title{
				font-family: Roboto, sans-serif;
				font-weight: bold;
                font-size: 14px;
			}

			.custom-alert {
				display: none;
				position: fixed;
				width: 90%;
				top: 40%;
				left: 50%;
				transform: translate(-50%, -50%);
				background-color: white;
				border: 1px solid #ccc;
				padding: 20px;
				box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.1);
			}

			.close-btn {
				position: absolute;
				top: 10px;
				font-size: 20px;
				right: 5px;
				cursor: pointer;
			}
		</style>
		<script>
			$(document).ready(function(){
				$.ajaxSetup({ 
                    headers: { 
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    } 
                });
                $(".diligence").change(function(){
                    var id_type = $(this).closest("tr").attr("id");
                    var diligence = $(this).val();
                    var final = $(this).closest("tr").find(".final").val();
                    var student_id = $(this).closest("tr").find("#student_id").val();
                    
                    if($.trim(final)===''){
                        final = 0;
                    }
                    var total = (diligence * 3 + final * 7)/10;
                    $(this).closest("tr").find(".total").val(total);
                    if(total >= 8.5){
                        $(this).closest("tr").find(".score").html("<b class='success_score'>A</b>");
                    }else if(total >= 7 && total <= 8.4){
                        $(this).closest("tr").find(".score").html("<b class='primary_score'>B</b>");
                    }else if(total >= 5.5 && total <= 6.9){
                        $(this).closest("tr").find(".score").html("<b class='basic_score'>C</b>");
                    }else if(total >= 4 && total <= 5.4){
                        $(this).closest("tr").find(".score").html("<b class='warning_score'>D</b>");
                    }else{
                        $(this).closest("tr").find(".score").html("<b class='danger_score'>F</b>");
                    }

                    $.ajax({
                        url:"{{URL('gv/quan-ly-do-an/diem')}}",
                        type:"POST",
                        data:{
                            id_type:id_type,
                            id_student:student_id,
                            diligence_score:diligence
                        },
                    });
                });
                $(".final").change(function(){
                    var id_type = $(this).closest("tr").attr("id");
                    var final = $(this).val();
                    var diligence = $(this).closest("tr").find(".diligence").val();
                    var student_id = $(this).closest("tr").find("#student_id").val();

                    if($.trim(diligence)===''){
                        diligence = 0;
                    }

                    var total = (diligence * 3 + final * 7)/10;
                    $(this).closest("tr").find(".total").val(total);
                    if(total >= 8.5){
                        $(this).closest("tr").find(".score").html("<b class='success_score'>A</b>");
                    }else if(total >= 7 && total <= 8.4){
                        $(this).closest("tr").find(".score").html("<b class='primary_score'>B</b>");
                    }else if(total >= 5.5 && total <= 6.9){
                        $(this).closest("tr").find(".score").html("<b class='basic_score'>C</b>");
                    }else if(total >= 4 && total <= 5.4){
                        $(this).closest("tr").find(".score").html("<b class='warning_score'>D</b>");
                    }else{
                        $(this).closest("tr").find(".score").html("<b class='danger_score'>F</b>");
                    }

                    $.ajax({
                        url:"{{URL('gv/quan-ly-do-an/diem')}}",
                        type:"POST",
                        data:{
                            id_type:id_type,
                            id_student:student_id,
                            final_score:final,
                            sum_t10_score:total
                        },
                    })
                });
			});
		</script>
@endsection		