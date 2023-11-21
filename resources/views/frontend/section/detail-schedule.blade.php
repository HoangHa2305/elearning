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
                        <div class="package"></div>
                        <hr>
                        <div class="success">
                            <p id="schedule">Nội dung đã giảng dạy lớp học phần <b>{{$section->name}}</b></p>
                        </div>
                        <table class="wm-article-border">
                            <thead>
                                <tr>
                                    <th class="th-content">STT</th>
                                    <th class="th-content">Nội dung</th>
                                    <th class="th-content">Ngày dạy</th>
                                    <th class="th-content">Tình hình vắng nghỉ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($data))
                                @php $i = 0; @endphp
                                @foreach($data as $result)
                                    @php $i++; @endphp
                                    <tr>
                                        <td class="td-content first-column">Buổi {{$i}}</td>
                                        <td class="td-content">{{$result['content']}}</td>
                                        <td class="td-content">{{$result['date']}} {{$result['time']}}</td>
                                        <td class="td-content">
                                            SV vắng: {{count($result['absent'])}}<br>
                                            @foreach($result['absent'] as $absent)
                                            - {{$absent}}<br>
                                            @endforeach
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
</div>
<style>
    .success{
        background-color: rgba(38,185,154,.88);
        padding-top: 10px;
        padding-bottom: 5px;
        margin-bottom: 15px;
    }
    .package{
        background-color: rgba(38,185,154,.88);
        padding-top: 20px;
        padding-bottom: 20px;
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
    .wm-article-border{
        background-color: #F5FBFD;
    }
    .th-content{
        font-family: "Inter, "Helvetica Neue",Roboto,Arial,sans-serif";
        color: #73879C;
        text-align: left;
        font-size: 14px;
    }
    .td-content{
        color: #73879C;
        font-size: 14px;
        text-align: left;
    }
    .first-column{
        text-align: center;
    }
    #schedule{
        font-size: 14px;
        margin-left: 20px;
        color: white;
    }
    #h4{
        font-size: 25px;
        font-family: 'Times New Roman', Times, serif;
    }
    .wm-plane-title{
        background-color: white;
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
@endsection