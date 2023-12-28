@extends('frontend.layouts.app')
@section('content')
        <!--// Mini Header \\-->
        <div class="wm-mini-header">
			<span class="wm-blue-transparent"></span>
			 <div class="container">
			    <div class="row">
				    <div class="col-md-12">
				        <div class="wm-mini-title">
				       		<h1>Thông báo</h1> 
				        </div>
				        <div class="wm-breadcrumb">
				          	<ul>
				          	 	<li><a href="index-2.html">Trang chủ</a></li>
				          	 	<li><a href="#">Thông báo</a></li>
				          	</ul>
				        </div>      
				    </div>
			    </div>
			</div>    
		</div>
  		<!--// Mini Header \\-->
		<div class="wm-main-content">

		<!--// Main Section \\-->
		<div class="wm-main-section">
			<div class="container">
                <h3 class="h3_title">{{$notice->title}}</h3>
                <span>
                    <i class="fa fa-calendar"></i>
                    {{$notice->date}}
                </span>
				<p>{!!html_entity_decode($notice->desc)!!}</p>
                @if(!empty($notice->zip))
                <p class="phuluc">PHỤ LỤC KÈM THEO THÔNG BÁO: </p><a class="h3_title" href="{{URL('dowload/topic/'.$notice->zip)}}">Tải tại đây</a>
                @endif
			</div>
		</div>
		<!--// Main Section \\-->
        <style>
            .phuluc{
                color: black;
                font-weight: bold;
            }
            .h3_title{
                color: #4FA0AB;
                font-family: 'Inter', sans-serif;
            }
        </style>
@endsection