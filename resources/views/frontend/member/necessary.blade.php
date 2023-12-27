@extends('frontend.layouts.app')
@section('content')
<!--// Mini Header \\-->
<div class="wm-mini-header">
			<span class="wm-blue-transparent"></span>
			 <div class="container">
			    <div class="row">
				    <div class="col-md-12">
				        <div class="wm-mini-title">
				       		<h1>Kết quả học tập</h1> 
				        </div>
				        <div class="wm-breadcrumb">
				          	<ul>
				          	 	<li><a href="index-2.html">Trang chủ</a></li>
				          	 	<li><a href="#">Sinh viên</a></li>
				           		<li>Kết quả học tập</li>
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
                                    <h4 class="topic">Đánh giá sự cần thiết của các học phần đã học</h4>
                                    <hr style="border: 1px solid #E6E9ED;">		
                                    <form action="" method="POST">					 
									<table class="wm-article">
										<thead>
											<th id="th-left">#</th>
											<th id="th-left">Tên lớp học phần</th>
											<th id="th-left">Số TC</th>
											<th id="th-left">Nội dung</th>
											<th id="th-left">Đánh giá sự cần thiết của học phần</th>
											<th id="th-left">Góp ý thêm</th>
										</thead>
										<tbody>
                                            <tr>
                                                <td colspan="10" class="semester">{{$semester}} - </td>
                                            </tr>
                                            <tr>
                                                <td id="td-left">1</td>
                                                <td id="td-left">{{$section->subject->name}}</td>
                                                <td id="td-left">{{$section->subject->credits}}</td>
                                                <td id="td-left"><i class="fa fa-print"></i></td>
                                                <td id="td-center">
                                                    <div class="status">
														<div class="icon">
															<input name="necessary" value="1" type="radio">
															<br>
															<img src="{{asset('uploads/icon/khongdongy.png')}}"/>
                                                            <label>Không cần thiết</label>
														</div>
														<div class="icon">
															<input name="necessary" value="2" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongymotphan.png')}}"/>
                                                            <label>Cần thiết</label>
														</div>
														<div class="icon">
															<input name="necessary" value="3" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongy.png')}}"/>
                                                            <label>Rất cần thiết</label>
														</div>
													</div>
                                                </td>
                                                <td id="td-left">
                                                    <textarea id="textarea" name="feedback" class="form-control" 
                                                        placeholder="Ghi chú góp ý thêm cho môn học tại đây"></textarea>
                                                </td>
                                            </tr>
										</tbody>
									</table>	
                                    <center>
                                        <button class="btn btn-success" type="submit">Cập nhật</button>
                                    </center>
                                    @csrf
                                    </form>
                                    <i>
                                        Lưu ý: Bạn chưa thể đánh giá được đối với các học phần chưa hoàn 
                                        thành và chưa có điểm kết thúc học phần
                                    </i>					
								</div>
							</div>
                        </div>
					</div>
				</div>
			</div>
			<!--// Main Section \\-->
			<div id='show'></div>
            <!--// Main Section \\-->
		</div>
		<!--// Main Content  #2A3F54\\-->
        <style>
            .topic{
                font-family: 'Inter', sans-serif;
				font-size: 20px;
            }
            thead {
				background-color: #73879C;
				color: white;
				font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
			}
			#td{
				border-left: none;
				border-right: none;
				padding: 10px;
			}
            .btn-success{
                background: #26B99A;
                border: 1px solid #169F85;
                text-align: center;
                border-radius: 3px;
                margin-bottom: 10px;
            }
            #textarea{
                margin-top: 10px;
                margin-left: 20px;
                vertical-align: top;
                width: 200px;
            }
			#td-left{
				border-left: none;
				border-right: none;
				padding: 10px;
				text-align: left;
			}
            #th-left{
				border-left: none;
				border-right: none;
				text-align: left;
			}
            #td-center{
				border-left: none;
				border-right: none;
				padding: 10px;
                margin-left: 10px;
				text-align: center;
			}
			.tr{
				background-color: #f9f9f9;
			}
            .semester{
				font-weight: bold;
				color: black;
				background-color: #d3f1d3;
			}
            .status{
                display: flex;
                padding-left: 10px;
			}
            .icon{
                margin-left: 70px;
            }
        </style>
		<script>
			$(document).ready(function() {
				$.ajaxSetup({ 
					headers: { 
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
					} 
                });

			});
		</script>
@endsection		