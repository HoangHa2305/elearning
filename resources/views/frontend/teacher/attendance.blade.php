@extends('frontend.layouts.app')
@section('content')
<!--// Mini Header \\-->
<div class="wm-mini-header">
			<span class="wm-blue-transparent"></span>
			 <div class="container">
			    <div class="row">
				    <div class="col-md-12">
				        <div class="wm-mini-title">
				       		<h1>Điểm danh lớp học phần</h1> 
				        </div>
				        <div class="wm-breadcrumb">
				          	<ul>
				          	 	<li><a href="index-2.html">Trang chủ</a></li>
				          	 	<li><a href="#">Giảng viên</a></li>
				           		<li>Điểm danh lớp học phần</li>
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
								<h4>Danh sách lớp <u>{{$section->name}}</u></h4>	
                                <p>Nội dung giảng dạy hôm nay <i class="wmicon-pen"></i></p>						
							</div>
							<div class="wm-student-dashboard-statement wm-dashboard-statement">
								<table class="wm-article">
									<thead>
										<th>STT</th>
										<th>Mã SV</th>
										<th>Tên SV</th>
										<th>Lớp SH</th>
										<th>Điểm danh</th>
                                        <th>Ghi chú</th>
									</thead>
									<tbody>
										@php 
											$i = 0;
											if(isset($attendance->absent)){
												$absent = json_decode($attendance->absent);
											}
											if(isset($attendance->permission)){
												$permission = json_decode($attendance->permission);
											}
											if(isset($attendance->late)){
												$late = json_decode($attendance->late);
											}
										@endphp
                                        @foreach($lists as $list)
										@php $i++; @endphp
                                        <tr>
                                            <td>{{$i}}</td>
											<td>{{$list->code}}</td>
                                            <td>{{$list->name}}</td>
											<td>{{$list->class}}</td>
											<td id="{{$list->id}}">
												@php $flag = 0; @endphp
												@if(isset($absent))
													@if(!is_null($absent) && in_array($list->id,$absent))
													<button class="vm-danger">Vắng</button>
													@php $flag = 1; @endphp
													@endif
												@endif
												@if(isset($permission))
													@if(!is_null($permission) && in_array($list->id,$permission))
													<button class="vm-primary">Vắng phép</button>
													@php $flag = 1; @endphp
													@endif
												@endif
												@if(isset($late))
													@if(!is_null($late) && in_array($list->id,$late))
													<button class="wm-cancel">Đi trễ</button>
													@php $flag = 1; @endphp
													@endif
												@endif
												@if($flag==0)
												<button class="wm-register">Có mặt</button>
												@endif
											</td>
											<td id="note">
												<textarea id="{{$list->id}}" class="form-control textarea"></textarea>
												<p class="note"><i class="wmicon-tool"></i> Lần nghỉ: <span>{{!empty($array) ? array_count_values($array)[$list->id] ?? 0 : 0}}</span></p>
											</td>
                                        </tr>
                                        @endforeach
									</tbody>
								</table>	
								<div class="container" id="box">
									<div class="statistics">
										<form action="" method="POST">
											<input type="hidden" name="section_id" value="{{$section->id}}"/>
											<button type="submit" class="submit-all">
												Trường hợp lớp không vắng ai, GV vui lòng click vào đây
											</button>
											@csrf
										</form>
									</div>
									<div class="flex">
										<div>
											<p>Thống kê tình hình lớp hôm nay</p>
										</div>
										<div class="absent">
											<div>
												<p class="wm-register" style="width: 150px;">Có mặt : 0</p>
												<p class="vm-primary" style="width: 150px;">Vắng phép : {{isset($permission) ? (is_null($permission) ? 0 : count($permission)) : 0}}</p>
											</div>
											<div id="p">
												<p class="vm-danger" style="width: 150px;">Vắng : {{isset($absent) ? (is_null($absent) ? 0 : count($absent)) : 0}}</p>
												<p class="wm-cancel" style="width: 150px;">Đi trễ : {{isset($late) ? (is_null($late) ? 0 : count($late)) : 0}}</p>
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
			.absent{
				display: flex;
			}
			span {
				color: #f0ad4e;
			}
			#p{
				margin-left: 20px;
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
				width: 130px;
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
				width: 130px;
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
				width: 130px;
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

			#show{
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background-color: rgba(0, 0, 0, 0.5);
				display: none;
			}

			.custom-alert {
				display: none;
				position: fixed;
				width: 90%;
				top: 60%;
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
				$("textarea").hide();
				var section_id = <?php echo json_encode($section->id) ?>;
				var note;

				$.ajax({
					url:"{{URL('gv/ghi-chu')}}/"+section_id,
					type:"GET",
					success:function(response){
						// note = $.merge([],$.map(response,function(item){
						// 	return JSON.parse(item.reason)
						// }));
						note = JSON.parse(response.reason);

						note.map(function(item){
							var id = item.split(':')[0];
							var content = item.split(':')[1];
							$('table').find('textarea#'+id).show().append(content);
						});
					}
				});

				$("i.wmicon-pen").click(function(){
					var html = $(
						"<div id='customAlert' class='custom-alert'>"
							+"<span class='close-btn'>&times;</span>"
							+"<div class='wm-student-dashboard-statement wm-dashboard-statement'>"
								+"<h4 class='title'>Nội dung giảng dạy hôm nay</h4>"
								+"<form action='' method='POST'>"
									+"<input type='hidden' name='_token' value='{{ csrf_token() }}'/>"
									+"<input type='hidden' name='section_id' value='"+section_id+"' />"
									+"<input type='text' class='form-control' id='content' name='content' placeholder='GV điền nội dung giảng dạy theo lịch trình giảng dạy được quy định trong đề cương chi tiết'/>"
									+"<div id='center'>"
										+"<button type='submit' id='submit' class='wm-cancel'>Xác nhận</button>"
									+"</div>"
								+"</form>"
							+"</div>"
							+"<div class='wm-student-dashboard-statement wm-dashboard-statement'>"
								+"<h4 class='title'>Nội dung đã giảng dạy lớp học phần</h4>"
								+"<table id='table'>"
									+"<thead id='header'>"
										+"<th style='width:15%;'>STT</th>"
										+"<th></th>"
									+"</thead>"
									+"<tbody></tbody>"
								+"</table>"
							+"</div>"
						+"</div>"
					);
					$("#show").html(html);
					$("#show").fadeIn();
					$("#customAlert").fadeIn();

					$.ajax({
						url:"{{URL('gv/diem-danh/noi-dung')}}/"+section_id,
						type:"GET",
						success:function(response){
							$("#table tbody").empty();
							var i = 0;

							response.forEach(function(item){
								i++;
								var row = $(
									"<tr>"
										+"<td>Buổi "+i+"</td>"
										+"<td style='text-align:left;'>"+(item.content == null ? '' : item.content)+"</td>"
									+"</tr>"
								)
								$("#table tbody").append(row);
							});
						}
					});
				});

				$(document).on('click','.close-btn',function(){
					$("#customAlert").fadeOut();
					$("#show").fadeOut();
				});

				$('button.wm-register').click(function(){
					var current = $(this).attr('class');
					var id = $(this).closest('td').attr('id');
					var count = $(this).closest('tr').find('td#note').find('span').text();
					if(current === 'wm-register'){
						$(this).text('Vắng');
						$(this).removeClass('wm-register').addClass('vm-danger');
						$(this).closest('tr').find('td#note').find('span').text(parseInt(count) + 1);

						$.ajax({
							url:"{{URL('gv/diem-danh')}}",
							type:"POST",
							data:{
								id: id,
								section_id: section_id,
								type:1
							},
							success:function(response){
								console.log(response);
							}
						});
					}else if(current === 'vm-danger'){
						$(this).text('Vắng phép');
						$(this).removeClass('vm-danger').addClass('vm-primary');
						$(this).closest('tr').find('td#note').find('span').text(parseInt(count) - 1);

						$.ajax({
							url:"{{URL('gv/diem-danh')}}",
							type:"POST",
							data:{
								id: id,
								section_id: section_id,
								type:2
							},
							success:function(response){
								console.log(response);
							}
						});
					}else if(current === 'vm-primary'){
						$(this).text('Đi trễ');
						$(this).removeClass('vm-primary').addClass('wm-cancel');
						
						$.ajax({
							url:"{{URL('gv/diem-danh')}}",
							type:"POST",
							data:{
								id: id,
								section_id: section_id,
								type:3
							},
							success:function(response){
								console.log(response);
							}
						});
					}else if(current === 'wm-cancel'){
						$(this).text('Có mặt');
						$(this).removeClass('wm-cancel').addClass('wm-register');

						$.ajax({
							url:"{{URL('gv/diem-danh')}}",
							type:"POST",
							data:{
								id: id,
								section_id: section_id,
								type:4
							},
							success:function(response){
								console.log(response);
							}
						});
					}
				});
				$('button.vm-danger').click(function(){
					var current = $(this).attr('class');
					var id = $(this).closest('td').attr('id');
					var count = $(this).closest('tr').find('td#note').find('span').text();
					if(current === 'wm-register'){
						$(this).text('Vắng');
						$(this).removeClass('wm-register').addClass('vm-danger');
						$(this).closest('tr').find('td#note').find('span').text(parseInt(count) + 1);

						$.ajax({
							url:"{{URL('gv/diem-danh')}}",
							type:"POST",
							data:{
								id: id,
								section_id: section_id,
								type:1
							},
							success:function(response){
								console.log(response);
							}
						});
					}else if(current === 'vm-danger'){
						$(this).text('Vắng phép');
						$(this).removeClass('vm-danger').addClass('vm-primary');
						$(this).closest('tr').find('td#note').find('span').text(parseInt(count) - 1);

						$.ajax({
							url:"{{URL('gv/diem-danh')}}",
							type:"POST",
							data:{
								id: id,
								section_id: section_id,
								type:2
							},
							success:function(response){
								console.log(response);
							}
						});
					}else if(current === 'vm-primary'){
						$(this).text('Đi trễ');
						$(this).removeClass('vm-primary').addClass('wm-cancel');
						
						$.ajax({
							url:"{{URL('gv/diem-danh')}}",
							type:"POST",
							data:{
								id: id,
								section_id: section_id,
								type:3
							},
							success:function(response){
								console.log(response);
							}
						});
					}else if(current === 'wm-cancel'){
						$(this).text('Có mặt');
						$(this).removeClass('wm-cancel').addClass('wm-register');

						$.ajax({
							url:"{{URL('gv/diem-danh')}}",
							type:"POST",
							data:{
								id: id,
								section_id: section_id,
								type:4
							},
							success:function(response){
								console.log(response);
							}
						});
					}
				});
				$('button.vm-primary').click(function(){
					var current = $(this).attr('class');
					var id = $(this).closest('td').attr('id');
					var count = $(this).closest('tr').find('td#note').find('span').text();
					var type;
					if(current === 'wm-register'){
						$(this).text('Vắng');
						$(this).removeClass('wm-register').addClass('vm-danger');
						$(this).closest('tr').find('td#note').find('span').text(parseInt(count) + 1);

						$.ajax({
							url:"{{URL('gv/diem-danh')}}",
							type:"POST",
							data:{
								id: id,
								section_id: section_id,
								type:1
							},
							success:function(response){
								console.log(response);
							}
						});
					}else if(current === 'vm-danger'){
						$(this).text('Vắng phép');
						$(this).removeClass('vm-danger').addClass('vm-primary');
						$(this).closest('tr').find('td#note').find('span').text(parseInt(count) - 1);

						$.ajax({
							url:"{{URL('gv/diem-danh')}}",
							type:"POST",
							data:{
								id: id,
								section_id: section_id,
								type:2
							},
							success:function(response){
								console.log(response);
							}
						});
					}else if(current === 'vm-primary'){
						$(this).text('Đi trễ');
						$(this).removeClass('vm-primary').addClass('wm-cancel');
						
						$.ajax({
							url:"{{URL('gv/diem-danh')}}",
							type:"POST",
							data:{
								id: id,
								section_id: section_id,
								type:3
							},
							success:function(response){
								console.log(response);
							}
						});
					}else if(current === 'wm-cancel'){
						$(this).text('Có mặt');
						$(this).removeClass('wm-cancel').addClass('wm-register');

						$.ajax({
							url:"{{URL('gv/diem-danh')}}",
							type:"POST",
							data:{
								id: id,
								section_id: section_id,
								type:4
							},
							success:function(response){
								console.log(response);
							}
						});
					}
				});
				$('button.wm-cancel').click(function(){
					var current = $(this).attr('class');
					var id = $(this).closest('td').attr('id');
					var count = $(this).closest('tr').find('td#note').find('span').text();
					var type;
					if(current === 'wm-register'){
						$(this).text('Vắng');
						$(this).removeClass('wm-register').addClass('vm-danger');
						$(this).closest('tr').find('td#note').find('span').text(parseInt(count) + 1);

						$.ajax({
							url:"{{URL('gv/diem-danh')}}",
							type:"POST",
							data:{
								id: id,
								section_id: section_id,
								type:1
							},
							success:function(response){
								console.log(response);
							}
						});
					}else if(current === 'vm-danger'){
						$(this).text('Vắng phép');
						$(this).removeClass('vm-danger').addClass('vm-primary');
						$(this).closest('tr').find('td#note').find('span').text(parseInt(count) - 1);

						$.ajax({
							url:"{{URL('gv/diem-danh')}}",
							type:"POST",
							data:{
								id: id,
								section_id: section_id,
								type:2
							},
							success:function(response){
								console.log(response);
							}
						});
					}else if(current === 'vm-primary'){
						$(this).text('Đi trễ');
						$(this).removeClass('vm-primary').addClass('wm-cancel');
						
						$.ajax({
							url:"{{URL('gv/diem-danh')}}",
							type:"POST",
							data:{
								id: id,
								section_id: section_id,
								type:3
							},
							success:function(response){
								console.log(response);
							}
						});
					}else if(current === 'wm-cancel'){
						$(this).text('Có mặt');
						$(this).removeClass('wm-cancel').addClass('wm-register');

						$.ajax({
							url:"{{URL('gv/diem-danh')}}",
							type:"POST",
							data:{
								id: id,
								section_id: section_id,
								type:4
							},
							success:function(response){
								console.log(response);
							}
						});
					}
				});

				$(".wmicon-tool").click(function(){
					$(this).closest("td").find("textarea").show();
					
				});

				$(".textarea").change(function(){
					var id = $(this).closest("td").find("textarea").attr("id");
					var val = $(this).closest("td").find("textarea").val();
					$.ajax({
						url:"{{URL('gv/ghi-chu')}}",
						type:"POST",
						data:{
							id: id,
							value: val,
							section_id: section_id
						},
						success:function(response){
							console.log(response);
						}
					})
				});
			});
		</script>
@endsection		