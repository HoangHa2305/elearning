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
									<h4>Danh sách các nhóm học phần</h4>							
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
										@foreach($results as $result)
										<tr>
											<td>1</td>
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
				top: 30%;
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

			#danger {
				color: red;
			}

			.wm-register{
				background-color: #69ca87;
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
						url:"{{URL('sv/dang-ki-tin-chi')}}/"+id,
						type:"GET",
						success:function(response){
							var html = $(
								"<div id='customAlert' class='custom-alert'>"
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
								var link = (item.register >= item.count) ? "<p id='danger'>Lớp đã đầy ("+item.count+"/"+item.count+")</p>" 
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
							$("#customAlert").fadeIn();
						}
					});
				});

				$(document).on("click",".close-btn",function() {
					$('#customAlert').fadeOut();
				});

			});
		</script>
@endsection		