@extends('frontend.layouts.app')
@section('content')
<!--// Mini Header \\-->
<div class="wm-mini-header">
	<span class="wm-blue-transparent"></span>
		<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="wm-mini-title">
				    <h1>Thời khóa biểu</h1> 
				</div>
				 <div class="wm-breadcrumb">
				    <ul>
				        <li><a href="index-2.html">Trang chủ</a></li>
				        <li><a href="#">Sinh viên</a></li>
				        <li>Thời khóa biểu</li>
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
                            <h4 id="h4">Các lớp học phần</h4>						
                        </div>
                        <div class="success">
                            <strong id="schedule">Lịch học ngày hôm nay</strong>
                        </div>
                        <table class="wm-article">
                            <thead>
                                <th>#</th>
                                <th>Tên lớp học phần</th>
                                <th>Giáo viên</th>
                                <th>Tuần</th>
                                <th>Phòng</th>
                                <th>Thứ / Tiết</th>
                                <th>Lịch trình môn học</th>
                            </thead>
                            <tbody>
                                @if(isset($results))
                                @foreach($results as $result)
                                <tr>
                                    <td></td>
                                    <td>{{$result['name']}}</td>
                                    <td>{{$result['teacher']}}</td>
                                    <td>{{$result['week']}}</td>
                                    <td>{{$result['room']}}</td>
                                    <td>
                                        @foreach($result['sections'] as $section)
                                            {{$section}}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <button class="wm-register">Xem lịch trình</button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="wm-student-dashboard-statement wm-dashboard-statement">
                        <div class="warnning">
                            <strong id="schedule">Lịch học các ngày khác!</strong>
                        </div>
                        <table class="wm-article">
                            <thead>
                                <th>#</th>
                                <th>Tên lớp học phần</th>
                                <th>Giáo viên</th>
                                <th>Tuần</th>
                                <th>Phòng</th>
                                <th>Thứ / Tiết</th>
                                <th>Lịch trình môn học</th>
                            </thead>
                            <tbody>
                                @if(isset($schedules))
                                @foreach($schedules as $schedule)
                                <tr>
                                    <td></td>
                                    <td>{{$schedule['name']}}</td>
                                    <td>{{$schedule['teacher']}}</td>
                                    <td>{{$schedule['week']}}</td>
                                    <td>{{$schedule['room']}}</td>
                                    <td>
                                        @foreach($schedule['sections'] as $section)
                                            {{$section}}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <button class="wm-register">Xem lịch trình</button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Main Section \\-->
</div>
<!--// Main Content \\-->
<style>
    .success{
        background-color: rgba(38,185,154,.88);
        padding-bottom: 15px;
        margin-bottom: 15px;
    }
    .warnning{
        background-color: rgba(243,156,18,.88);
        padding-top: 10px;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }
    .table{
        margin-bottom: 20px;
    }
    #schedule{
        margin-left: 20px;
        color: whitesmoke;
        font-family: Arial, Helvetica, sans-serif;
    }
    #h4{
        font-size: 25px;
        font-family: 'Times New Roman', Times, serif;
    }
    .wm-plane-title{
        background-color: white;
    }
    thead {
		background-color: #73879C;
		color: white;
		font-family: Arial, Helvetica, sans-serif;
	}
    th{
        font-size: 14px;
    }
    .wm-register{
		background-color: #26B99A;
		color: #fff;
        padding-left: 10px;
        padding-right: 10px;
		border: none;
		border-radius: 4px;
		font-size: 14px;
		cursor: pointer;
        margin-top: 10px;
        margin-bottom: 10px;
		transition: background-color 0.3s ease;
	}
</style>
<script>
    $(document).ready(function(){
        $.ajaxSetup({ 
			headers: { 
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
			} 
        });
    });
</script>
@endsection