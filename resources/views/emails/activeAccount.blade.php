<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .container {
            margin: 0 auto;
        }
        h3, p{
            text-align: center;
        }
        .btn{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .btn-primary{
            margin: 0 auto;
            padding: 5px;
            background: rgb(232, 234, 237);
            border: none;
            border-radius: 5px;
            color: #000000;
            font-size: 18px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Xin chào: {{$data->name}}</h3>
        <p>Bạn đã đăng ký hệ thống tài khoản của chúng tôi</p>
        <p>Để có thể tiếp tục sử dụng bạn vui lòng nhấn vào nút kích hoạt tài khoản ở bên dưới</p>
        <div class="btn">
            <a href="{{route('active.user', ['id' => $data->id, 'token' => $data->token])}}" class="btn-primary">Kích hoạt tài khoản</a>
        </div>
    </div>
</body>
</html>