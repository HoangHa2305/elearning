@extends('frontend.layouts.app')
@section('content')
<!--// Mini Header \\-->
<div class="wm-mini-header">
			<span class="wm-blue-transparent"></span>
			 <div class="container">
			    <div class="row">
				    <div class="col-md-12">
				        <div class="wm-mini-title">
				       		
				        </div>
				        <div class="wm-breadcrumb">
				          	<ul>
				          	 	<li><a href="index-2.html">Trang chủ</a></li>
				          	 	<li><a href="#">Chi tiết</a></li>
				           		<li>Nhóm đồ án</li>
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

							</div>
							<div class="wm-student-dashboard-statement wm-dashboard-statement">
                            <table>
                                <tr>
                                    <td>
                                        <p>Tên đề tài:</p>
                                    </td>
                                    <td colspan="4">
                                        <b>{{!empty($report->title) ? $report->title : 'Chưa đăng kí đề tài'}}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Nhóm trưởng</p>
                                    </td>
                                    <td>
                                        <p>{{$report->student->name}} - {{$report->student->code}}</p>
                                    </td>
                                    <td>
                                        <p>Thông tin liên hệ:</p>
                                        <p>{{$report->student->phone}}</p>
                                        <p>{{$report->student->email}}</p>
                                    </td>
                                    <td colspan="2">
                                        <p>Thành viên: Không có</p>
                                    </td>
                                </tr>
                                <tr id="{{$report->id}}">
                                    <td>
                                        <p>Đề cương chi tiết: </p>	
                                    </td>
                                    <td>
                                        @if(!empty($report->topic))
                                        <a class="view" href="{{URL('dowload/topic/'.$report->topic.'')}}">Xem đề cương chi tiết</a>
                                        @else
                                        <p>Chưa nộp</p>
                                        @endif
                                    </td>
                                    <td>
                                        <p>
                                            Mô tả: 
                                            @if(!empty($report->desc_topic))
                                                {{$report->desc_topic}}
                                            @endif
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            Ngày nộp:
                                            @if(!empty($report->date_topic))
                                                {{$report->date_topic}}
                                            @endif
                                        </p>
                                    </td>
                                    <td>
                                        @if($report->confirm)
                                        <button id="btn-confirm" class="wm-cancel">Hủy</button>
                                        @else
                                        <button id="btn-confirm" class="wm-register">Duyệt</button>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Kết quả thực hiện: </p>
                                    </td>
                                    <td>
                                        @if(!empty($report->report))

                                        @else
                                        <p>Chưa nộp</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($report->desc_report))
                                        <p>Đường dẫn mã nguồn:</p>
                                        @else
                                        <p>Đường dẫn mã nguồn:</p>
                                        @endif
                                    </td>
                                    <td>
                                        <p>Ngày nộp:</p> 
                                    </td>
                                    <td>
                                        <button class="wm-register">Duyệt</button>
                                    </td>
                                </tr>
                            </table>				
						</div>
					</div>
				</div>
			</div>
			<!--// Main Section \\-->
		</div>
		<div id="show"></div>
		<!--// Main Content \\-->
		<style>
			#box{
				display: flex;
			}
			.flex{
				margin-left: 38%;
			}
			.absent{
				display: flex;
			}
			.view {
				color: #4FA0AB;
			}
			#p{
				margin-left: 20px;
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
			.wmicon-tool{
				color: #6c8391;
				font-size: 12px;
			}
			.note{
				color: #6c8391;
				font-size: 14px;
			}
			.wm-register{
				background-color: #26B99A;
				color: #fff;
				padding-left: 25px;
				padding-right: 25px;
				border: none;
				border-radius: 4px;
				font-size: 14px;
				cursor: pointer;
				transition: background-color 0.3s ease;
				width: 120px;
			}
			.submit-all{
				background-color: #26B99A;
				color: #fff;
				border: none;
				padding: 10px 10px 10px 10px;
				border-radius: 4px;
				font-size: 14px;
				cursor: pointer;
				transition: background-color 0.3s ease;
			}
			td{
				text-align: left;
				padding-top: 10px;
				padding-bottom: 30px;
			}
			.textarea{
				width: 120px;
			}
			#note{
				text-align: left;
			}
			#content{
				background-color: white;
				border: 1px solid black;
			}
			#submit{
				padding-top: 8px;
				padding-bottom: 8px;
				margin-top: 20px;
			}
			#center{
				text-align: center;
				align-items: center;
			}
			.wm-cancel{
				background-color: #f0ad4e;
				color: #fff;
				padding-left: 25px;
				padding-right: 25px;
				border: none;
				border-radius: 4px;
				font-size: 14px;
				cursor: pointer;
				width: 120px;
				transition: background-color 0.3s ease;
			}
			.vm-danger{
				background-color: #d9534f;
				color: #fff;
				padding-left: 25px;
				padding-right: 25px;
				border: none;
				border-radius: 4px;
				font-size: 14px;
				cursor: pointer;
				width: 120px;
				transition: background-color 0.3s ease;
			}
			.vm-primary{
				background-color: #286090;
				color: #fff;
				padding-left: 25px;
				padding-right: 25px;
				border: none;
				border-radius: 4px;
				font-size: 14px;
				cursor: pointer;
				width: 120px;
				transition: background-color 0.3s ease;
			}

			table {
				font-family: Arial, sans-serif;
			}

			#header{
				background-color: white;
				color: rgba(52,73,94,.94);
				font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
			}
			.title{
				font-family: Roboto, sans-serif;
				font-weight: bold;
			}

			.custom-alert {
				display: none;
				position: fixed;
				width: 90%;
				top: 40%;
				left: 50%;
				transform: translate(-50%, -50%);
				background-color: white;
				border: 1px solid #ccc;
				padding: 20px;
				box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.1);
			}

			.close-btn {
				position: absolute;
				top: 10px;
				font-size: 20px;
				right: 5px;
				cursor: pointer;
			}
		</style>
		<script>
			$(document).ready(function(){
                $.ajaxSetup({ 
					headers: { 
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
					} 
                });

                $("#btn-confirm").click(function(){
                    $(this).attr('class','wm-cancel').text("Hủy");
                    var id = $(this).closest("tr").attr("id");
                    $.ajax({
                        url:"{{URL('gv/xac-nhan-de-cuong')}}",
                        type:"POST",
                        data:{
                            id:id
                        },
                        success:function(response){
                            if(response.success){
                                
                            }
                        }
                    });
                });
            });
		</script>
@endsection		