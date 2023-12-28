<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <P>Hệ thống quản lý đào tạo thông báo:</P>
    <br>
    <p>Hệ thống ghi nhận GV <b>{{$data['teacher']}}</b> báo nghỉ lớp học phần 
        <b>{{$data['section']}}</b>.
    Thông tin cụ thể như sau:</p>
    <br>
    <p>- Thời gian nghỉ: {{$data['date']}}</p>
    <br>
    <p>- Lý do: {{$data['reason']}}</p>
    <br>
    <p>Đây là email tự động, vui lòng không phản hồi lại email này.</p>
</body>
</html>