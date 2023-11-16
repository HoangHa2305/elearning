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
							<h4>Các lớp học phần đã đăng ký thành công</h4>							
						</div>
						<div class="wm-student-dashboard-statement wm-dashboard-statement">
							<table class="wm-article">
								<thead>
									<th>Đồ án cơ sở / Đề án / Khóa luận</th>
									<th>Liên lạc GVHD</th>
									<th>Nộp đề cương/ kết quả</th>
									<th> Các mốc / Trạng thái</th>
								</thead>
								<tbody>
									<td rowspan="2">
										<b>ĐỒ ÁN CHUYÊN NGÀNH 2 - SE (29)</b>
									</td>
									<td>
										<div class="bg-avatar">
											<img src="https://noithatbinhminh.com.vn/wp-content/uploads/2022/08/anh-dep-40.jpg" class="avatar-teacher"/>
										</div>
									</td>
									<td>
										<p>Trưởng nhóm đề tài</p>
										<h4>XÂY DỰNG ỨNG DỤNG QUẢN LÍ ĐÀO TẠO ĐA NỀN TẢNG CHO TRƯỜNG ĐẠI HỌC</h4>
										<b>Thành viên</b>
										<p>Phạm Vương Anh Bảo (20IT414)</p>
									</td>
									<td>
										<b>- Xác nhận đề cương chi tiết:  </b>
									</td>
								</tbody>
							</table>								
					</div>
				</div>
			</div>
		</div>
		<!--// Main Section \\-->
		<style>
			table thead tr th td{
				padding: 8px;
			}
			thead{
				color: white;
				background-color: #2A3F54;
			}
			tbody{
				background-color: rgba(38,185,154,.07);
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
		</style>
@endsection