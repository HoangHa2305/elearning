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
							<h4 class="topic">Danh sách Đồ án\Đề án của tôi</h4>
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
                                <div>
                                    <p class="question">Bạn đã có nhóm chưa?</p>
                                </div>
                                <br>
                                <br>
                                <div class="form-check">
                                    <input type="radio" name="parent" value="0" {{($report->parent == 0) ? 'checked' : ''}} class="form-check-input parent-radio"/>
                                    <label class="form-check-label parent-radio" for="parent">Tôi là trưởng nhóm hoặc làm đề tài 1 mình</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="parent" value="1" {{$report->parent == 1 ? 'checked' : ''}} class="form-check-input parent-radio"/>
                                    <label class="form-check-label parent-radio" for="parent">Tôi đã có nhóm rồi</label>
                                </div>
                                <hr>
                                <div class="content-layout">
                                    @if($report->parent==0)
                                    <div class="form">
                                        <label id="label">Tên đề tài</label>
                                        @if(isset($report->title))
                                        <input type="text" name="title" id="custom-input" value="{{$report->title}}" class="form-control"/>
                                        @else
                                        <input type="text" name="title" id="custom-input" class="form-control"/>
                                        @endif
                                    </div>
                                    <div class="form">
                                        <label id="label">Kết quả dự kiến</label>
                                        <textarea name="desc_topic" id="textarea" class="form-control">{{isset($report->desc_topic)==true ? $report->desc_topic : ''}}</textarea>
                                    </div>
                                    <div class="form">
                                        <label id="label">Nộp file đề cương (*.doc, *.docx) (mẫu xem tại đây)</label>
                                        <input type="file" name="topic" accept=".doc, .docx"/>
                                    </div>
                                    @elseif($report->parent==1)
                                    <div class="form-select">
                                        <label id="label">Nhóm</label>
                                        <div class="form-option">
                                            <select class="form-control" name="id_parent" size="5">
                                                <option>Chọn nhóm</option>
                                                @foreach($leaders as $leader)
                                                <option value="{{$leader->id}}">
                                                    (Trưởng nhóm: {{$leader->student->name}}) - {{isset($leader->title)==true ? $leader->title : 'Chưa đăng ký đề tài'}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item-center">
                                        <button class="btn btn-success">Cập nhật</button>
                                    </div>
                                    @endif
                                </div>
                                <div class="type-submit">
                                @if($report->parent==0)
                                <button class="btn btn-success">Cập nhật</button>
                                @endif
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
                background-color: #ffffff;
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
        <script>
            $(document).ready(function(){
                $.ajaxSetup({ 
                    headers: { 
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    } 
                });

                $("#textarea").each(function(){
                    $(this).val($(this).val().trim());
                });

                var report = <?php echo json_encode($report) ?>;
                var leaders = <?php echo json_encode($leaders) ?>;

                $(".parent-radio").on('click',function(){
                    var value = $("[name=parent]:checked").val();
                    if(value==0){
                        $(".content-layout").html(
                            "<div class='form'>"
                                +"<label id='label'>Tên đề tài</label>"
                                +"<input type='text' name='title' id='custom-input' "+((report.title) ? "value='"+report.title+"'" : '')+" class='form-control'/>"
                            +"</div>"
                            +"<div class='form'>"
                                +"<label id='label'>Kết quả dự kiến</label>"
                                +"<textarea name='desc_topic' id='textarea' class='form-control'>"+((report.desc_topic)? report.desc_topic : '')+"</textarea>"
                            +"</div>"
                            +"<div class='form'>"
                                +"<label id='label'>Nộp file đề cương (*.doc, *.docx) (mẫu xem tại đây)</label>"
                                +"<input type='file' name='topic' accept='.doc, .docx'/>"
                            +"</div>"
                        );
                        $(".type-submit").html(
                            "<button class='btn btn-success'>Cập nhật</button>"
                        )
                    }else if(value==1){
                        $(".content-layout").html(
                            "<div class='form-select'>"
                                +"<label id='label'>Nhóm</label>"
                                +"<div class='form-option'>"
                                    +"<select class='form-control' name='id_parent' size='5'>"
                                        +"<option>Chọn nhóm</option>"
                                        +leaders.map(function(item){
                                            return "<option value="+item.id+">"
                                                    +"(Trưởng nhóm: "+item.student.name+") - "+(item.title ? item.title : "Chưa đăng ký đề tài")
                                                    +"</option>"
                                        }).join('')
                                    +"</select>"
                                +"</div>"
                            +"</div>"
                            +"<div class='item-center'>"
                                +"<button class='btn btn-success'>Cập nhật</button>"
                            +"</div>"
                        );
                        $(".type-submit").empty();
                    }
                });
            });
        </script>
@endsection   

                                    
                                        
                                        
                                            
                                                
                                                @foreach($leaders as $leader)
                                                <option value="{{$leader->id}}">
                                                    (Trưởng nhóm: {{$leader->student->name}}) - {{isset($leader->title)==true ? $leader->title : 'Chưa đăng ký đề tài'}}
                                                </option>
                                                @endforeach
                                            
                                        
                                    

                                    
                                        
                                    