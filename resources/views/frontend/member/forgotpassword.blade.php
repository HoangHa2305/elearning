@extends('frontend.layouts.app')
@section('content')
<!--// Mini Header \\-->
<div class="wm-mini-header">
			<span class="wm-blue-transparent"></span>
			 <div class="container">
			    <div class="row">
				    <div class="col-md-12">
				        <div class="wm-mini-title">
				       		<h1>Quên mật khẩu</h1> 
				        </div>
				        <div class="wm-breadcrumb">
				          	<ul>
				          	 	<li><a href="index-2.html">Trang chủ</a></li>
                                @if($type == 1)
				          	 	<li><a href="#">Sinh viên</a></li>
                                @else
                                <li><a href="#">Giảng viên</a></li>
                                @endif
				           		<li>Quên mật khẩu</li>
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
								<h4>Quên mật khẩu</h4>							
							</div>
							<div class="wm-student-dashboard-statement wm-dashboard-statement">
                                <p>Vui lòng nhập địa chỉ email</p>
								<div class="valid"></div>
                                <div class="layout">
                                    <input name="email" id="input" class="form-control"/>
                                    <button id="btn" class="wm-register">Xác minh</button>
                                    @csrf
                                </div>
                                <input type="hidden" name="type" value="{{$type}}"/>
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
            .pin-container {
                display: flex;
				margin-top: 10px;
            }
			.success{
				text-align: center;
			}
            .pin-input {
                width: 40px;
                height: 100px;
                font-size: 20px;
                text-align: center;
                margin-right: 10px;
            }
            h4{
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            }
			.error{
				color: red;
			}
            .layout{
                display: flex;
            }
			.title{
				text-align: center;
			}
            #input{
                width: 400px;
            }
            .custom-alert {
				display: none;
				position: fixed;
				width: 26.5%;
				top: 50%;
				left: 50%;
				border-radius: 10px;
				transform: translate(-50%, -50%);
				background-color: white;
				border: 1px solid #ccc;
				padding: 20px;
				box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.1);
			}
			#show{
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background-color: rgba(0, 0, 0, 0.5);
				display: none;
			}
			.confirm{
				color: green;
			}
			.close-btn {
				position: absolute;
				top: 10px;
				font-size: 20px;
				right: 5px;
				cursor: pointer;
			}
			.wm-register{
				background-color: #4FA0AB;
				color: #fff;
				padding-left: 15px;
				padding-top: 6px;
				padding-right: 15px;
				padding-bottom: 8px;
				border: none;
				border-radius: 4px;
				font-size: 14px;
				cursor: pointer;
				transition: background-color 0.3s ease;
                margin-left: 10px;
			}
			.btn{
				background-color: #EDEDED;
				color: black;
				padding-left: 8px;
				padding-right: 8px;
				border: none;
				border-radius: 4px;
				font-size: 14px;
				cursor: pointer;
				transition: background-color 0.3s ease;
			}

			.wm-cancel{
				background-color: #F1AF00;
				color: #fff;
				padding: 8px 16px;
				border: none;
				border-radius: 4px;
				font-size: 14px;
				cursor: pointer;
				transition: background-color 0.3s ease;
			}

			.note{
				margin-top: 10px;
			}
			.resend{
				color: #4FA0AB;
			}
		</style>
        <script>
            $(document).ready(function(){
                $.ajaxSetup({ 
					headers: { 
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
					} 
                });

				var type = <?php echo json_encode($type) ?>;
				var time = 120;
				var pin = "";
				var layoutVisible = false;

                $("#btn").click(function(event){
					event.stopPropagation();
					var email = $("#input").val();
					
					$.ajax({
						url:"{{URL('xac-minh-email')}}",
						type:"POST",
						data:{
							email:email,
							type:type
						},
						success:function(response){
							if(response.status){
								$(".valid").empty();
								var html = $(
									"<div id='customAlert' class='custom-alert'>"
										+"<div class='title'>"
											+"<b>Vui lòng nhập mã OTP</b>"
										+"</div>"
										+"<hr>"
										+"<span id='countdown'>Mã OTP sẽ hết hạn sau: "+time+"</span>"
										+"<span class='close-btn'>&times;</span>"
										+"<div class='pin-container'>"
											+"<input type='number' class='pin-input' maxlength='1' tabindex='1' />"
											+"<input type='number' class='pin-input' maxlength='1' tabindex='2' />"
											+"<input type='number' class='pin-input' maxlength='1' tabindex='3' />"
											+"<input type='number' class='pin-input' maxlength='1' tabindex='4' />"
											+"<input type='number' class='pin-input' maxlength='1' tabindex='5' />"
											+"<input type='number' class='pin-input' maxlength='1' tabindex='6' />"
										+"</div>"
										+"<div class='note'>"
											+"<p>Bạn chưa nhận được mã? <a class='resend'>Gửi lại</a></p>"
										+"</div>"
										+"<div class='success'></div>"
									+"</div>"	
								);
								$("#show").html(html);
								$("#show").fadeIn();
								$("#customAlert").fadeIn();
								layoutVisible = true;

								function countdown(){
									if(time === 0){
										time = 120;
									}
									
									$("#countdown").text("Mã OTP sẽ hết hạn sau: "+time);
									if(time <= 10){
										$("#countdown").css("color","red");
									}else{
										$("#countdown").css("color","");
									}
									time--;

									setTimeout(countdown,1000);
								}

								countdown();

								$("input.pin-input").on('input',function(){
									pin = "";
									$("input.pin-input").each(function(){
										pin += $(this).val();
									});
									var maxLength = parseInt($(this).attr("maxlength"));
									var curentTabIndex = parseInt($(this).attr("tabindex"));

									if($(this).val().length >= maxLength) {
										var nextTabIndex = curentTabIndex +1;
										$("[tabindex='" + nextTabIndex + "']").focus();
									}
									if(pin.length === 6){
										$.ajax({
											url:"{{URL('kiem-tra-otp')}}",
											type:"POST",
											data:{
												email:email,
												pin:pin
											},
											success:function(response){
												if(response.url){
													$(".success").append("<p class='confirm'>Xác thực OTP thành công</p>");
													setTimeout(function(){
														window.location.href = response.url;
													},3000);
												}else{
													$(".success").append("<p class='error'>Sai mã OTP</p>");
												}
											}
										})
									}
								});

								$("input.pin-input").on('keydown',function(event){
									if(event.keyCode === 8 && $(this).val().length === 0){
										var previousTabIndex = parseInt($(this).attr("tabindex")) - 1;
										$("[tabindex='" + previousTabIndex + "']").focus();
									}
								});

								$(".resend").on("click",function(){
									time = 120;
									$.ajax({
										url:"{{URL('xac-minh-email')}}",
										type:"POST",
										data:{
											email:email,
											type:type
										},
										success:function(response){
											console.log(response);
										}
									});
								});
							}else{
								$(".valid").empty();
								$(".valid").append("<p class='error'>"+response.errors+"</p>");
							}
						}
					});
                });

				$(document).on('click',function(event){
					if(layoutVisible && !$(event.target).closest("#customAlert").length){
						$('#customAlert').fadeOut();
						$("#show").fadeOut();
						layoutVisible = false;
					}
				});

                $(document).on("click",".close-btn",function() {
					$('#customAlert').fadeOut();
					$("#show").fadeOut();
					layoutVisible = false;
				});
            })
        </script>
@endsection		