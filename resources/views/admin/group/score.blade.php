@extends('admin.layouts.app')
@section('content')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-6 align-self-center">
                        <h4 class="page-title" id="page-title">Bảng điểm của nhóm học phần: {{$section->name}}</h4>
                    </div>
                    <div class="col-6 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Bảng điểm</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                            {{session('success')}}
                        </div>
                        @endif
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Mã sinh viên</th>
                                            <th scope="col">Tên sinh viên</th>
                                            <th scope="col">Lớp SH</th>
                                            <th scope="col">Điểm CC/GVHD</th>
                                            <th scope="col">Điểm Bài Tập</th>
                                            <th scope="col">Điểm Giữa Kì</th>
                                            <th scope="col">Điểm Cuối Kì / Đồ Án</th>
                                            <th scope="col">Điểm T10</th>
                                            <th scope="col">Điểm Chữ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @foreach($scores as $score)
                                        @php $i++; @endphp
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$score->code}}</td>
                                            <td>{{$score->name}}</td>
                                            <td>{{$score->class}}</td>
                                            <td>{{$score->diligence_score}}</td>
                                            <td>{{$score->homework_score}}</td>
                                            <td>{{$score->midterm_score}}</td>
                                            <td>{{$score->final_score}}</td>
                                            <td>{{$score->sum_t10_score}}</td>
                                            <td class="keyword">
												@if($score->sum_t10_score >= 8.5)
												<b class="success_score">A</b>
												@elseif($score->sum_t10_score >= 7 && $score->sum_t10_score <= 8.4)
												<b class="primary_score">B</b>
												@elseif($score->sum_t10_score >= 5.5 && $score->sum_t10_score <= 6.9)
												<b class="basic_score">C</b>
												@elseif($score->sum_t10_score >= 4 && $score->sum_t10_score <= 5.4)
												<b class="warning_score">D</b>
												@else
												<b class="danger_score">F</b>
												@endif
											</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" id="primary">
                        <form action="" method="POST">
                            <input type="hidden" name="type" value="2"/>
                            <button type="submit" class="btn btn-success" id="btn">Xác nhận điểm</a>
                            @csrf
                        </form>
                        <a href="{{URL('admin/group/subject/score/cancel/'.$section->id.'')}}" id="btn">
                            <button class="btn btn-danger">Hủy xác nhận điểm</button>
                        </a>
                    </div>
                </div>
            </div>
            <footer class="footer text-center">
                All Rights Reserved by Nice admin. Designed and Developed by
                <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
    <style>
        #btn {
            color: white;
            margin-right: 10px;
        }
        #primary{
            display: flex;
            margin-left: 30%;
        }
        #page-title{
            font-size: 16px;
        }
        .success_score{
			color: #008000;
		}
		.danger_score{
			color: red;
		}
		.primary_score{
			color: blue;
		}
		.basic_score{
			color: #73879C;
		}
		.warning_score{
			color: orange;
		}
    </style>
@endsection