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

		<!--// Main Content \\-->
		<div class="wm-main-content">

			<!--// Main Section \\-->
			<div class="wm-main-section">
				<div class="container">
					<div class="row">
						<aside class="col-md-4">
							<div class="wm-student-dashboard-nav">
								<div class="wm-student-nav" id="wm-student-nav">
									<figure>
										<a href="#"><img src="{{asset('uploads/student/'.$student->avatar.'')}}" alt="" id="avatar"></a>
									</figure>
									<div class="wm-student-nav-text" id="wm-student-nav-text">
										<h6>{{$student->name}}</h6>
										<p>MSV {{$student->code}}</p>
                                        <p>Lớp {{$student->activity_class->code}}</p>
                                        <p>{{$student->get_yeartrain->name}}</p>
									</div>
									<ul>
                                        <li class="active">
											<a href="#">
												<i class="wmicon-avatar"></i>
												Xuất lý lịch
											</a>
										</li>
									</ul>
								</div>
							</div>														
						</aside>
						<div class="col-md-8">
							<div class="wm-student-settings-info">							
								<div class="wm-student-dashboard-settings">
									<div class="wm-plane-title">
										<h4>Thông tin cá nhân</h4>
									</div>
									<form>
										<ul>
											<li>
                                                <label>Họ và tên</label>
                                                <input type="text" id="input" value="{{$student->name}}" readonly>
                                            </li>
											<li>
                                                <label>Ngày sinh</label>
                                                <input type="text" id="input" value="{{date('d-m-Y',strtotime($student->birth))}}" readonly>
                                            </li>
											<li>
                                                <label>Quê quán</label>
                                                <input type="text" id="input" value="{{$student->country}}" readonly>
                                            </li>
											<li>
                                                <label>Giới tính</label>
                                                <input type="text" id="input" value="{{$student->sex==0 ? 'Nam':'Nữ'}}" readonly>
                                            </li>
                                            <li>
                                                <label>Dân tộc</label>
                                                <input type="text" id="input" value="{{$student->nation}}" readonly>
                                            </li>
                                            <li>
                                                <label>Tôn giáo</label>
                                                <input type="text" id="input" value="{{$student->religion}}" readonly>
                                            </li>
                                            <li>
                                                <label>Số CMND</label>
                                                <input type="text" id="input" value="{{$student->citizen}}" readonly>
                                            </li>
											<li>
                                                <label>Đoàn thể</label>
                                                <input type="text" id="input" value="{{$student->union ? date('d-m-Y',strtotime($student->date_admission)) : 'Không'}}" readonly>
                                            </li>																	 
		                                </ul>
									</form>
								</div>
                                <div class="wm-student-dashboard-settings">
									<div class="wm-plane-title">
										<h4>Thường trú và địa chỉ</h4>
									</div>
									<form>
										<ul>
											<li>
                                                <input type="text" id="input" value="{{$student->address}}" readonly>
                                            </li>																 
		                                </ul>
									</form>
								</div>
                                <div class="wm-student-dashboard-settings">
									<div class="wm-plane-title">
										<h4>Thông tin liên hệ</h4>
									</div>
									<form>
										<ul>
											<li>
                                                <label>Email</label>
                                                <input type="text" id="input" value="{{$student->email}}" readonly>
                                            </li>	
                                            <li>
                                                <label>Điện thoại</label>
                                                <input type="text" id="input" value="{{$student->phone}}" readonly>
                                            </li>																 
		                                </ul>
									</form>
								</div>
							</div>
						</div>					
					</div>
				</div>
			</div>
			<!--// Main Section \\-->

		</div>
		<!--// Main Content \\-->
        <style>
			#wm-student-nav{
				background-color: #F5FBFD;
			}
            #avatar{
                height: 120px;
                border-radius: 50%;
            }
            #input{
                font-style: normal;
            }
        </style>
@endsection