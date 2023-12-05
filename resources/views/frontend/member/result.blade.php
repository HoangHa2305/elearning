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
									<h4>Điểm tổng kết</h4>
									<hr>
									<table class="wm-article">
										<thead>
											<th>#</th>
											<th>Học kỳ</th>
											<th>Số TC-ĐK</th>
											<th>Số TC-ĐK Mới</th>
											<th>Điểm 4</th>
											<th>Điểm 10</th>
											<th>Điểm HB</th>
											<th>TC TL HK</th>
											<th>Xếp loại</th>
											<th>Điểm 4 TL</th>
											<th>Điểm 10 TL</th>
											<th>TC tích lũy</th>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>Học kỳ 1, năm 2020 - 2021</td>
												<td>17</td>
												<td>17</td>
												<td>
													<b>
														<code class="classification">3.06</code>
													</b>
												</td>
												<td>7.8</td>
												<td>7.8</td>
												<td>17</td>
												<td>
													<b>
														<code class="classification">Khá</code>
													</b>
												</td>
												<td>3.06</td>
												<td>7.8</td>
												<td>17</td>
											</tr>
										</tbody>
									</table>
									<hr>
									<h4>Điểm các lớp học phần</h4>
									<p id="note">Để xem điểm thành phần, sau khi GV xác nhận nhập điểm đồng 
										thời Phòng KT&ĐBCLGD chốt điểm với với bản chính, sinh viên 
										phải thực hiện đánh giá lớp học phần và sự cần thiết của học 
										phần.
									</p>
									<hr>
                                    <table class="wm-article">
                                        <thead>
                                            <th>STT</th>
                                            <th>Tên học phần</th>
                                            <th>Số TC</th>
                                            <th>Lần học</th>
                                            <th>Điểm CC / GVHD</th>
                                            <th>Điểm bài tập</th>
                                            <th>Điểm giữa kì</th>
                                            <th>Điểm cuối kì / Đồ án</th>
                                            <th>Điểm T10</th>
                                            <th>Điểm chữ</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="10" class="semester">Học kỳ riêng - Quy đổi</td>
                                            </tr>
											@php $i = 0; @endphp
                                            @foreach($semesters as $semester)
                                            <tr>
                                                <td colspan="10" class="semester">{{$semester->name}} - {{$semester->get_yearstudy->name}}</td>
                                            </tr>
											@foreach($scores as $score)
											@if($semester->id == $score->id_semester)
											@php $i++; @endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{$score->section->subject->name}}</td>
												<td>{{$score->section->subject->credits}}</td>
												<td>{{$score->session}}</td>
												<td>
													@if($score->diligence_score)
													{{$score->diligence_score}}
													@endif
												</td>
												<td>
													@if($score->homework_score)
													{{$score->homework_score}}
													@endif
												</td>
												<td>
													@if($score->midterm_score)
													{{$score->midterm_score}}
													@endif
												</td>
												<td>
													@if($score->final_score)
													{{$score->final_score}}
													@endif
												</td>
												<td>
													@if($score->sum_t10_score)
														{{$score->sum_t10_score}}
													@endif
												</td>
												<td>
													@if($score->sum_t10_score)
														@if($score->sum_t10_score >= 8.5)
														<b class="success_score">A</b>
														@elseif($score->sum_t10_score >= 7 && $score->sum_t10_score <= 8.4)
														<b class="primary_score">B</b>
														@elseif($score->sum_t10_score >= 5.5 && $score->sum_t10_score <= 6.9)
														<b class="basic_score">C</b>
														@elseif($score->sum_t10_score >= 4 && $score->sum_t10_score <= 5.4)
														<b class="warning_score">D</b>
														@else
														<b class="danger_score">F</b>
														@endif
													@endif
												</td>
											</tr>
											@endif
											@endforeach
											@if(!empty($projects))
											@foreach($projects as $project)
											@if($semester->id == $project->id_semester)
											@php $i++; @endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{$project->title}}</td>
												<td>{{$project->credits}}</td>
												<td>{{$project->session}}</td>
												<td>
													@if(!empty($project->diligence_score))
														{{$project->diligence_score}}
													@endif
												</td>
												<td></td>
												<td></td>
												<td>
													@if(!empty($project->diligence_score))
														{{$project->diligence_score}}
													@endif
												</td>
												<td></td>
												<td>
													@if($project->sum_t10_score)
														@if($project->sum_t10_score >= 8.5)
														<b class="success_score">A</b>
														@elseif($project->sum_t10_score >= 7 && $project->sum_t10_score <= 8.4)
														<b class="primary_score">B</b>
														@elseif($project->sum_t10_score >= 5.5 && $project->sum_t10_score <= 6.9)
														<b class="basic_score">C</b>
														@elseif($project->sum_t10_score >= 4 && $project->sum_t10_score <= 5.4)
														<b class="warning_score">D</b>
														@else
														<b class="danger_score">F</b>
														@endif
													@endif
												</td>
											</tr>
											@endif
											@endforeach
											@endif
                                            @endforeach
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
            thead {
				background-color: #73879C;
				color: white;
				font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
			}
			.semester{
				font-weight: bold;
				color: black;
				background-color: #d3f1d3;
			}
			#note{
				font-size: 14px;
				text-align: center;
				color: #73879C;
			}
			.classification{
				padding: 2px 4px;
				color: #c7254e;
				background-color: #f9f2f4;
				border-radius: 4px;
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