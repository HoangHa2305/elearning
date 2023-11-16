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
								<h4>Lớp học phần {{$section->name}} <u></u></h4>	
                                <p>Giảng viên phụ trách: {{$section->teacher->name}}</i></p>						
							</div>
							<div class="wm-student-dashboard-statement wm-dashboard-statement">
								<table class="wm-article">
									<thead>
										<th>STT</th>
										<th>Mã SV</th>
										<th>Tên SV</th>
										<th>Lớp SH</th>
										<th>Điểm CC/GVHD</th>
                                        <th>Điểm bài tập</th>
										<th>Điểm giữa kì</th>
										<th>Điểm cuối kì / Đồ án</th>
										<th>Điểm T10</th>
										<th>Điểm chữ</th>
									</thead>
									<tbody>
										<form action="{{URL('gv/quan-ly-diem/xac-nhan')}}" method="POST">
										@php $i = 0; @endphp
										@foreach($items as $item)
										@php $i++; @endphp
                                        <tr id="{{$item->student->id}}">
											<td>{{$i}}</td>
											<td>{{$item->student->code}}</td>
											<td>{{$item->student->name}}</td>
											<td>{{$item->student->activity_class->code}}</td>
                                            <td>
												@php 
													$attendance_score = 10;
													$counts = array_count_values($absent);
													if(isset($counts[$item->student->id])){
														$count = $counts[$item->student->id];
													}else{
														$count = 0;
													}
													$attendance_score -= $count;
													$homework_score = $item->homework_score;
													$midterm_score = $item->midterm_score;
													$final_score = $item->final_score;
													$total_score = 0;
													if(isset($attendance_score) && isset($homework_score) && isset($midterm_score) && isset($final_score)){
														$total_score = ($attendance_score + $homework_score + $midterm_score * 3 + $final_score * 5)/10;
													}
												@endphp
												<input type="text" value="{{$attendance_score}}" id="input" readonly/>
												<input type="hidden" name="attendance_score[]" value="{{$item->id_student}} - {{$attendance_score}}"/>
											</td>
											<td>
												<input type="text" value="{{$homework_score}}" id="input" class="homework"/>
												<input type="hidden" name="homework_score[]" class="homework_score" value="{{$item->id_student}} - {{$homework_score}}"/>
											</td>
											<td>
												<input type="text" value="{{$midterm_score}}" id="input" class="midterm"/>
												<input type="hidden" name="midterm_score[]" class="midterm_score" value="{{$item->id_student}} - {{$midterm_score}}"/>
											</td>
											<td>
												<input type="text" value="{{$final_score}}" id="input" class="final"/>
												<input type="hidden" name="final_score[]" class="final_score" value="{{$item->id_student}} - {{$final_score}}"/>
											</td>
											<td>
												<input type="text" value="{{$total_score > 0 ? $total_score : ''}}" id="input" readonly/>
											</td>
											<td>
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
                                        </tr>
										@endforeach
										<tr>
											<td colspan="10">
												<input type="hidden" name="section_id" value="{{$section->id}}"/>
												<button type="submit" class="wm-register">Xác nhận</button>
											</td>
										</tr>
										@csrf
										</form>
									</tbody>
								</table>	
								<div class="container" id="box">
									<div class="statistics">
										
									</div>
									<div class="flex">
										<div>
											<p>Thống kê tình hình lớp hôm nay</p>
										</div>
										<div class="absent">
											<div>
												<p class="wm-register" style="width: 150px;">Có mặt : 0</p>
												<p class="vm-primary" style="width: 150px;">Vắng phép :</p>
											</div>
											<div id="p">
												<p class="vm-danger" style="width: 150px;">Vắng :</p>
												<p class="wm-cancel" style="width: 150px;">Đi trễ : </p>
											</div>
										</div>
									</div>
								</div>							
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
				$(".homework").change(function(){
					var val = $(this).val();
					var id = $(this).closest("tr").attr("id");
					$(this).closest("td").find('.homework_score').attr("name","homework_score[]").val(id+" - "+val);
				});

				$(".midterm").change(function(){
					var val = $(this).val();
					var id = $(this).closest("tr").attr("id");
					$(this).closest("td").find('.midterm_score').attr("name","midterm_score[]").val(id+" - "+val);
				});

				$(".final").change(function(){
					var val = $(this).val();
					var id = $(this).closest("tr").attr("id");
					$(this).closest("td").find('.final_score').attr("name","final_score[]").val(id+" - "+val);
				});
			});
		</script>
@endsection		