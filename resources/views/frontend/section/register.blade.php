@extends('frontend.layouts.app')
@section('content')
<!--// Mini Header \\-->
<div class="wm-mini-header">
			<span class="wm-blue-transparent"></span>
			 <div class="container">
			    <div class="row">
				    <div class="col-md-12">
				        <div class="wm-mini-title">
				       		<h1>Đăng kí tín chỉ</h1> 
				        </div>
				        <div class="wm-breadcrumb">
				          	<ul>
				          	 	<li><a href="index-2.html">Trang chủ</a></li>
				          	 	<li><a href="#">Sinh viên</a></li>
				           		<li>Đăng kí tín chỉ</li>
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
							<div class="wm-student-dashboard-statement wm-dashboard-statement">
								<div class="wm-plane-title">
									<h4>B1. Chọn đăng ký các lớp học phần theo nhóm</h4>							
								</div>
								<div class="wm-article">
									<ul>
										@foreach($groups as $group)
										<li>
											<a class="wm-dowmload" id="showAlertBtn">
												<i id="{{$group->id}}"></i>{{$group->name}}
											</a>
										</li>
										@endforeach
									</ul>
									<p class="notice">Phòng Đào tạo khuyến cáo đăng ký theo nhóm để không bị trùng lịch TKB</p>
								</div>
							</div>	
							<div class="wm-student-dashboard-statement wm-dashboard-statement">
								<div class="wm-plane-title">
									<h4>B2. Chọn đăng ký các học phần chọn riêng lẻ</h4>							
								</div>
								<div class="wm-article">
									<table class="wm-article">
										<thead>
											<th>STT</th>
											<th>Mã học phần</th>
											<th width='600px'>Tên học phần</th>
											<th>Số TC</th>
											<th>Xem chi tiết các lớp học phần</th>
											<th>Tình trạng đã đăng ký</th>
										</thead>
										<tbody>
											@php $i = 0; @endphp
											@if(isset($projects))
											@foreach($projects as $project)
											@php $i++; @endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{$project->code}}</td>
												<td>{{$project->name}}</td>
												<td>{{$project->credit}}</td>
												@if(!empty($datas))
												@foreach($datas as $data)
												@if($project->id == $data['type_id'])
												<td></td>
												<td>
													<b>X</b>
												</td>
												@endif
												@endforeach
												@else
												<td>
													<a class="btn btn-success" id="showProject">
														<i id="{{$project->id}}"></i>Xem
													</a>
												</td>
												<td></td>
												@endif
											</tr>
											@endforeach
											@endif
										</tbody>
									</table>
								</div>
							</div>	
							<div class="wm-plane-title">
								<h4>Các lớp học phần đã đăng ký thành công</h4>							
							</div>
							<div class="wm-student-dashboard-statement wm-dashboard-statement">
								<table class="wm-article">
									<thead>
										<th>STT</th>
										<th>Mã học phần</th>
										<th>Tên học phần</th>
										<th>Số TC</th>
										<th>Giảng viên</th>
										<th>Thời khóa biểu</th>
										<th>Tuần học</th>
										<th></th>
									</thead>
									<tbody>
										@php $i = 0; @endphp
										@if(isset($results))
										@foreach($results as $result)
										@php $i++; @endphp
										<tr>
											<td>{{$i}}</td>
											<td>{{$result['code']}}</td>
											<td>{{$result['name']}}</td>
											<td>{{$result['credit']}}</td>
											<td>{{$result['teacher']}}</td>
											<td>{!!$result['desc']!!}</td>
											<td>{{$result['week']}}</td>
											<td>
												<a class="wm-cancel" href="{{URL('sv/dang-ki-tin-chi/huy/mon/'.$result['id'].'')}}">
													Hủy
												</a>
											</td>
										</tr>
										@endforeach
										@endif
										@if(isset($datas))
										@foreach($datas as $data)
										@php $i++; @endphp
										<tr>
											<td>{{$i}}</td>
											<td>{{$data['code']}}</td>
											<td>{{$data['title']}}</td>
											<td>{{$data['credit']}}</td>
											<td>{{$data['teacher']}}</td>
											<td>_</td>
											<td>_</td>
											<td>
												<a class="wm-cancel" href="{{URL('sv/dang-ki-tin-chi/huy/mon/do-an/'.$data['id'].'')}}">
													Hủy
												</a>
											</td>
										</tr>
										@endforeach
										@endif
									</tbody>
								</table>								
						</div>
					</div>
				</div>
			</div>
			<!--// Main Section \\-->
			<div id='show'></div>
            <!--// Main Section \\-->
		</div>
		<!--// Main Content \\-->
		<style>
			.custom-alert {
				display: none;
				position: fixed;
				width: 90%;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				background-color: white;
				border: 1px solid #ccc;
				padding: 20px;
				box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.1);
			}
			#show{
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background-color: rgba(0, 0, 0, 0.5);
				display: none;
			}

			.close-btn {
				position: absolute;
				top: 10px;
				font-size: 20px;
				right: 5px;
				cursor: pointer;
			}

			.custom-danger{
				color: red;
				margin-left: 20%;
			}
			.danger{
				color: red;
				margin-left: 10%;
			}
			#showAlertBtn{
				background-color: #26B99A;
				border: 1px solid #169F85;
			}
			.notice{
				text-align: center;
				font-style: italic;
			}
			.btn-success{
				background-color: #26B99A;
				border: 1px solid #169F85;
			}
			.btn-success:hover{
				background-color: #26B99A;
				border: 1px solid #169F85;
			}
			.wm-register{
				background-color: #26B99A;
				color: #fff;
				padding: 8px 16px;
				border: none;
				border-radius: 4px;
				font-size: 14px;
				cursor: pointer;
				transition: background-color 0.3s ease;
			}

			.wm-cancel{
				background-color: #F1AF00;
				color: #fff;
				padding: 8px 16px;
				border: none;
				border-radius: 4px;
				font-size: 14px;
				cursor: pointer;
				transition: background-color 0.3s ease;
			}

			thead {
				background-color: #73879C;
				color: white;
				font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
			}
		</style>
		<script>
			$(document).ready(function() {
				$.ajaxSetup({ 
					headers: { 
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
					} 
                });
				
				$(document).on('click','#showAlertBtn',function() {
					var id = $(this).find("i").attr('id');
					
					$.ajax({
						url:"{{URL('sv/dang-ki-tin-chi/mon-hoc')}}",
						type:"POST",
						data:{
							id:id,
							type:0
						},
						success:function(response){
							var html = $(
								"<div id='customAlert' class='custom-alert'>"
									+"<b>DANH SÁCH CÁC LỚP HỌC PHẦN</b>"
									+"<span class='close-btn'>&times;</span>"
									+"<form action='' method='POST'>"
									+"<div class='wm-student-dashboard-statement wm-dashboard-statement'>"
										+"<table class='wm-article'>"
											+"<thead>"
												+"<th>STT</th>"
												+"<th>Tên lớp học phần</th>"
												+"<th>Số TC</th>"
												+"<th>Sỉ số</th>"
												+"<th>Số lượng đăng kí</th>"
												+"<th>Giảng viên</th>"
												+"<th>Thời khóa biểu</th>"
												+"<th>Tuần học</th>"
												+"<th></th>"
											+"</thead>"
											+"<tbody></tbody>"
										+"</table>"
										+"<input type='hidden' name='_token' value='{{ csrf_token() }}'/>"
										+"<button type='submit' class='wm-register'>Đăng kí nhanh lại tất cả HP trong nhóm</button>"
									+"</div>"
									+"</form>"
								+"</div>"
							);
							$("#show").html(html);
							let id = 0;
							response.forEach(function(item){
								id++;
								var link = (item.register >= item.count) ? "<div class='danger'><p>Lớp đã đầy ("+item.count+"/"+item.count+")</p></div>" 
									: "<a class='wm-register' href='{{URL('sv/dang-ki-tin-chi/mon')}}/"
										+item.id
									+"'>Chọn</a>"
									+"<input type='hidden' name='section_id[]' value='"+item.id+"'/>"
								$("#customAlert").find("tbody").append(
									"<tr>"
										+"<td>"+id+"</td>"
										+"<td>"+item.name+"</td>"
										+"<td>"+item.credits+"</td>"
										+"<td>"+item.count+"</td>"
										+"<td>"+item.register+"</td>"
										+"<td>"+item.teacher+"</td>"
										+"<td>"+item.desc+"</td>"
										+"<td>"+item.week+"</td>"
										+"<td>"+((item.alert) ? item.alert : link)+"</td>"
									+"</tr>"
								)
							});
							$("#show").fadeIn();
							$("#customAlert").fadeIn();
						}
					});
				});

				$(document).on('click','#showProject',function(){
					var id = $(this).find("i").attr('id');

					$.ajax({
						url:"{{URL('sv/dang-ki-tin-chi/mon-hoc')}}",
						type:"POST",
						data:{
							id:id,
							type:1		
						},
						success:function(response){
							console.log(response);
							var html = $(
								"<div id='customProject' class='custom-alert'>"
									+"<b>DANH SÁCH CÁC LỚP HỌC PHẦN</b>"
									+"<span class='close-btn'>&times;</span>"
									+"<form action='' method='POST'>"
									+"<div class='wm-student-dashboard-statement wm-dashboard-statement'>"
										+"<table class='wm-article'>"
											+"<thead>"
												+"<th>STT</th>"
												+"<th width='500px'>Tên lớp học phần</th>"
												+"<th>Sỉ số</th>"
												+"<th>Số lượng đăng ký</th>"
												+"<th>Giảng viên</th>"
												+"<th>Thời khóa biểu</th>"
												+"<th>Tuần học</th>"
												+"<th>Tùy chọn</th>"
											+"</thead>"
											+"<tbody></tbody>"
										+"</table>"
										+"<input type='hidden' name='_token' value='{{ csrf_token() }}'/>"
									+"</div>"
									+"</form>"
								+"</div>"
							);
							$("#show").html(html);
							response.forEach(function(item){
								$("#customProject").find("tbody").append(
									"<tr>"
										+"<td>1</td>"
										+"<td>"+item.title+"</td>"
										+"<td>_</td>"
										+"<td>_</td>"
										+"<td>"+item.teacher+"</td>"
										+"<td>_</td>"
										+"<td>_</td>"
										+"<td>"
											+"<a class='wm-register' href='{{URL('sv/dang-ki-tin-chi/mon/do-an')}}/"+item.id+"'>"
												+"Chọn"
											+"</a>"
										+"</td>"
									+"<tr>"
								);
							});
							$("#show").fadeIn();
							$("#customProject").fadeIn();
						}
					})
				});

				$(document).on("click",".close-btn",function() {
					$('#customAlert').fadeOut();
					$('#customProject').fadeOut();
					$("#show").fadeOut();
				});

			});
		</script>
@endsection		