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
										@php 
											$i = 0; 
											$active = 1;
										@endphp
										@foreach($items as $item)
										@php $i++; @endphp
                                        <tr id="{{$item->student->id}}">
											<td>{{$i}}</td>
											<td>{{$item->student->code}}</td>
											<td>{{$item->student->name}}</td>
											<td>{{$item->student->activity_class->code}}</td>
                                            <td>
												@php 
													$midterm_score = 0;
													$final_score = 0;
													$total_score = 0;
													$attendance_score = 10;
													$counts = array_count_values($absent);
													if(isset($counts[$item->student->id])){
														$count = $counts[$item->student->id];
													}else{
														$count = 0;
													}
													$attendance_score -= $count;
													
													if($item->active == 0){
														$active = 0;
													}
													if(!empty($item->homework_score)){
														$homework_score = $item->homework_score;
													}
													if(!empty($item->midterm_score)){
														$midterm_score = $item->midterm_score;
													}
													if(!empty($item->final_score)){
														$final_score = $item->final_score;
													}
													if(!empty($item->homework_score)){
														$total_score = ($attendance_score + $homework_score * 2 + $midterm_score * 2 + $final_score * 5)/10;
													}else{
														$total_score = ($attendance_score * 2 + $midterm_score * 2 + $final_score * 6)/10;
													}
													$total_score = str_replace(',','.',number_format($total_score,1,'.',''));
													$total_score = ($total_score - floor($total_score) > 0 ? $total_score : floor($total_score));
												@endphp
												<input type="number" value="{{$attendance_score}}" class="attendance" id="input" readonly/>
											</td>
											<td>
												<input type="number" value="{{!empty($item->homework_score) ? $item->homework_score : '' }}" id="input" class="homework"/>
											</td>
											<td>
												<input type="number" value="{{!empty($item->midterm_score) ? $item->midterm_score : '' }}" id="input" class="midterm"/>
											</td>
											<td>
												<input type="number" value="{{!empty($item->final_score) ? $item->final_score : '' }}" id="input" class="final"/>
											</td>
											<td>
												<input type="text" value="{{$total_score}}" class="total" id="input" readonly/>
											</td>
											<td class="keyword">
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
												@if($active==1)
													<span>Giảng viên đã xác nhận điểm nên không được thay đổi, vui lòng liên hệ bộ phận kĩ thuật nếu có sai sót</span>
												@else
												<form action="{{URL('gv/quan-ly-diem/xac-nhan')}}" method="POST">
													<input type="hidden" name="section_id" class="section_id" value="{{$section->id}}"/>
													<button type="submit" class="wm-register">Xác nhận</button>
													@csrf
												</form>
												@endif
											</td>
										</tr>
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
					var homework_score = $(this).val();
					var student_id = $(this).closest("tr").attr("id");
					var section_id = $(".section_id").val();
					var attendance_score = $(this).closest("tr").find(".attendance").val();
					var midterm_score = $(this).closest("tr").find(".midterm").val();
					var final_score = $(this).closest("tr").find(".final").val();

					if($.trim(midterm_score)===''){
                        midterm_score = 0;
                    }
					if($.trim(final_score)===''){
                        final_score = 0;
                    }			
					var total = (parseFloat(attendance_score) + parseFloat(homework_score) * 2 + parseFloat(midterm_score) * 2 + parseFloat(final_score) * 5)/10;	
						
					$(this).closest("tr").find(".total").val(total);
					if(total >= 8.5){
                        $(this).closest("tr").find(".keyword").html("<b class='success_score'>A</b>");
                    }else if(total >= 7 && total <= 8.4){
                        $(this).closest("tr").find(".keyword").html("<b class='primary_score'>B</b>");
                    }else if(total >= 5.5 && total <= 6.9){
                        $(this).closest("tr").find(".keyword").html("<b class='basic_score'>C</b>");
                    }else if(total >= 4 && total <= 5.4){
                        $(this).closest("tr").find(".keyword").html("<b class='warning_score'>D</b>");
                    }else{
                        $(this).closest("tr").find(".keyword").html("<b class='danger_score'>F</b>");
                    }
					$.ajax({
						url:"{{URL('gv/quan-ly-diem/nhap-diem')}}",
						type:"POST",
						data:{
							student_id:student_id,
							section_id:section_id,
							homework_score:homework_score
						}
					});
				});

				$(".midterm").change(function(){
					var midterm_score = $(this).val();
					var student_id = $(this).closest("tr").attr("id");
					var section_id = $(".section_id").val();
					var attendance_score = $(this).closest("tr").find(".attendance").val();
					var homework_score = $(this).closest("tr").find(".homework").val();
					var final_score = $(this).closest("tr").find(".final").val();

					if($.trim(final_score)===''){
                        final_score = 0;
                    }	
					if($.trim(homework_score)===''){
						var total = (parseFloat(attendance_score) * 2 + parseFloat(midterm_score) * 2 + parseFloat(final_score) * 6)/10;
					}else{
						var total = (parseFloat(attendance_score) + parseFloat(homework_score) * 2 + parseFloat(midterm_score) * 2 + parseFloat(final_score) * 5)/10;
					}
					$(this).closest("tr").find(".total").val(total);
					if(total >= 8.5){
                        $(this).closest("tr").find(".keyword").html("<b class='success_score'>A</b>");
                    }else if(total >= 7 && total <= 8.4){
                        $(this).closest("tr").find(".keyword").html("<b class='primary_score'>B</b>");
                    }else if(total >= 5.5 && total <= 6.9){
                        $(this).closest("tr").find(".keyword").html("<b class='basic_score'>C</b>");
                    }else if(total >= 4 && total <= 5.4){
                        $(this).closest("tr").find(".keyword").html("<b class='warning_score'>D</b>");
                    }else{
                        $(this).closest("tr").find(".keyword").html("<b class='danger_score'>F</b>");
                    }
					$.ajax({
						url:"{{URL('gv/quan-ly-diem/nhap-diem')}}",
						type:"POST",
						data:{
							student_id:student_id,
							section_id:section_id,
							midterm_score:midterm_score
						}
					});
				});

				$(".final").change(function(){
					var final_score = $(this).val();
					var student_id = $(this).closest("tr").attr("id");
					var section_id = $(".section_id").val();
					var attendance_score = $(this).closest("tr").find(".attendance").val();
					var midterm_score = $(this).closest("tr").find(".midterm").val();
					var homework_score = $(this).closest("tr").find(".homework").val();

					if($.trim(homework_score)===''){
						var total = (parseFloat(attendance_score) * 2 + parseFloat(midterm_score) * 2 + parseFloat(final_score) * 6)/10;
					}else{
						var total = (parseFloat(attendance_score) + parseFloat(homework_score) * 2 + parseFloat(midterm_score) * 2 + parseFloat(final_score) * 5)/10;
					}
					$(this).closest("tr").find(".total").val(total);
					if(total >= 8.5){
                        $(this).closest("tr").find(".keyword").html("<b class='success_score'>A</b>");
                    }else if(total >= 7 && total <= 8.4){
                        $(this).closest("tr").find(".keyword").html("<b class='primary_score'>B</b>");
                    }else if(total >= 5.5 && total <= 6.9){
                        $(this).closest("tr").find(".keyword").html("<b class='basic_score'>C</b>");
                    }else if(total >= 4 && total <= 5.4){
                        $(this).closest("tr").find(".keyword").html("<b class='warning_score'>D</b>");
                    }else{
                        $(this).closest("tr").find(".keyword").html("<b class='danger_score'>F</b>");
                    }
					$.ajax({
						url:"{{URL('gv/quan-ly-diem/nhap-diem')}}",
						type:"POST",
						data:{
							student_id:student_id,
							section_id:section_id,
							attendance_score:attendance_score,
							final_score:final_score,
							total_score:total
						}
					});
				});
			});
		</script>
@endsection		