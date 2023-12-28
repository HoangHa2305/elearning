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
								<h4 class="title">Lớp học phần {{$section->name}} <u></u></h4>	
                                <p>Giảng viên phụ trách: {{$section->teacher->name}}</i></p>						
							</div>
							<div class="wm-student-dashboard-statement wm-dashboard-statement">
                                <form action="" method="POST">
                                    <div class="layout">
                                        <label>Thời gian nghỉ: </label>
                                        <input type="date" name="date" class="form-control"/>
                                    </div>
                                    <div class="layout">
                                        <label>Lí do: </label>
                                        <input type="text" name="reason" class="form-control"/>
                                    </div>
                                    <div class="layout-center">
										<input type="hidden" name="section_id" value="{{$section->id}}"/>
                                        <button type="submit" class="btn btn-success">Báo nghỉ</button>
                                    </div>
                                @csrf
                                </form>
						</div>
					</div>
				</div>
			</div>
			<!--// Main Section \\-->
		</div>
		<div id="show"></div>
		<!--// Main Content \\-->
        <style>
           .layout{
                margin-top: 20px;
           }
           .layout-center{
                margin-top: 20px;
                text-align: center;
           }
           .title{
                font-family: 'Inter', sans-serif;
           }
        </style>
@endsection		