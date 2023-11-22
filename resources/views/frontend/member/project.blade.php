@extends('frontend.layouts.app')
@section('content')
        <!--// Mini Header \\-->
        <div class="wm-mini-header">
			<span class="wm-blue-transparent"></span>
			 <div class="container">
			    <div class="row">
				    <div class="col-md-12">
				        <div class="wm-mini-title">
				       		<h1>Student Dashboard</h1> 
				        </div>
				        <div class="wm-breadcrumb">
				          	<ul>
				          	 	<li><a href="index-2.html">Home</a></li>
				          	 	<li><a href="#">Student Dashboard</a></li>
				           		<li>Settings</li>
				          	</ul>
				        </div>      
				    </div>
			    </div>
			</div>    
		</div>
  		<!--// Mini Header \\-->
		<div class="wm-main-content">

		<!--// Main Section \\-->
		<div class="wm-main-section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="wm-plane-title">
							<h4 class="topic">Danh sách Đồ án\Đề án của tôi</h4>
							<hr style="border: 1px solid #E6E9ED;">							
						</div>
						<div class="alert-success">
							<p class="note-content">- Sinh viên cần phải thực hiện đề án/đồ án gặp Giảng 
								viên theo thời gian/phòng/lịch đăng ký hoặc liên lạc trực tiếp SĐT của 
								giảng viên
								<br>- Sinh viên <b>tham khảo mẫu tài liệu đề cương chi tiết đồ án / đề án</b> 
								theo hướng dẫn của Khoa hoặc tại đây và thực hiện theo đúng hướng 
								dẫn thao tác quy trình thực hiện các học phần đồ án cơ sở / đề án
								<br>- Sinh viên cần lưu ý các mốc phải hoàn thành (nộp đề cương, nộp 
								kết quả thực hiện) theo đúng thời gian quy định. Trường hợp quá thời 
								gian quy định, vui lòng liên lạc với GVHD hoặc giáo vụ Khoa để được 
								gia hạn thời gian nộp.
								<br>- Sinh viên cần nộp báo cáo (bản cứng) có chữ ký xác nhận của Giảng 
								viên trước khi ra hội đồng bảo vệ, báo cáo cần phải đáp ứng về định 
								dạng của báo cáo khoa học
								<br>- Giảng viên sẽ căn cứ vào trao đổi, báo cáo hệ thống để xác nhận bạn
								có được <b>chấp thuận đề cương</b> hoặc <b>cho phép bảo vệ đề tài/đề án</b> hay không
							</p>
						</div>
						<div class="wm-student-dashboard-statement wm-dashboard-statement">
							<table class="wm-article">
								<thead>
									<th class="th-title">Đồ án cơ sở / Đề án / Khóa luận</th>
									<th class="th-contact">Liên lạc GVHD</th>
									<th class="th-content">Nộp đề cương/ kết quả</th>
									<th class="th-content"> Các mốc / Trạng thái</th>
								</thead>
								@foreach($reports as $report)
								<tbody>
									<tr>
										<td rowspan="2" class="td-rowspan">
											<b class="transform" class="name-teacher">{{$report->title}}</b>
										</td>
										<td id="row-color">
											<div>
												<div class="bg-avatar">
													<img src="https://noithatbinhminh.com.vn/wp-content/uploads/2022/08/anh-dep-40.jpg" class="avatar-teacher"/>											
												</div>
												<p class="name-teacher">
													{{$report->level_teacher == 'Thạc sĩ' ? 'TS' : 'Ths'}}
													.{{$report->name_teacher}}
												</p>
												<p class="info-teacher">905551136</p>
												<p class="info-teacher">nvbinh@vku.udn.vn</p>
											</div>
											<div id="border-right">

											</div>
										</td>
										<td class="row-title">
											<p class="text">Trưởng nhóm đề tài</p>
											<p class="title">XÂY DỰNG ỨNG DỤNG QUẢN LÍ ĐÀO TẠO ĐA NỀN TẢNG CHO TRƯỜNG ĐẠI HỌC</p>
											<b class="transform">Thành viên</b>
											<p class="text">Phạm Vương Anh Bảo (20IT414)</p>
										</td>
										<td class="row-title">
											<p class="title">- Xác nhận đề cương chi tiết:  </p>
											<span class="time-note">23 - 10 - 2023 00:00 AM</span>
											<p class="title">- Nộp kết quả thực hiện đề tài: </p>
											<span class="time-note">23 - 10 - 2023 00:00 AM</span>
										</td>
									</tr>
									<tr>
										<td class="row-title">
											<div class="merge">
												<p class="time">Thời gian: </p>
												<p>Thứ_(_)</p>
											</div>
											<p class="time">Phòng:_</p>
										</td>
										<td class="row-title">
											<a class="text" href="#">Xem lại đề cương chi tiết</a>
											<br>
											<button class="btn btn-primary">Cập nhật đề cương đã sửa</button>
											<button class="btn btn-success">Nộp kết quả thực hiện</button>
										</td>
										<td class="row-title">
											<div>
											<p>- Nộp đề cương chi tiết:</p>
											<span class="badage">Đã nộp</span>
											<p>- GVHD xác nhận:</p>
											<span class="badage">Đã Xác nhận</span>
											<p>- Nộp kết quả thực hiện đề tài:</p>
											<span class="badage">Đã nộp</span>
											<span class="danger">
												<i class="icon fa fa-ban"></i>
												Chưa nộp
											</span>
											</div>
										</td>
									</tr>
								</tbody>
								@endforeach
							</table>								
					</div>
				</div>
			</div>
		</div>
		<!--// Main Section \\-->
		<style>
			p, span {
				margin: 0;
				padding: 0;
			}
			.wm-plane-title{
				background-color: #F5FBFD
			}
			.topic{
				font-family: 'Inter', sans-serif;
				font-size: 18px;
			}
			.alert-success{
				background-color: #dff0d8;
				border-color: #dff0d8;
				padding: 20px;
			}
			.note-content{
				color: #3c763d;
				font-size: 14px;
				font-family: 'Inter', sans-serif;
			}
			.wm-article{
				border-collapse: collapse;
			}
			.th-title{
				text-align: left;
				width: 144.7px;
				font-size: 14px;
				font-family: 'Arial', sans-serif;
			}
			.th-content{
				text-align: left;
				width: 352.57px;
				font-family: 'Arial', sans-serif;
			}
			.th-contact{
				text-align: left;
				width: 206.16px;
			}
			.wm-article,.wm-article td,.wm-article th {
				border: none;
			}
			th{
				text-align: left;
				font-size: 14px;
			}
			.td-rowspan{
				text-align: center;
				vertical-align: middle;
			}
			.transform{
				color: #73879C;
				font-size: 14px;
				font-family: 'Arial', sans-serif;
			}
			thead{
				color: white;
				background-color: #2A3F54;
			}
			tbody{
				background-color: rgba(38,185,154,.07);
			}
			.row-title{
				text-align: left;
				width: 352.57px;
			}
			#border-right{
				margin-top: 10px;
				margin-bottom: 20px;
				width: 5px;
				margin-left: 100px;
				background-color: #46B8DA;
			}
			#row-color{
				display: flex;
			}
			.bg-avatar{
				margin-right: 22px;
				width: 100px;
				height: 140px;
				background-color: #E6E6E6;
				text-align: center;
				padding: 20px 0;
			}
			.avatar-teacher{
				padding: 0px;
				margin: 0px;
				width: 67px;
				height: 100px;
			}
			.name-teacher{
				font-size: 14px;
				color: #73879C;
				text-align: left;
				font-weight: 700;
				font-family: 'Arial', sans-serif;
			}
			.info-teacher{
				font-size: 14px;
				color: #73879C;
				text-align: left;
			}
			.border-right{
				border-color: #46B8DA;
			}
			.text{
				font-size: 14px;
				color: #73879C;
			}
			.title{
				color: #008000;
				font-size: 14px;
				text-align: left;
				font-weight: 700;
				font-family: 'Arial', sans-serif;
			}
			.time{
				font-size: 14px;
				text-align: left;
				font-weight: 700;
				font-family: 'Arial', sans-serif;
			}
			.merge{
				display: flex;
			}
			.time-note{
				background-color: #777;
				color: white;
				font-size: 12px;
				padding-top: 2px;
				padding-bottom: 2px;
				padding-left: 6px;
				padding-right: 6px;
				font-weight: 700;
				text-align: center;
				border-radius: 10px;
			}
			.btn-success{
				background-color: #26B99A;
				border: 1px solid #169F85;
			}
			.badage{
				background: #008000;
				color: white;
				text-align: center;
				padding: 8px;
				font-size: 12px;
				font-weight: 600;
				border-radius: 8px;
			}
			.danger{
				background: yellow;
				color: red;
				text-align: center;
				padding: 8px;
				font-size: 12px;
				font-weight: 600;
				border-radius: 8px;
			}
		</style>
@endsection