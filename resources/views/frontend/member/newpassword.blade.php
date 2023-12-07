@extends('frontend.layouts.app')
@section('content')
<!--// Mini Header \\-->
<div class="wm-mini-header">
			<span class="wm-blue-transparent"></span>
			 <div class="container">
			    <div class="row">
				    <div class="col-md-12">
				        <div class="wm-mini-title">
				       		<h1>Đặt lại mật khẩu</h1> 
				        </div>
				        <div class="wm-breadcrumb">
				          	<ul>
				          	 	<li><a href="index-2.html">Trang chủ</a></li>
				           		<li>Đặt lại mật khẩu</li>
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
								<h4>Đặt lại mật khẩu</h4>							
							</div>
							<div class="wm-student-dashboard-statement wm-dashboard-statement">
                                @if(session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                    <p><i class="icon fa fa-check"></i> Thông báo!</p>
                                    <p class="success">{{session('success')}}</p>
                                </div>
                                @endif
                                @if($errors->any())
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                    <p><i class="icon fa fa-check"></i> Thông báo!</p>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li id="error">{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <form action="" method="POST">
                                <div class="layout-first">
                                    <label>Vui lòng nhập mật khẩu mới</label>
                                    <input name="password" id="input" class="form-control"/>
                                </div>
                                <div class="layout">
                                    <label>Nhập lại mật khẩu mới</label>
                                    <input name="confirm_password" id="input" class="form-control"/>
                                </div>
                                <div class="layout-submit">
                                    <button type="submit" class="wm-register">Xác minh</button>
                                    @csrf
                                </div>
                                </form>
                            </div>	
						</div>
					</div>
				</div>
			</div>
            @if(session('success'))
                <script>
                    setTimeout(function(){
                        window.location.href = '{{URL('/')}}';
                    },3000);
                </script>
            @endif
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
                font-size: 13px;
            }
            .alert-dismissible{
                width: 35%;
            }
            .pin-input {
                width: 40px;
                height: 100px;
                font-size: 20px;
                text-align: center;
                margin-right: 10px;
            }
            li#error{
                color: #a94442;
                font-size: 13px;
                margin-left: -40px;
            }
            h4{
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            }
			.error{
				color: red;
				font-size: 12px;
			}
            .layout-submit{
                padding-top: 20px;
                padding-left: 120px;
            }
            .layout{
                padding-top: 20px;
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

			.close-btn {
				position: absolute;
				top: 10px;
				font-size: 20px;
				right: 5px;
				cursor: pointer;
			}
			.wm-register{
				background-color: #26B99A;
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
@endsection		