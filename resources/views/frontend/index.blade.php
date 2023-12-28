@extends('frontend.layouts.app')
@section('content')
<!--// Main Banner \\-->
<div class="wm-main-banner">       
            <div class="wm-banner-one">
                <div class="wm-banner-one-for">
                    <div class="wm-banner-one-for-layer"> <img src="{{asset('uploads/bg/bg-vku.jpg')}}" alt=""> </div>
                </div>
                <div class="wm-banner-one-nav">
                    <div class="wm-banner-one-nav-layer" id="nav-layer">
                        <h1 id="title-white">Nhân bản - Phụng sự - Khai phóng</h1>
                        <p style="color: white;">Trường Đại học Công nghệ Thông tin và Truyền thông Việt - Hàn, Đại học Đà Nẵng.</p>
                        <a href="#" class="wm-banner-btn" id="wm-banner-btn">Xem thêm</a>
                    </div>
                </div>
            </div>
		</div>
		<!--// Main Banner \\-->

		<!--// Main Content \\-->
		<div class="wm-main-content">
            <!--// Main Section \\-->
            <div class="wm-main-section wm-courses-popular-full">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="wm-fancy-title"> <h2 id="title-why">Vài nét chính về trường đại học VKU</h2> </div>
                            <div class="wm-courses wm-courses-popular">
                                <p>Trường Đại học Công nghệ Thông tin và Truyền thông Việt – Hàn là cơ 
                                    sở đào tạo, nghiên cứu khoa học, chuyển giao công nghệ, đổi mới sáng 
                                    tạo, khởi nghiệp, phục vụ cộng đồng lớn và uy tín của cả nước về các lĩnh 
                                    vực công nghệ thông tin, truyền thông và các lĩnh vực liên quan theo mô 
                                    hình đại học định hướng ứng dụng; …
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--// Main Section \\-->

             <!--// Main Section \\-->
             <div class="wm-main-section wm-whychooseus-full" id="why">
                <div class="container">
                    <div class="row">    
                        <div class="col-md-12">
                            <div class="whychooseus-list">
                                <div class="wm-fancy-title"> <h2 id="title-why">Tại sao <span id="title-why">chọn chúng tôi?</span></h2> </div>
                                <ul class="row">
                                    <li class="col-md-3">
                                        <span id="title-why" class="teacher">100%</span>
                                        <h6 id="content-why">Giảng viên trình độ thạc sĩ, tiến sĩ</h6>
                                    </li>
                                    <li class="col-md-3">
                                        <span id="title-why" class="student">+6000</span>
                                        <h6 id="content-why">Sinh viên</h6>
                                    </li>
                                    <li class="col-md-3">
                                        <span id="title-why" class="partner">+200</span>
                                        <h6 id="content-why">Đối tác trong nước & quốc tế</h6>
                                    </li>
                                    <li class="col-md-3">
                                        <span id="title-why" class="publication">+1000</span>
                                        <h6 id="content-why">Công bố khoa học</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="wm-questions-studying">
                                <img src="extra-images/ask-questoin-bg.png" alt="">
                                <h3 class="wm-color">Questions about studying with us?</h3>
                                <p>We have a team of student advisers & officers to answer any questions:</p>
                                <a class="wm-banner-btn" href="#">ask us now</a>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
            <!--// Main Section \\-->

             <!--// Main Section \\-->
             <div class="wm-main-section wm-news-grid-full">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="wm-fancy-title"> <h2 id="title-why">Thông báo</h2> <p>Thông báo từ phòng Đào tạo</p> </div>
                            <div class="wm-news wm-news-grid">
                                <ul class="row">
                                    @foreach($notices as $notice)
                                    <li class="col-md-4">
                                        <div class="wm-newsgrid-text">
                                            <h5><a href="#" id="notice-title" class="wm-color">{{$notice->title}}</a></h5>
                                            <p>{{substr(html_entity_decode(strip_tags($notice->desc)),0,150)}}</p>
                                            <a class="wm-banner-btn" id="" href="{{URL('thong-bao/'.$notice->id.'')}}">Xem thêm</a>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--// Main Section \\-->

            <div class="wm-main-section wm-ourhistory-full" id="history-img">
                <span class="wm-light-transparent" style="background-color: #4FA0AB;"></span>
                <div class="container">
                    <div class="row">
                    <div class="col-md-5">
                            <div class="wm-history-list">
                                <h2>Lịch sử hình thành</h2>
                                <ul>
                                    <li>
                                        <time datetime="2008-02-14 20:00">2016</time>
                                        <span>Released the Arctic Collection the Perennial Collection of handknotted luxury area rugs.</span>
                                    </li>
                                    <li>
                                        <time datetime="2008-02-14 20:00">2015</time>
                                        <span>Installed our first custom floorcovering for a museum at the Aga Khan Museum in Toronto</span>
                                    </li>
                                    <li>
                                        <time datetime="2008-02-14 20:00">2014</time>
                                        <span>Designed our first wallcovering for all these healthcare sector at the Toronto Centre.</span>
                                    </li>
                                    <li>
                                        <time datetime="2008-02-14 20:00">2013</time>
                                        <span>Celebrated 25 years in business with “The Art Day Project” – a partnership.</span>
                                    </li>
                                    <li>
                                        <time datetime="2008-02-14 20:00">2016</time>
                                        <span>Released the Arctic Collection the Perennial Collection of handknotted luxury area rugs.</span>
                                    </li>
                                    <li>
                                        <time datetime="2008-02-14 20:00">2015</time>
                                        <span>Installed our first custom floorcovering for a museum at the Aga Khan Museum in Toronto</span>
                                    </li>
                                    <li>
                                        <time datetime="2008-02-14 20:00">2014</time>
                                        <span>Designed our first wallcovering for all these healthcare sector at the Toronto Centre.</span>
                                    </li>
                                    <li>
                                        <time datetime="2008-02-14 20:00">2013</time>
                                        <span>Celebrated 25 years in business with “The Art Day Project” – a partnership.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--// Main Section \\-->
            <div class="wm-main-section wm-courses-popular-full">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="wm-fancy-title"> <h2 id="title-why">Cơ cấu tổ chức</h2> </div>
                            <div class="wm-courses wm-courses-popular">
                                <img src="{{asset('uploads/bg/cocautochuc.png')}}"/>
                                <!-- <ul class="row">
                                    <li class="col-md-3">
                                        <div class="wm-courses-popular-wrap">
                                            <figure> <a href="#"><img src="{{asset('uploads/teacher/hcphap.png')}}" alt=""> <span class="wm-popular-hover"> <small>see course</small> </span> </a>
                                                <figcaption>
                                                    <h6><a href="#">PGS.TS. Huỳnh Công Pháp</a></h6>
                                                </figcaption>
                                            </figure>
                                            <div class="wm-popular-courses-text">
                                                <h6><a href="#">Advanced Architectural Research</a></h6>
                                                <ul>
                                                    <li><a href="#" class="wm-color"><i class="wmicon-social7"></i> 342</a></li>
                                                    <li><a href="#" class="wm-color"><i class="wmicon-social6"></i> 10</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-md-3">
                                        <div class="wm-courses-popular-wrap">
                                            <figure> <a href="#"><img src="extra-images/papular-courses-2.jpg" alt=""> <span class="wm-popular-hover"> <small>see course</small> </span> </a>
                                                <figcaption>
                                                    <img src="extra-images/papular-courses-thumb-2.jpg" alt="">
                                                    <h6><a href="#">Sam K. Harrington</a></h6>
                                                </figcaption>
                                            </figure>
                                            <div class="wm-popular-courses-text">
                                                <h6><a href="#">Advanced Landscape & Urbanism</a></h6>
                                                <ul>
                                                    <li><a href="#" class="wm-color"><i class="wmicon-social7"></i> 438</a></li>
                                                    <li><a href="#" class="wm-color"><i class="wmicon-social6"></i> 28</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-md-3">
                                        <div class="wm-courses-popular-wrap">
                                            <figure> <a href="#"><img src="extra-images/papular-courses-3.jpg" alt=""> <span class="wm-popular-hover"> <small>see course</small> </span> </a>
                                                <figcaption>
                                                    <img src="extra-images/papular-courses-thumb-3.jpg" alt="">
                                                    <h6><a href="#">Sara A. Shirley</a></h6>
                                                </figcaption>
                                            </figure>
                                            <div class="wm-popular-courses-text">
                                                <h6><a href="#">Transdisciplinary Design</a></h6>
                                                <div class="wm-courses-price"> <span>$79</span> </div>
                                                <ul>
                                                    <li><a href="#" class="wm-color"><i class="wmicon-social7"></i> 309</a></li>
                                                    <li><a href="#" class="wm-color"><i class="wmicon-social6"></i> 19</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-md-3">
                                        <div class="wm-courses-popular-wrap">
                                            <figure> <a href="#"><img src="extra-images/papular-courses-4.jpg" alt=""> <span class="wm-popular-hover"> <small>see course</small> </span> </a>
                                                <figcaption>
                                                    <img src="extra-images/papular-courses-thumb-4.jpg" alt="">
                                                    <h6><a href="#">Julius M. Lepage</a></h6>
                                                </figcaption>
                                            </figure>
                                            <div class="wm-popular-courses-text">
                                                <h6><a href="#">Financial Information Systems</a></h6>
                                                <div class="wm-courses-price"> <span>$50</span> </div>
                                                <ul>
                                                    <li><a href="#" class="wm-color"><i class="wmicon-social7"></i> 298</a></li>
                                                    <li><a href="#" class="wm-color"><i class="wmicon-social6"></i> 11</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--// Main Section \\-->

            <!--// Main Section \\-->
            <!-- <div class="wm-main-section wm-learn-listing-full">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="wm-fancy-title"> <h2>You Can <span>Learn</span></h2> </div>
                            <div class="wm-learn-listing">
                                <ul class="row">
                                    <li class="col-md-6">
                                        <figure><a href="#"><img src="extra-images/learn-listing-1.png" alt=""></a>
                                            <figcaption>
                                                <h2>Research</h2>
                                                <a href="#" class="wm-banner-btn">Read More</a>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li class="col-md-6">
                                        <figure><a href="#"><img src="extra-images/learn-listing-2.png" alt=""></a>
                                            <figcaption>
                                                <h2>Academics</h2>
                                                <a href="#" class="wm-banner-btn">Read More</a>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li class="col-md-6">
                                        <figure><a href="#"><img src="extra-images/learn-listing-3.png" alt=""></a>
                                            <figcaption>
                                                <h2>Admissions</h2>
                                                <a href="#" class="wm-banner-btn">Read More</a>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li class="col-md-6">
                                        <figure><a href="#"><img src="extra-images/learn-listing-4.png" alt=""></a>
                                            <figcaption>
                                                <h2>Student Life</h2>
                                                <a href="#" class="wm-banner-btn">Read More</a>
                                            </figcaption>
                                        </figure>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div> -->
            <!--// Main Section \\-->

            <!--// Main Section \\-->
            <!-- <div class="wm-main-section wm-latestevents-full">
                <div class="container">
                    <div class="row">
                    <div class="col-md-4">
                                    <div class="wm-event wm-latest-event">
                                        <ul class="row">
                                            <li class="col-md-12">
                                                <figure><a href="#"><img src="extra-images/latest-event-1.png" alt=""></a></figure>
                                                <div class="wm-latest-event-text">
                                                    <h6><a href="#" class="wm-color">Out of This World: The Family Fun Day</a></h6>
                                                    <time datetime="2008-02-14 20:00">21/04/2016</time>
                                                    <p>Join us for outer-space themed games, prizes, science & talks about careers in the UK.</p>
                                                    <a href="#" class="wm-banner-btn">check event</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="wm-event wm-latest-event">
                                        <ul class="row">
                                            <li class="col-md-12">
                                                <figure><a href="#"><img src="extra-images/latest-event-1.png" alt=""></a></figure>
                                                <div class="wm-latest-event-text">
                                                    <h6><a href="#" class="wm-color">Out of This World: The Family Fun Day</a></h6>
                                                    <time datetime="2008-02-14 20:00">21/04/2016</time>
                                                    <p>Join us for outer-space themed games, prizes, science & talks about careers in the UK.</p>
                                                    <a href="#" class="wm-banner-btn">check event</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="wm-event wm-latest-event">
                                        <ul class="row">
                                            <li class="col-md-12">
                                                <figure><a href="#"><img src="extra-images/latest-event-1.png" alt=""></a></figure>
                                                <div class="wm-latest-event-text">
                                                    <h6><a href="#" class="wm-color">Out of This World: The Family Fun Day</a></h6>
                                                    <time datetime="2008-02-14 20:00">21/04/2016</time>
                                                    <p>Join us for outer-space themed games, prizes, science & talks about careers in the UK.</p>
                                                    <a href="#" class="wm-banner-btn">check event</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                        
                        <div class="col-md-9 wm-top-spacer">
                            <h2 class="wm-simple-title">Our Latest Events</h2>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="wm-event-latest-slider">
                                        <div class="wm-event-latest-layer">
                                            <h6 class="wm-color">Enjoy the best experience for you with the choice of our campus - a truly international university campus in Barcelona.</h6>
                                            <a href="#" class="wm-banner-btn">about us</a>
                                        </div>
                                        <div class="wm-event-latest-layer">
                                            <h6 class="wm-color">Enjoy the best experience for you with the choice of our campus - a truly international university campus in Barcelona.</h6>
                                            <a href="#" class="wm-banner-btn">about us</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="wm-event wm-latest-event">
                                        <ul class="row">
                                            <li class="col-md-12">
                                                <figure><a href="#"><img src="extra-images/latest-event-1.png" alt=""></a></figure>
                                                <div class="wm-latest-event-text">
                                                    <h6><a href="#" class="wm-color">Out of This World: The Family Fun Day</a></h6>
                                                    <time datetime="2008-02-14 20:00">21/04/2016</time>
                                                    <p>Join us for outer-space themed games, prizes, science & talks about careers in the UK.</p>
                                                    <a href="#" class="wm-banner-btn">check event</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="wm-event wm-latest-event">
                                        <ul class="row">
                                            <li class="col-md-12">
                                                <figure><a href="#"><img src="extra-images/latest-event-2.png" alt=""></a></figure>
                                                <div class="wm-latest-event-text">
                                                    <h6><a href="#" class="wm-color">Shakespeare at Balliol in those five acts</a></h6>
                                                    <time datetime="2008-02-14 20:00">19/04/2016</time>
                                                    <p>A.C. Bradley and J.C. Maxwell get down to serious criticism; another Balliol writer launches the.</p>
                                                    <a href="#" class="wm-banner-btn">check event</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="wm-counter wm-counter-simple">
                                <ul class="row">
                                    <li class="col-md-12">
                                        <span class="word-count">5</span>
                                        <h6>th best University in Europe (Youth Inc. 2015 ranking)</h6>
                                    </li>
                                    <li class="col-md-12">
                                        <span class="word-count">68</span>
                                        <h6>% International students especially from Asia, Africa & Europe</h6>
                                    </li>
                                    <li class="col-md-12">
                                        <span class="word-count">91</span>
                                        <h6>Student Nationalities</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div> -->
            <!--// Main Section \\-->

            <!--// Main Section \\-->
            <!-- <div class="wm-main-section wm-testimonial-full">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="wm-fancy-title"> <h2>What <span>Clients Say</span></h2> <p>Don't take our word for it, see what our awesome clients say.</p> </div>
                            <div class="wm-testimonial-slider">
                                <div class="wm-testimonial-slider-wrap">
                                    <p>I chose them because it gave me flexibility. I was working full-time at the same time I was studying, so the OU gave me that flexibility. Also my Dad, I’m Danish of origin.</p>
                                    <figure>
                                        <a href="#" class="wm-testimonial-thumb"><img src="extra-images/testimonial-thumb-1.png" alt=""></a>
                                        <figcaption> <h5><a href="#">Priya E. Abraham</a></h5> <span>Paris, France</span> </figcaption>
                                    </figure>
                                </div>
                                <div class="wm-testimonial-slider-wrap">
                                    <p>After completing the MBA study, I had the opportunity to join one of the leading business schools in the UK in the role of faculty member and senior consultant. I suppose without the MBA it would have been difficult to make that career step. The biggest challenge in studying with them.</p>
                                    <figure>
                                        <a href="#" class="wm-testimonial-thumb"><img src="extra-images/testimonial-thumb-2.png" alt=""></a>
                                        <figcaption> <h5><a href="#">Priya E. Abraham</a></h5> <span>Paris, France</span> </figcaption>
                                    </figure>
                                </div>
                                <div class="wm-testimonial-slider-wrap">
                                    <p>I chose them because it gave me flexibility. I was working full-time at the same time I was studying, so the OU gave me that flexibility. Also my Dad, I’m Danish of origin.</p>
                                    <figure>
                                        <a href="#" class="wm-testimonial-thumb"><img src="extra-images/testimonial-thumb-1.png" alt=""></a>
                                        <figcaption> <h5><a href="#">Priya E. Abraham</a></h5> <span>Paris, France</span> </figcaption>
                                    </figure>
                                </div>
                                <div class="wm-testimonial-slider-wrap">
                                    <p>After completing the MBA study, I had the opportunity to join one of the leading business schools in the UK in the role of faculty member and senior consultant. I suppose without the MBA it would have been difficult to make that career step. The biggest challenge in studying with them.</p>
                                    <figure>
                                        <a href="#" class="wm-testimonial-thumb"><img src="extra-images/testimonial-thumb-2.png" alt=""></a>
                                        <figcaption> <h5><a href="#">Priya E. Abraham</a></h5> <span>Paris, France</span> </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div> -->
            <!--// Main Section \\-->

            <!--// Main Section \\-->
            <!-- <div class="wm-main-section wm-ourhistory-full">
                <span class="wm-light-transparent"></span>
                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-5">
                            <div class="wm-history-list">
                                <h2>Our History</h2>
                                <ul>
                                    <li>
                                        <time datetime="2008-02-14 20:00">2016</time>
                                        <span>Released the Arctic Collection the Perennial Collection of handknotted luxury area rugs.</span>
                                    </li>
                                    <li>
                                        <time datetime="2008-02-14 20:00">2015</time>
                                        <span>Installed our first custom floorcovering for a museum at the Aga Khan Museum in Toronto</span>
                                    </li>
                                    <li>
                                        <time datetime="2008-02-14 20:00">2014</time>
                                        <span>Designed our first wallcovering for all these healthcare sector at the Toronto Centre.</span>
                                    </li>
                                    <li>
                                        <time datetime="2008-02-14 20:00">2013</time>
                                        <span>Celebrated 25 years in business with “The Art Day Project” – a partnership.</span>
                                    </li>
                                    <li>
                                        <time datetime="2008-02-14 20:00">2016</time>
                                        <span>Released the Arctic Collection the Perennial Collection of handknotted luxury area rugs.</span>
                                    </li>
                                    <li>
                                        <time datetime="2008-02-14 20:00">2015</time>
                                        <span>Installed our first custom floorcovering for a museum at the Aga Khan Museum in Toronto</span>
                                    </li>
                                    <li>
                                        <time datetime="2008-02-14 20:00">2014</time>
                                        <span>Designed our first wallcovering for all these healthcare sector at the Toronto Centre.</span>
                                    </li>
                                    <li>
                                        <time datetime="2008-02-14 20:00">2013</time>
                                        <span>Celebrated 25 years in business with “The Art Day Project” – a partnership.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="wm-subscribe-form">
                                <h2>Still not convinced? We can help you!</h2>
                                <p>Fill out the form below and we will contact you.</p>
                                <form>
                                    <input type="text" value="Name:" onblur="if(this.value == '') { this.value ='Name:'; }" onfocus="if(this.value =='Name:') { this.value = ''; }">
                                    <input type="email" value="E-mail:" onblur="if(this.value == '') { this.value ='E-mail:'; }" onfocus="if(this.value =='E-mail:') { this.value = ''; }">
                                    <input type="submit" value="Get Advice">
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div> -->
            <!--// Main Section \\-->

            <!--// Main Section \\-->
            <!-- <div class="wm-main-section">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="wm-simple-section-title wm-partners-title"> <h2>University <span>Partners</span></h2> </div>
                            <div class="wm-partners-slider gallery">
                                <div class="wm-partners-layer"> <a title="" data-rel="prettyPhoto[gallery1]" href="extra-images/university-partners-1.png"> <img src="extra-images/university-partners-1.png" alt=""> </a> </div>
                                <div class="wm-partners-layer"> <a title="" data-rel="prettyPhoto[gallery1]" href="extra-images/university-partners-2.png"> <img src="extra-images/university-partners-2.png" alt=""> </a> </div>
                                <div class="wm-partners-layer"> <a title="" data-rel="prettyPhoto[gallery1]" href="extra-images/university-partners-3.png"> <img src="extra-images/university-partners-3.png" alt=""> </a> </div>
                                <div class="wm-partners-layer"> <a title="" data-rel="prettyPhoto[gallery1]" href="extra-images/university-partners-4.png"> <img src="extra-images/university-partners-4.png" alt=""> </a> </div>
                                <div class="wm-partners-layer"> <a title="" data-rel="prettyPhoto[gallery1]" href="extra-images/university-partners-5.png"> <img src="extra-images/university-partners-5.png" alt=""> </a> </div>
                                <div class="wm-partners-layer"> <a title="" data-rel="prettyPhoto[gallery1]" href="extra-images/university-partners-6.png"> <img src="extra-images/university-partners-6.png" alt=""> </a> </div>
                                <div class="wm-partners-layer"> <a title="" data-rel="prettyPhoto[gallery1]" href="extra-images/university-partners-1.png"> <img src="extra-images/university-partners-1.png" alt=""> </a> </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div> -->
            <!--// Main Section \\-->

		</div>
		<!--// Main Content \\-->
<style>
    .wm-main-banner{
        margin-top: 30px;
        height: 200px;
    }
    #nav-layer{
        background-color: #4FA0AB;
        border-color: #4FA0AB;
    }
    #why{
        background-color: #F5FBFD;
        margin-top: -50px;
    }
    #title-why{
        font-family: 'Inter', sans-serif;
        color: #4FA0AB;
        font-weight: bold;
    }
    #notice-title{
        font-family: 'Inter', sans-serif;
    }
    .wm-banner-btn{
        border-color: #4FA0AB;
        color: #4FA0AB;
    }
    .wm-banner-btn:hover{
        background-color: #4FA0AB;
    }
    #title-white{
        font-family: 'Inter', sans-serif;
        color: white;
        font-weight: bold;
    }
    #content-why{
        font-family: 'Inter', sans-serif;
        color: #4FA0AB;
    }
    #history-img{
        background-image: url('{{asset("uploads/bg/bg-vku.jpg")}}');
    }
    #wm-banner-btn{
        background-color: #FFBB71;
    }
</style>
<script>
    function runCounter(){
        var startNumber = 1;
        var endNumberStudent = parseInt($(".student").text().replace('+',''),10);
        var endNumberTeacher = parseInt($(".teacher").text().replace('%',''),10);
        var endNumberPartner = parseInt($(".partner").text().replace('+',''),10);
        var endNumberPublication = parseInt($(".publication").text().replace('+',''),10);

        // Thời gian chạy hiệu ứng (miligiây)
        var duration = 1000;

        // Tính toán bước tăng giảm
        var step = (endNumberStudent - startNumber) / (duration / 1000);

        function updateCounter(){
            $(".student").animate(
                {
                    Counter: endNumberStudent
                },
                {
                    duration: duration,
                    step: function (now) {
                        // Cập nhật giá trị của phần tử <p>
                        $(this).text(Math.round(now));
                    },
                    complete: function () {
                        // Đảm bảo giá trị cuối cùng là chính xác
                        $(this).text('+'+endNumberStudent);
                    }
                }
            );
            $(".teacher").animate(
                {
                    Counter: endNumberTeacher
                },
                {
                    duration: duration,
                    step: function (now) {
                        // Cập nhật giá trị của phần tử <p>
                        $(this).text(Math.round(now));
                    },
                    complete: function () {
                        // Đảm bảo giá trị cuối cùng là chính xác
                        $(this).text(endNumberTeacher+'%');
                    }
                }
            );
            $(".partner").animate(
                {
                    Counter: endNumberPartner
                },
                {
                    duration: duration,
                    step: function (now) {
                        // Cập nhật giá trị của phần tử <p>
                        $(this).text(Math.round(now));
                    },
                    complete: function () {
                        // Đảm bảo giá trị cuối cùng là chính xác
                        $(this).text('+'+endNumberPartner);
                    }
                }
            );
            $(".publication").animate(
                {
                    Counter: endNumberPublication
                },
                {
                    duration: duration,
                    step: function (now) {
                        // Cập nhật giá trị của phần tử <p>
                        $(this).text(Math.round(now));
                    },
                    complete: function () {
                        // Đảm bảo giá trị cuối cùng là chính xác
                        $(this).text('+'+endNumberPublication);
                    }
                }
            );
        }
        updateCounter();
    }
    $(document).ready(function(){
        runCounter();
    });
</script>
@endsection