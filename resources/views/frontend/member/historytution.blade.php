@extends('frontend.layouts.app')
@section('content')
<!--// Mini Header \\-->
<div class="wm-mini-header">
			<span class="wm-blue-transparent"></span>
			 <div class="container">
			    <div class="row">
				    <div class="col-md-12">
				        <div class="wm-mini-title">
				       		<h1>Học phí đã nộp</h1> 
				        </div>
				        <div class="wm-breadcrumb">
				          	<ul>
				          	 	<li><a href="index-2.html">Trang chủ</a></li>
				          	 	<li><a href="#">Sinh viên</a></li>
				           		<li>Học phí đã nộp</li>
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
									<h4 id="h4">Danh sách học phí đã nộp (cập nhật từ 12/2019)</h4>
                                    <table class="wm-article">
                                        <thead>
                                            <th>STT</th>
                                            <th>Số biên lai</th>
                                            <th>Số tiền</th>
                                            <th>Người thu</th>
                                            <th>Ngày thu</th>
                                            <th>Biên lai</th>
                                        </thead>
                                        <tbody>
                                            @php $i = 0; @endphp
                                            @foreach($tutions as $tution)
                                            @php $i++; @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$tution->code}}</td>
                                                <td>{{number_format($tution->total,0,3)}}</td>
                                                <td>{{$tution->collector}}</td>
                                                <td>{{$tution->date}}</td>
                                                <td>{{$tution->code}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <p>Lưu ý: Các khoản phí tạm phí của Tân sinh viên sẽ sớm được cập nhật</p>
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
            tr.tr:hover{
				background-color: rgba(38,185,154,.07);
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
            #h4{
                font-family: Arial, Helvetica, sans-serif;
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