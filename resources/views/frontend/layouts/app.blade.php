<!DOCTYPE html>
<html lang="en">
  
<!--  13:28  -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hệ thống đào tạo</title>

    <!-- Css Files -->
    <link href="{{asset('frontend/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/flaticon.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/slick-slider.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyphoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/build/mediaelementplayer.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/style.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/color.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/color-two.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/color-three.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/color-four.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400&family=Oswald:wght@500&family=Roboto:wght@700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="background-color: #F5FBFD">
	
    <!--// Main Wrapper \\-->
    <div class="wm-main-wrapper">
        
        <!--// Header \\-->
		<header id="wm-header" class="wm-header-one">

            <!--// TopStrip \\-->
			<!-- <div class="wm-topstrip">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="wm-language"> <ul> <li><a href="#">English</a></li> <li><a href="#">español</a></li> </ul> </div>
                            <ul class="wm-stripinfo">
                                <li><i class="wmicon-location"></i> 2925 Swick Hill Street, Charlotte, NC 28202</li>
                                <li><i class="wmicon-technology4"></i> +1 984-700-7129</li>
                                <li><i class="wmicon-clock2"></i> Mon - fri: 7:00am - 6:00pm</li>
                            </ul>
                            <ul class="wm-adminuser-section">
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#ModalLogin">login</a>
                                </li>
                                <li>
                                    <a href="#">Contact</a>
                                </li>
                                <li>
                                    <a href="#" class="wm-search-btn" data-toggle="modal" data-target="#ModalSearch"><i class="wmicon-search"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> -->
            <!--// TopStrip \\-->

            <!--// MainHeader \\-->
            <div class="wm-main-header" style="background-color: #F5FBFD">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3"><a href="{{route('index')}}" class="wm-logo"><img src="{{asset('frontend/images/logo-1.png')}}" alt=""></a></div>
                        <div class="col-md-9">
                            <!--// Navigation \\-->
                            <nav class="navbar navbar-default">
                                <div class="navbar-header">
                                  <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="true">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                  </button> -->
                                </div>
                                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                                  <ul class="nav navbar-nav">
                                    @if(isset($student) || isset($teacher))
                                    <li class="active"><a href="{{route('index')}}" id="title">Trang chủ</a></li>
                                    @endif
                                    @if(isset($student))
                                    <li><a href="#" id="title">Sinh viên</a>
                                        <ul class="wm-dropdown-menu">
                                            <li><a href="{{URL('sv/hoso')}}" id="title">Lý lịch sinh viên</a></li>
                                            <li><a href="{{URL('sv/diem')}}" id="title">Kết quả học tập</a></li>
                                            <li><a href="{{URL('sv/hoc-phi-sap-nop')}}" id="title">Học phí</a></li>
                                        </ul>
                                    </li>
                                    <li ><a href="#" id="title">Đăng kí tín chỉ</a>
                                        <ul class="wm-dropdown-menu">
                                            <li><a href="{{URL('sv/dang-ki-tin-chi')}}" id="title">Đăng kí khối lượng</a></li>
                                            <li><a href="student-dashboard-favourite.html" id="title">Tiến độ học tập</a></li>
                                            <li><a href="{{URL('sv/do-an-cua-toi')}}" id="title">Lớp đồ án</a></li>
                                        </ul>
                                    </li>
                                    <li ><a href="#" id="title">Thời khóa biểu</a>
                                        <ul class="wm-dropdown-menu">
                                            <li><a href="{{URL('sv/tkb')}}" id="title">Lịch học theo tuần</a></li>
                                            <li><a href="{{URL('sv/lich-hoc')}}" id="title">Lịch học chi tiết</a></li>
                                        </ul>
                                    </li>
                                    @endif
                                    @if(isset($teacher))
                                    <li><a href="#" id="title">Lớp học phần</a>
                                        <ul class="wm-dropdown-menu">
                                            <li><a href="{{URL('gv/danh-sach-hoc-phan')}}" id="title">Danh sách lớp</a></li>
                                            <li><a href="{{URL('gv/quan-ly-diem')}}" id="title">Quản lý điểm</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#" id="title">Lớp đồ án</a>
                                        <ul class="wm-dropdown-menu">
                                            <li><a href="{{URL('gv/quan-ly-do-an')}}" id="title">Quản lý đồ án</a></li>
                                        </ul>
                                    </li>
                                    @endif
                                  </ul>
                                </div>
                            </nav>
                                <ul class="nav navbar-nav navbar-right">
                                    @if(isset($student))
                                    <li>
                                        <a id="code"></a>
                                        <ul class="wm-dropdown-menu" id="semester">
                                            @foreach($semesters as $semester)
                                            <li><a class="value" id="{{$semester->id}}" style="color: #4FA0AB;">{{$semester->code}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li>
                                        <a id="title">{{$student->name}}</a>
                                        <ul class="wm-dropdown-menu">
                                            <li><a href="{{route('logout')}}" id="title">Đăng xuất</a></li>
                                        </ul>
                                    </li>
                                    @endif
                                    @if(isset($teacher))
                                    <li>
                                        <a id="code"></a>
                                        <ul class="wm-dropdown-menu" id="semester">
                                            @foreach($semesters as $semester)
                                            <li><a class="value" id="{{$semester->id}}">{{$semester->code}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li>
                                        <a id="title">{{$teacher->name}}</a>
                                        <ul class="wm-dropdown-menu">
                                            <li><a href="{{route('logout')}}" id="title">Đăng xuất</a></li>
                                        </ul>
                                    </li>
                                    @endif
                                </ul>
                            @if(!isset($student) && !isset($teacher))
                            <a href="#" data-toggle="modal" data-target="#ModalLogin" id="title" class="wm-header-btn">Đăng nhập</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!--// MainHeader \\-->

		</header>
		<!--// Header \\-->

        <div class="content">
		    @yield('content')
        </div>

		<!--// Footer \\-->
		<footer id="wm-footer" class="wm-footer-one">
			
            <!--// FooterNewsLatter \\-->
            <div class="wm-footer-newslatter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form>
                                <i class="wmicon-interface2"></i>
                                <input type="text" value="Enter your e-mail address" onblur="if(this.value == '') { this.value ='Enter your e-mail address'; }" onfocus="if(this.value =='Enter your e-mail address') { this.value = ''; }">
                                <input type="submit" value="Subscribe to our newsletter">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--// FooterNewsLatter \\-->

            <!--// FooterWidgets \\-->
            <!-- <div class="wm-footer-widget">
                <div class="container">
                    <div class="row">
                        <aside class="widget widget_contact_info col-md-3">
                            <a href="index-2.html" class="wm-footer-logo"><img src="images/logo-1.png" alt=""></a>
                            <ul>
                                <li><i class="wm-color wmicon-pin"></i> 195 Cooks Mine Road Espanola, NM 87532</li>
                                <li><i class="wm-color wmicon-phone"></i> +1 505-753-5656 <br> +1 505-753-4437</li>
                                <li><i class="wm-color wmicon-letter"></i> <a href="mailto:name@email.com">info@university.com</a> <a href="mailto:name@email.com">support@university.com</a></li>
                            </ul>
                            <div class="wm-footer-icons">
                                <a href="#" class="wmicon-social5"></a>
                                <a href="#" class="wmicon-social4"></a>
                                <a href="#" class="wmicon-social3"></a>
                                <a href="#" class="wmicon-vimeo"></a>
                            </div>
                        </aside>
                        <aside class="widget widget_archive col-md-2">
                            <div class="wm-footer-widget-title"> <h5>Quick Links</h5> </div>
                            <ul>
                                <li><a href="#">Our Latest Events</a></li>
                                <li><a href="#">Our Courses</a></li>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">404 Page</a></li>
                                <li><a href="#">Gallery</a></li>
                                <li><a href="#">All Instructors</a></li>
                            </ul>
                        </aside>
                        <aside class="widget widget_twitter col-md-4">
                            <div class="wm-footer-widget-title"> <h5><i class="wmicon-social2"></i> @enrollcampus</h5> </div>
                            <ul>
                                <li>
                                    <p>Check Youniverse - Multipurpose PSD Template @ThemeForest: <a href="#">pic.twitter.com/xcVlqJySjq</a></p>
                                    <time datetime="2008-02-14 20:00" class="wm-color">2 hrs ago</time>
                                </li>
                                <li>
                                    <p>Check out my New PSD:  FashionPlus - Fashion eCommerce: <a href="#">pic.twitter.com/xc445Ghyt</a></p>
                                    <time datetime="2008-02-14 20:00" class="wm-color">4 hrs ago</time>
                                </li>
                                <li>
                                    <p>MedicAid - Medical Template @ThemeForest: <a href="#">pic.twitter.com/xcVlq542wfER</a></p>
                                    <time datetime="2008-02-14 20:00" class="wm-color">1 day ago</time>
                                </li>
                            </ul>
                        </aside>
                        <aside class="widget widget_gallery col-md-3">
                            <div class="wm-footer-widget-title"> <h5>Our Instructors</h5> </div>
                            <ul class="gallery">
                                <li><a title="" data-rel="prettyPhoto[gallery1]" href="extra-images/widget-galleryfull-1.jpg"><img src="extra-images/widget-gallery-1.jpg" alt=""></a></li>
                                <li><a title="" data-rel="prettyPhoto[gallery1]" href="extra-images/widget-galleryfull-2.jpg"><img src="extra-images/widget-gallery-2.jpg" alt=""></a></li>
                                <li><a title="" data-rel="prettyPhoto[gallery1]" href="extra-images/widget-galleryfull-3.jpg"><img src="extra-images/widget-gallery-3.jpg" alt=""></a></li>
                                <li><a title="" data-rel="prettyPhoto[gallery1]" href="extra-images/widget-galleryfull-4.jpg"><img src="extra-images/widget-gallery-4.jpg" alt=""></a></li>
                                <li><a title="" data-rel="prettyPhoto[gallery1]" href="extra-images/widget-galleryfull-5.jpg"><img src="extra-images/widget-gallery-5.jpg" alt=""></a></li>
                                <li><a title="" data-rel="prettyPhoto[gallery1]" href="extra-images/widget-galleryfull-6.jpg"><img src="extra-images/widget-gallery-6.jpg" alt=""></a></li>
                                <li><a title="" data-rel="prettyPhoto[gallery1]" href="extra-images/widget-galleryfull-7.jpg"><img src="extra-images/widget-gallery-7.jpg" alt=""></a></li>
                                <li><a title="" data-rel="prettyPhoto[gallery1]" href="extra-images/widget-galleryfull-8.jpg"><img src="extra-images/widget-gallery-8.jpg" alt=""></a></li>
                                <li><a title="" data-rel="prettyPhoto[gallery1]" href="extra-images/widget-galleryfull-9.jpg"><img src="extra-images/widget-gallery-9.jpg" alt=""></a></li>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div> -->
            <!--// FooterWidgets \\-->
		</footer>
		<!--// Footer \\-->

	    <div class="clearfix"></div>
    </div>
    <!--// Main Wrapper \\-->

    <!-- ModalLogin Box -->
    <div class="modal fade" id="ModalLogin" tabindex="-1" role="dialog" style="padding-top: 80px;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            
            <div class="wm-modallogin-form wm-login-popup">
                <span class="wm-color">Đăng nhập sinh viên</span>
                <form action="{{route('loginStudent')}}" method="POST">
                    <ul>
                        <li> <input type="text" name="email" placeholder="Email" onblur="if(this.value == '') { this.value ='Email'; }" onfocus="if(this.value =='Email') { this.value = ''; }" id="input"> </li>
                        <li> <input type="password" name="password" placeholder="Mật khẩu" onblur="if(this.value == '') { this.value ='Mật khẩu'; }" onfocus="if(this.value =='Mật khẩu') { this.value = ''; }" id="input"> </li>
                        <li> <a href="{{URL('quen-mat-khau/1')}}" class="wm-forgot-btn">Quên mật khẩu?</a> </li>
                        <input type="hidden" name="level" value="1"/>
                        <div class="center">
                            <li> <input type="submit" id="submit" value="Đăng nhập"> </li>
                        </div>
                    </ul>
                    @csrf
                </form>
                <!-- <span class="wm-color">or try our socials</span>
                <ul class="wm-login-social-media">
                    <li><a href="#"><i class="wmicon-social5"></i> Facebook</a></li>
                    <li class="wm-twitter-color"><a href="#"><i class="wmicon-social4"></i> twitter</a></li>
                    <li class="wm-googleplus-color"><a href="#"><i class="fa fa-google-plus-square"></i> Google+</a></li>
                </ul> -->
                <p id="note">Đăng nhập giảng viên? <a href="#" id="role">Đăng nhập</a></p>
            </div>
            <div class="wm-modallogin-form wm-register-popup">
                <span class="wm-color">Đăng nhập giảng viên</span>
                <form action="{{route('loginTeacher')}}" method="POST">
                    <ul>
                        <li> <input type="text" name="email" placeholder="Email" onblur="if(this.value == '') { this.value ='Email'; }" onfocus="if(this.value =='Email') { this.value = ''; }" id="input"> </li>
                        <li> <input type="password" name="password" placeholder="Mật khẩu" onblur="if(this.value == '') { this.value ='Mật khẩu'; }" onfocus="if(this.value =='Mật khẩu') { this.value = ''; }" id="input"> </li>
                        <li> <a href="{{URL('quen-mat-khau/2')}}" class="wm-forgot-btn">Quên mật khẩu?</a> </li>
                        <div class="center">
                            <li> <input type="submit" id="submit" value="Đăng nhập"> </li>
                        </div>
                    </ul>
                    @csrf
                </form>
                <!-- <span class="wm-color">or signup with your socials:</span>
                <ul class="wm-login-social-media">
                    <li><a href="#"><i class="wmicon-social5"></i> Facebook</a></li>
                    <li class="wm-twitter-color"><a href="#"><i class="wmicon-social4"></i> twitter</a></li>
                    <li class="wm-googleplus-color"><a href="#"><i class="fa fa-google-plus-square"></i> Google+</a></li>
                </ul> -->
                <p id="note">Đăng nhập sinh viên? <a href="#" id="role">Đăng nhập</a></p>
            </div>

          </div>
        </div>
        <div class="clearfix"></div>
        </div>
    </div>
    <!-- ModalLogin Box -->

    <!-- ModalSearch Box -->
    <div class="modal fade" id="ModalSearch" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            
            <div class="wm-modallogin-form">
                <span class="wm-color">Search Your KeyWord</span>
                <form>
                    <ul>
                        <li> <input type="text" value="Keywords..." onblur="if(this.value == '') { this.value ='Keywords...'; }" onfocus="if(this.value =='Keywords...') { this.value = ''; }"> </li>
                        <li> <input type="submit" value="Search"> </li>
                    </ul>
                </form>
            </div>

          </div>
        </div>
      <div class="clearfix"></div>
      </div>
    </div>
    <!-- ModalSearch Box -->

	<!-- jQuery (necessary for JavaScript plugins) -->
	<script type="text/javascript" src="{{asset('frontend/script/jquery.js')}}"></script>
	<script type="text/javascript" src="{{asset('frontend/script/modernizr.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/script/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/script/jquery.prettyphoto.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/script/jquery.countdown.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/script/fitvideo.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/script/skills.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/script/slick.slider.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/script/waypoints-min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/build/mediaelement-and-player.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/script/isotope.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/script/jquery.nicescroll.min.js')}}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
    <script type="text/javascript" src="{{asset('frontend/script/functions.js')}}"></script>

  </body>
  <style>
    *{
        margin: 0;
        padding: 0;
    }
    html {
        width: 100%;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }
    body{
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        font-weight: 400;
        color: #73879C;
    }
    #wm-header{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 9999;
    }
    .center{
        position: relative;
    }
    #semester{
        color: #4FA0AB;
        font-family: 'Arial', sans-serif;
    }
    #input{
        font-style: normal;
    }
    #title{
        color: #4FA0AB;
        font-family: 'Arial', sans-serif;
    }
    .value{
        color: #4FA0AB;
        font-family: 'Arial', sans-serif;
    }
    #code{
        color: #4FA0AB;
    }
    .center li{
        display: flex;
        justify-content: center;
        align-items: center;  
    }
    .wm-forgot-btn{
        color: #7F7F7F;
    }
    #note{
        color: #7F7F7F;
    }
    #role{
        color: #4FA0AB;
    }
    #submit{
        background-color: #4FA0AB;
    }
    .content{
        padding-top: 100px;
    }
    footer{
        margin-bottom: -100px;
    }
  </style>
  <script>
        $(document).ready(function(){
            $.ajaxSetup({ 
                headers: { 
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                } 
            });

            var semester_id = $("#semester li:first").text();
            $("#code").append(semester_id);

            $(".value").click(function(){
                var value = $(this).text();
                var id = $(this).attr('id');
                $("#code").empty().append(value);
            });
        });
  </script>

<!--  15:20  -->
</html>