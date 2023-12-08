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
                                    <td class="title">
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
                                        <p class="align-left">{{$report->student->name}} - {{$report->student->code}}</p>
                                    </td>
                                    <td class="info">
                                        <p class="align-left">Thông tin liên hệ:</p>
                                        <p class="align-left">{{$report->student->phone}}</p>
                                        <p class="align-left">{{$report->student->email}}</p>
                                    </td>
                                    <td colspan="2">
										<p class="align-left">Thành viên: 
										@if(!collect($parents)->contains('id_parent',$report->id))
											Không có
										@else
											@foreach($parents as $parent)
											@if($parent->id_parent == $report->id)
												{{$parent->student->name}} - {{$parent->student->code}}</p>
											@endif
											@endforeach
										@endif
                                    </td>
                                </tr>
                                <tr id="{{$report->id}}">
                                    <td>
                                        <p>Đề cương chi tiết: </p>	
                                    </td>
                                    <td class="topic">
                                        @if(!empty($report->topic))
										<p class="align-left">
                                        	<a class="view" href="{{URL('dowload/topic/'.$report->topic.'')}}">Xem đề cương chi tiết</a>
										</p>
                                        @else
                                        <p>Chưa nộp</p>
                                        @endif
                                    </td>
                                    <td>
                                        <p class="align-left">
                                            Mô tả: 
                                            @if(!empty($report->desc_topic))
                                                {{$report->desc_topic}}
                                            @endif
                                        </p>
                                    </td>
                                    <td>
                                        <p class="align-left">
                                            Ngày nộp:
                                            @if(!empty($report->date_topic))
                                                {{$report->date_topic}}
                                            @endif
                                        </p>
                                    </td>
                                    <td>
										@if($report->topic!=null)
                                        @if($report->confirm==1)
                                        <button id="btn-cancel" class="wm-cancel">Hủy</button>
                                        @else
                                        <button id="btn-confirm" class="wm-register">Duyệt</button>
                                        @endif
										@endif
                                    </td>
                                </tr>
                                <tr id="{{$report->id}}">
                                    <td>
                                        <p>Kết quả thực hiện: </p>
                                    </td>
                                    <td>
                                        @if(!empty($report->report))
										<p class="align-left">
                                        	<a class="view" href="{{URL('dowload/topic/'.$report->report.'')}}">Xem báo cáo</a>
										</p>
                                        @else
                                        <p>Chưa nộp</p>
                                        @endif
                                    </td>
                                    <td>
                                        <p class="align-left">
											Đường dẫn mã nguồn:
											@if(!empty($report->desc_report))
											{{$report->desc_report}}
											@endif
										</p>
                                    </td>
                                    <td>
                                        <p class="align-left">
											Ngày nộp:
											@if(!empty($report->date_report))
                                                {{$report->date_report}}
                                            @endif
										</p> 
                                    </td>
                                    <td>
										@if(!empty($report->report))
											@if($report->status==1)
											<button id="btn-destroy" class="wm-cancel">Hủy</button>
											@else
											<button id="btn-status" class="wm-register">Duyệt</button>
											@endif
										@endif
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
            .align-left{
                text-align: left;
            }
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
			.info{
				width: 300px;
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
			.title{
				width: 150px;		
			}
			.topic{
				width: 180px;
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

                $(document).on('click','#btn-confirm',function(){
                    $(this).attr('class','wm-cancel').attr('id','btn-cancel').text("Hủy");
                    var id = $(this).closest("tr").attr("id");
                    $.ajax({
                        url:"{{URL('gv/xac-nhan-de-cuong')}}",
                        type:"POST",
                        data:{
                            id:id,
                            type:1
                        },
                    });
                });
                $(document).on('click','#btn-cancel',function(){
                    $(this).attr('class','wm-register').attr('id','btn-confirm').text("Duyệt");
                    var id = $(this).closest("tr").attr("id");
                    $.ajax({
                        url:"{{URL('gv/xac-nhan-de-cuong')}}",
                        type:"POST",
                        data:{
                            id:id,
                            type:0
                        },
                    });
                });
                $(document).on('click','#btn-status',function(){
                    $(this).attr('class','wm-cancel').attr('id','btn-destroy').text("Hủy");
                    var id = $(this).closest("tr").attr("id");
                    $.ajax({
                        url:"{{URL('gv/xac-nhan-bao-cao')}}",
                        type:"POST",
                        data:{
                            id:id,
                            type:1
                        }
                    });
                });
                $(document).on('click','#btn-destroy',function(){
                    $(this).attr('class','wm-register').attr('id','btn-status').text("Duyệt");
                    var id = $(this).closest("tr").attr("id");
                    $.ajax({
                        url:"{{URL('gv/xac-nhan-bao-cao')}}",
                        type:"POST",
                        data:{
                            id:id,
                            type:0
                        }
                    });
                });
            });
		</script>
@endsection		