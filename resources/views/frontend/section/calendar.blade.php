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
                        <div class="wm-plane-title" id="wm-plane-title">
                            <h4 id="h4">Thời khóa biểu - Hôm nay là {{$date}} - thuộc tuần học {{$week}}</h4>						
                        </div>
                        <hr>
                        <div class="week">
                            <center>
                                <a href="{{URL('sv/tkb/tuan/'.($week-1).'')}}" id="round"><< Tuần {{($week-1)}}</a>
                                <strong id="h5">TUẦN THỨ {{$week}}</strong>
                                <a href="{{URL('sv/tkb/tuan/'.($week+1).'')}}" id="round">Tuần {{($week+1)}} >></a>
                            </center>
                        </div>
                        @php 
                            $day_vie = array(
                                'Mon' => 'Hai',
                                'Tue' => 'Ba',
                                'Wed' => 'Tư',
                                'Thu' => 'Năm',
                                'Fri' => 'Sáu',
                                'Sat' => 'Bảy',
                                'Sun' => 'Chủ nhật'
                            ); 
                            $dayNames = [
                                'monday', 
                                'tuesday', 
                                'wednesday', 
                                'thursday', 
                                'friday', 
                                'saturday', 
                                'sunday'
                            ];
                        @endphp
                        <table class="wm-article">
                            <thead>
                                <th></th>
                                @for($i = 0;$i < 7;$i++)
                                <th>
                                    @php echo $day_vie[date('D',$day)]; @endphp
                                    <br>
                                    @php echo date('d/m/Y',$day); @endphp
                                </th>
                                @php $day = strtotime('+1 day',$day); @endphp
                                @endfor
                            </thead>
                            <tbody>
                                @for($i = 1;$i <= 10;$i++)
                                <tr>
                                    <th>Tiết {{$i}}</th>
                                    @for($day = 0;$day < 7;$day++)
                                        <td id="td">
                                            @foreach($calendars as $calendar)
                                                @if(isset($calendar[$dayNames[$day]]))
                                                @php $dates = $calendar[$dayNames[$day]]; @endphp
                                                @foreach(array_slice($dates,0,1) as $date)
                                                    @if($i == $date)
                                                        {{$calendar['name']}}
                                                        <br>
                                                        {{$calendar['room']}}
                                                        <span data-my-value="{{count($dates)}}"></span>
                                                    @endif
                                                @endforeach
                                                @endif
                                            @endforeach
                                        </td>
                                    @endfor
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var week = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
        $('td#td').each(function(){
            var content = $(this).text();
            var random = week[Math.floor(Math.random()*week.length)];
            if($.trim(content)!==''){
                var count = $(this).find("span").data("my-value");
                $(this).addClass(random);
                $(this).attr('rowspan',count);
            }
        });
        $("td[rowspan]").each(function(){
            var value = parseInt($(this).attr('rowspan'));
            var index = $(this).index();
            var row = $(this).parent("tr");

            for(var i = 1;i < value;i++){
                var nextRow = row.next("tr");
                var cellRemove = nextRow.find("td").eq(index).remove();
                row = nextRow;
            }
        });
    });
</script>
<style>
    #wm-plane-title{
        background-color: #F5FBFD;
    }
    #h4{
        font-size: 25px;
        font-family: 'Inter', sans-serif;
    }
    .week{
        padding-top: 10px;
        padding-bottom: 10px;
        background-color: #dff0d8;
    }
    .wm-plane-title{
        background-color: white;
        margin-bottom: 15px;
    }
    #round{
        font-size: 15px;
        color: #73879C;
    }
    #h5{
        font-size: 16px;
        color: #3c763d;
        font-family: Arial, Helvetica, sans-serif;
    }
    .monday{
        color: white;
        background-color: #335237;
    }
    .tuesday{
        color: white;
        background-color: #4d5233;
    }
    .wednesday{
        color: white;
        background-color: #523333;
    }
    .thursday{
        color: white;
        background-color: #334552;
    }
    .friday{
        color: white;
        background-color: #211551;
    }
    .saturday{
        color: white;
        background-color: #1C1C1C;
    }
    .sunday{
        color: white;
        background-color: #00688B;
    }
</style>
@endsection