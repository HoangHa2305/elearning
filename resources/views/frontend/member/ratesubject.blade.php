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
									<h3 class="h3">Khảo sát lớp học phần</h3>
									<p class="note">Ý kiến phản hồi của sinh viên được sử dụng để nâng 
                                        cao chất lượng dạy-học, được bảo mật và không ảnh hưởng đến kết 
                                        quả học tập của sinh viên. Rất mong anh/chị nêu <b>ý kiến thẳng thắn, trung thực</b> 
                                        về lớp học phần
									</p>
									<hr>
									<div class="col-md-6">
										<h4 class="h4">Thông tin lớp học phần:</h4>
										<strong class="strong">Tên lớp học phần: <span class="red">{{$section->name}}</span></strong>
										<br>
										<strong class="strong">Mã học phần: <span class="red">{{$section->code}}</span></strong>
										<br>
										<strong class="strong">Số Tín chỉ: <span class="red">{{$section->subject->credits}}</span></strong>
										<br>
                                    <b>Lịch trình giảng dạy:</b>
									</div>
									<div class="col-md-3">
										<img src="{{asset('uploads/teacher/'.$section->teacher->avatar.'')}}" class="avatar"/>
										<br>
										<strong class="item">{{$section->teacher->name}}</strong>
									</div>
                                    <table class="wm-article">
                                        <tbody>
											<tr class="tr">
												<td id="td-left">
													<h5>
														<b class="item">I. Thông tin về học phần</b>
													</h5>
												</td>
												<td id="td">
													<div class="status">
														<div>
															<img src="{{asset('uploads/icon/hoantoankhongdongy.png')}}"/>
															<br>
															<span>Hoàn toàn không đồng ý</span>
														</div>
														<div>
															<img src="{{asset('uploads/icon/khongdongy.png')}}"/>
															<br>
															<span>Không đồng ý</span>
														</div>
														<div>
															<img src="{{asset('uploads/icon/dongymotphan.png')}}"/>
															<br>
															<span>Đồng ý một phần</span>
														</div>
														<div>
															<img src="{{asset('uploads/icon/dongy.png')}}"/>
															<br>
															<span>Đồng ý</span>
														</div>
														<div>
															<img src="{{asset('uploads/icon/hoantoandongy.png')}}"/>
															<br>
															<span>Hoàn toàn đồng ý</span>
														</div>
													</div>
												</td>
											</tr>
											<form action="" method="POST">
											<tr class="tr">
												<td id="td-left">
													<b>1. Giảng viên trình bày rõ ràng mục tiêu, phương pháp học tập, kiểm tra, 
														đánh giá học phần
													</b>
												</td>
												<td id="td">
													<div class="status">
														<div class="icon">
															<input name="section1" value="1" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoankhongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="section1" value="2" type="radio">
															<br>
															<img src="{{asset('uploads/icon/khongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="section1" value="3" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongymotphan.png')}}"/>
														</div>
														<div class="icon">
															<input name="section1" value="4" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="section1" value="5" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoandongy.png')}}"/>
														</div>
													</div>
												</td>
											</tr>
											<tr class="tr">
												<td id="td-left">
													<b>2. Giảng viên trình bày rõ ràng những yêu cầu về năng lực (khả năng) của sinh 
														viên cần phải đạt được sau khi kết thúc học phần
													</b>
												</td>
												<td id="td">
													<div class="status">
														<div class="icon">
															<input name="section2" value="1" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoankhongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="section2" value="2" type="radio">
															<br>
															<img src="{{asset('uploads/icon/khongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="section2" value="3" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongymotphan.png')}}"/>
														</div>
														<div class="icon">
															<input name="section2" value="4" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="section2" value="5" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoandongy.png')}}"/>
														</div>
													</div>
												</td>
											</tr>
											<tr class="tr">
												<td id="td-left">
													<b>3. Học phần có giáo trình/bài giảng, tài liệu tham khảo đầy đủ
													</b>
												</td>
												<td id="td">
													<div class="status">
														<div class="icon">
															<input name="section3" value="1" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoankhongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="section3" value="2" type="radio">
															<br>
															<img src="{{asset('uploads/icon/khongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="section3" value="3" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongymotphan.png')}}"/>
														</div>
														<div class="icon">
															<input name="section3" value="4" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="section3" value="5" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoandongy.png')}}"/>
														</div>
													</div>
												</td>
											</tr>
											<tr class="tr">
												<td id="td-left">
													<b>4. Giáo trình/bài giảng của học phần được biên soạn rõ ràng và phù hợp với mục tiêu của học 
														phần
													</b>
												</td>
												<td id="td">
													<div class="status">
														<div class="icon">
															<input name="section4" value="1" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoankhongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="section4" value="2" type="radio">
															<br>
															<img src="{{asset('uploads/icon/khongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="section4" value="3" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongymotphan.png')}}"/>
														</div>
														<div class="icon">
															<input name="section4" value="4" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="section4" value="5" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoandongy.png')}}"/>
														</div>
													</div>
												</td>
											</tr>
											<tr class="tr">
												<td id="td-left">
													<h5>
														<b class="item">II. Hoạt động giảng dạy</b>
													</h5>
												</td>
												<td id="td">
													<div class="status">
														<div>
															<img src="{{asset('uploads/icon/hoantoankhongdongy.png')}}"/>
															<br>
															<span>Hoàn toàn không đồng ý</span>
														</div>
														<div>
															<img src="{{asset('uploads/icon/khongdongy.png')}}"/>
															<br>
															<span>Không đồng ý</span>
														</div>
														<div>
															<img src="{{asset('uploads/icon/dongymotphan.png')}}"/>
															<br>
															<span>Đồng ý một phần</span>
														</div>
														<div>
															<img src="{{asset('uploads/icon/dongy.png')}}"/>
															<br>
															<span>Đồng ý</span>
														</div>
														<div>
															<img src="{{asset('uploads/icon/hoantoandongy.png')}}"/>
															<br>
															<span>Hoàn toàn đồng ý</span>
														</div>
													</div>
												</td>
											</tr>
											<tr class="tr">
												<td id="td-left">
													<b>5. Giảng viên đảm bảo giờ lên lớp, nội dung và kế hoạch giảng dạy
													</b>
												</td>
												<td id="td">
													<div class="status">
														<div class="icon">
															<input name="teaching1" value="1" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoankhongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching1" value="2" type="radio">
															<br>
															<img src="{{asset('uploads/icon/khongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching1" value="3" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongymotphan.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching1" value="4" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching1" value="5" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoandongy.png')}}"/>
														</div>
													</div>
												</td>
											</tr>
											<tr class="tr">
												<td id="td-left">
													<b>6. Giảng viên sử dụng thời gian trên lớp hiệu quả
													</b>
												</td>
												<td id="td">
													<div class="status">
														<div class="icon">
															<input name="teaching2" value="1" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoankhongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching2" value="2" type="radio">
															<br>
															<img src="{{asset('uploads/icon/khongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching2" value="3" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongymotphan.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching2" value="4" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching2" value="5" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoandongy.png')}}"/>
														</div>
													</div>
												</td>
											</tr>
											<tr class="tr">
												<td id="td-left">
													<b>7. Giảng viên giải thích về ý nghĩa và khả năng ứng dụng của kiến thức liên quan 
														đến học phần
													</b>
												</td>
												<td id="td">
													<div class="status">
														<div class="icon">
															<input name="teaching3" value="1" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoankhongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching3" value="2" type="radio">
															<br>
															<img src="{{asset('uploads/icon/khongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching3" value="3" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongymotphan.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching3" value="4" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching3" value="5" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoandongy.png')}}"/>
														</div>
													</div>
												</td>
											</tr>
											<tr class="tr">
												<td id="td-left">
													<b>8. Giảng viên thể hiện sự nhiệt tình, tạo điều kiện thuận lợi để sinh 
														viên tiếp xúc, trao đổi.
													</b>
												</td>
												<td id="td">
													<div class="status">
														<div class="icon">
															<input name="teaching4" value="1" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoankhongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching4" value="2" type="radio">
															<br>
															<img src="{{asset('uploads/icon/khongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching4" value="3" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongymotphan.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching4" value="4" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching4" value="5" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoandongy.png')}}"/>
														</div>
													</div>
												</td>
											</tr>
											<tr class="tr">
												<td id="td-left">
													<b>9. Giảng viên khuyến khích suy nghĩ độc lập và ý kiến phản biện của 
														sinh viên, khơi dậy sự thích thú, sự động não của người học
													</b>
												</td>
												<td id="td">
													<div class="status">
														<div class="icon">
															<input name="teaching5" value="1" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoankhongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching5" value="2" type="radio">
															<br>
															<img src="{{asset('uploads/icon/khongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching5" value="3" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongymotphan.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching5" value="4" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching5" value="5" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoandongy.png')}}"/>
														</div>
													</div>
												</td>
											</tr>
											<tr class="tr">
												<td id="td-left">
													<b>10. Giảng viên khuyến khích sự hợp tác thông qua làm việc nhóm, tạo nhiều cơ 
														hội để sinh viên học thông qua các hoạt động.
													</b>
												</td>
												<td id="td">
													<div class="status">
														<div class="icon">
															<input name="teaching6" value="1" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoankhongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching6" value="2" type="radio">
															<br>
															<img src="{{asset('uploads/icon/khongdongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching6" value="3" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongymotphan.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching6" value="4" type="radio">
															<br>
															<img src="{{asset('uploads/icon/dongy.png')}}"/>
														</div>
														<div class="icon">
															<input name="teaching6" value="5" type="radio">
															<br>
															<img src="{{asset('uploads/icon/hoantoandongy.png')}}"/>
														</div>
													</div>
												</td>
											</tr>
											<tr class="tr">
												<td id="td-left">
													<h5>
														<b class="item">28. Ý kiến của Anh/Chị về lớp học phần và 
															đề xuất để cải tiến chất lượng:
														</b>
													</h5>
												</td>
											</tr>
											<tr class="tr">
												<td id="td-left" colspan="2">
													<b>a. Về nội dung, cấu trúc của học phần: (độ khó; sự cần thiết; phân 
														phối thời gian , …)
													</b>
													<br>
													<textarea id="textarea" name="about_content_section" class="form-control"></textarea>
												</td>
											</tr>
											<tr class="tr">
												<td id="td-left" colspan="2">
													<b>b. Về giáo trình, tài liệu phục vụ học phần (có đầy đủ, rõ ràng, phù 
														hợp không; có dễ dàng tìm thấy trong thư viện hoặc từ nguồn khác 
														không; có kịp thời cho việc chuẩn bị, ôn tập không,...)
													</b>
													<br>
													<textarea id="textarea" name="about_curriculum" class="form-control"></textarea>
												</td>
											</tr>
											<tr class="tr">
												<td id="td-center" colspan="2">
													<button class="btn btn-success btn-lg" type="submit">Đánh giá</button>
												</td>
											</tr>
											@csrf
											</form>
										</tbody>
                                    </table>							
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
			.h3{
				font-size: 24px;
				font-family: 'Inter', sans-serif;
			}
			.h4{
				font-family: 'Inter', sans-serif;
				color: red;
				font-weight: bold;
			}
			.strong{
				color: #73879C;
				font-weight: 700;
			}
			#textarea{
				height: 80px;
			}
			.btn-success{
				background-color: #26B99A;
				border: 1px solid #169F85;
			}
			.item{
				font-family: 'Inter', sans-serif;
				font-weight: 700;
				color: red;
				font-size: 14px;
			}
			.red{
				color: red;
			}
			.avatar{
				width: 100px;
				height: 135px;
				border-radius: 50%;
			}
			#td{
				border-left: none;
				border-right: none;
				padding: 10px;
			}
			#td-left{
				border-left: none;
				border-right: none;
				padding: 10px;
                margin-left: 10px;
				text-align: left;
			}
			#td-center{
				border-left: none;
				border-right: none;
				padding: 10px;
                margin-left: 10px;
				text-align: center;
			}
			tr.tr:hover{
				background-color: #dff0d8;
			}
			.semester{
				font-weight: bold;
				color: black;
				background-color: #d3f1d3;
			}
			.note{
				font-size: 14px;
				text-align: left;
				color: #73879C;
			}
			.status{
                display: flex;
                padding-left: 10px;
			}
            .icon{
                margin-left: 70px;
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