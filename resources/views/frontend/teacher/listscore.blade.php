@extends('frontend.layouts.app')
@section('content')
<!--// Mini Header \\-->
<div class="wm-mini-header">
			<span class="wm-blue-transparent"></span>
			 <div class="container">
			    <div class="row">
				    <div class="col-md-12">
				        <div class="wm-mini-title">
				       		<h1>Quản lý điểm các lớp học phần</h1> 
				        </div>
				        <div class="wm-breadcrumb">
				          	<ul>
				          	 	<li><a href="index-2.html">Trang chủ</a></li>
				          	 	<li><a href="#">Giảng viên</a></li>
				           		<li>Quản lý điểm</li>
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
								<h4>Danh sách các lớp học phần giảng dạy</h4>							
							</div>
							<div class="wm-student-dashboard-statement wm-dashboard-statement">
								<table class="wm-article">
									<thead>
										<th>STT</th>
										<th>Lớp học phần</th>
										<th>Thời khóa biểu</th>
										<th>Trạng thái</th>
										<th>Quản lý lớp</th>
									</thead>
									<tbody>
										@php $i = 0; @endphp
                                        @foreach($sections as $section)
										@php $i++; @endphp
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$section->name}}</td>
											<td>Hai / 1->2</td>
											<td><b>Lớp đã kết thúc</b></td>
											<td>
												<a href="{{URL('gv/quan-ly-diem/'.$section->id.'')}}" class="wm-register">Quản lí điểm</a>
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
		</div>
		<!--// Main Content \\-->
		<style>
			.wm-register{
				background-color: #26B99A;
				color: #fff;
				padding-left: 15px;
				padding-top: 6px;
				padding-right: 15px;
				padding-bottom: 8px;
				border: none;
				border-radius: 4px;
				font-size: 14px;
				cursor: pointer;
				transition: background-color 0.3s ease;
			}
			.btn{
				background-color: #EDEDED;
				color: black;
				padding-left: 8px;
				padding-right: 8px;
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
@endsection		