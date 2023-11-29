@extends('frontend.layouts.app')
@section('content')
        <!--// Mini Header \\-->
        <div class="wm-mini-header">
			<span class="wm-blue-transparent"></span>
			 <div class="container">
			    <div class="row">
				    <div class="col-md-12">
				        <div class="wm-mini-title">
				       		<h1>Student Dashboard</h1> 
				        </div>
				        <div class="wm-breadcrumb">
				          	<ul>
				          	 	<li><a href="index-2.html">Home</a></li>
				          	 	<li><a href="#">Student Dashboard</a></li>
				           		<li>Settings</li>
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
				<div class="row">
					<div class="col-md-12">
						<div class="wm-plane-title">
							<h4 class="topic">Nộp đồ án: báo cáo, slide, mã nguồn (nếu có)</h4>
							<hr style="border: 1px solid #E6E9ED;">							
						</div>
						<div class="alert-success">
							<p class="note-content">
                            - Sinh viên cần phải gặp Giảng viên để thực hiện đề án/đồ án theo thời 
                                gian/phòng/lịch đăng ký hoặc liên lạc trực tiếp SĐT của giảng viên
								<br>
                            - Sinh viên tham khảo <b>mẫu tài liệu đề cương chi tiết đồ án / đề án</b> 
                            tại đây
                            <br>
                            - Sinh viên cần lưu ý các mốc phải hoàn thành (nộp đề cương, nộp kết quả 
                            thực hiện) theo đúng thời gian quy định.
                            <br>
                            - Giảng viên sẽ căn cứ vào trao đổi, báo cáo hệ thống để xác nhận bạn có 
                            được <b>chấp thuận đề cương</b> hoặc <b>cho phép bảo vệ đề tài/đề án</b> hay không
							</p>
						</div>
						<div class="wm-student-dashboard-statement wm-dashboard-statement">
                            <form action="" method="POST" enctype="multipart/form-data">
                            <div class="package">
                                <div class="content-layout">
                                    <div class="form">
                                        <label id="label">Nộp file báo cáo (*.doc, *.docx) (mẫu xem tại đây)
                                            <br>
                                            Báo cáo phải được ký duyệt bởi giảng viên hướng dẫn trước khi Bảo 
                                            vệ trước Hội đồng.
                                        </label>
                                        <input type="file" name="report" id="custom-input" accept=".doc, .docx" class="form-control"/>
                                        <p>Thao tác:</p>
                                    </div>
                                    <br>
                                    <div class="form">
                                        <label id="label">
                                            Đường dẫn mã nguồn, báo cáo, slide,.. ở chế độ share public 
                                            (google drive). Xem hướng dẫn tại đây.
                                            <br>
                                            Trong trường hợp tài nguyên slide, mã nguồn (nếu có) chưa được cấp 
                                            quyền để tải theo hướng dẫn, trường hợp này coi như sinh viên 
                                            <br>không nộp tài nguyên slide, mã nguồn
                                        </label>
                                        <input type="text" name="desc_report" id="custom-input" placeholder="Điền Url Google drive tài nguyên slide, mã nguồn" class="form-control"/>
                                    </div>
                                </div>
                                <div class="type-submit">
                                    <button class="btn btn-success">Cập nhật báo cáo</button>
                                    <button class="btn btn-warning">Quay về</button>
                                </div>
                            </div>
                            @csrf
                            </form>
						</div>								
					</div>
				</div>
			</div>
		</div>
		<!--// Main Section \\-->
		<style>
			p, span {
				margin: 0;
				padding: 0;
			}
            #textarea{
                margin: 0;
                padding: 10px;
            }
            .package{
                margin-top: 20px;
            }
			.wm-plane-title{
				background-color: #F5FBFD
			}
			.topic{
				font-family: 'Inter', sans-serif;
				font-size: 18px;
			}
			.alert-success{
				background-color: #dff0d8;
				border-color: #dff0d8;
				padding: 20px;
			}
			.note-content{
				color: #3c763d;
				font-size: 14px;
				font-family: 'Inter', sans-serif;
			}
			.wm-article{
				border-collapse: collapse;
			}
			.question{
                font-size: 18px;
            }
            .parent-radio{
                display: inline;
            }
            .btn-success{
                background-color: #26B99A;
                border: 1px solid #169F85;
            }
            #custom-input{
                color: #555;
                background-color: #F5FBFD;
                border: 1px solid #ccc;
            }
            .form{
                margin-top: 20px;
                margin-bottom: 20px;
            }
            .form-select{
                margin-top: 20px;
                margin-bottom: 20px;
                display: flex;
            }
            .form-option{
                width: 50%;
                margin-left: 40%;
            }
            #label{
                color: #73879C;
                font-weight: 700;
                margin-bottom: 10px;
            }
            .item-center{
                text-align: center;
            }
		</style>
@endsection                                     