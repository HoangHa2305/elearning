@extends('frontend.layouts.app')
@section('content')
<!--// Mini Header \\-->
<div class="wm-mini-header">
			<span class="wm-blue-transparent"></span>
			 <div class="container">
			    <div class="row">
				    <div class="col-md-12">
				        <div class="wm-mini-title">
				       		<h1>Học phí sắp tới</h1> 
				        </div>
				        <div class="wm-breadcrumb">
				          	<ul>
				          	 	<li><a href="index-2.html">Trang chủ</a></li>
				          	 	<li><a href="#">Sinh viên</a></li>
				           		<li>Học phí</li>
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
									<h4>Hình thức nộp học phí theo thông báo chính thức của Phòng Kế hoạch Tài Chính</h4>
                                    <table class="wm-article">
                                        <thead>
                                            <th>STT</th>
                                            <th>Lớp học phần</th>
                                            <th>Lần học</th>
                                            <th>Số tín chỉ</th>
                                            <th>Tiền học</th>
                                            <th>Hóa đơn</th>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                                $price = 335100;
                                                $totalcredits = 0;
                                                $subtotal = 0;
                                            @endphp
                                            @foreach($sections as $section)
                                            @php 
                                                $i++; 
                                                $credit = $section->section->subject->credits;
                                                $totalcredits += $credit;
                                                $total = $price * $credit;
                                                $subtotal += $total;
                                            @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td id="name">{{$section->section->name}}</td>
                                                <td>{{$section->session}}</td>
                                                <td>{{$credit}}</td>
                                                <td>{{number_format($total,0,3)}}</td>
                                                <td>Học mới</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td></td>
                                                <td colspan="2">Tổng</td>
                                                <td>{{$totalcredits}}</td>
                                                <td><strong id="total">{{number_format($subtotal,0,3)}}</strong></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div>
                                        <p id="h6">Tổng TC: <strong id="main">{{$totalcredits}}</strong> TC (Đơn giá: 335,100đ / TC)</p>
                                        <p id="h6">Danh sách học phí và các khoản phí đã nộp học kỳ này</p>
                                    </div>		
                                    <table>
                                        <tr>
                                            <td>STT</td>
                                            <td>Số biên lai</td>
                                            <td>Biên lai</td>
                                            <td>Người thu</td>
                                            <td>Ngày thu</td>
                                        </tr>
                                    </table>	
                                    <div>
                                        <button class="btn btn-danger" disabled>Bạn chưa nộp học phí</button>
                                        <div class="right">
                                            <form method="POST" action="{{URL('sv\thanh-toan-hoc-phi')}}">
                                                @csrf
                                                <input type="hidden" name="total" value="{{$subtotal}}"/>
                                                <button class="btn btn-pink" >Thanh toán học phí trực tuyến</button>
                                            </form>
                                        </div>	
                                    </div>			
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
		<!--// Main Content \\-->
        <style>
            body{
                color: #73879C;
            }
            #total{
                color: #73879C;
            }
            thead {
				background-color: #73879C;
				color: white;
				font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
			}
            #h6{
                font-family: Arial, Helvetica, sans-serif;
                color: #73879C;
                font-size: 17px;
            }
            #main{
                color: red;
            }
			#name{
                text-align: left;
            }
            .right{
                float: right;
            }
            .btn-pink {
                background-color: #c1177c;
                color: white;
            }
            .btn-pink:hover{
                color: white;
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