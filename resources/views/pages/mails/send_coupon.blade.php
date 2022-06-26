<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        body {
            font-family: Arial;
        }

        .coupon {
            border: 5px dotted #bbb;
            width: 80%;
            border-radius: 15px;
            margin: 0 auto;
        }

        .container {
            padding: 2px 16px;
            background-color: #f1f1f1;
        }

        .promo {
            background: #ccc;
            padding: 3px;
        }

        .expire {
            color: red;
        }

        p.code {
            text-align: center;
            font-size: 20px;
        }

        p.expire {
            text-align: center;
        }

        h2.note {
            text-align: center;
            font-size: large;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="coupon">
        <div class="container">
            <h3>Mã Khuyến mã từ
                <a href="https://www.facebook.com/NguyenQuocCuong143/" target="_blank">Joy Boy</a>
            </h3>
        </div>
        <div class="container" style="background-color: white;">
            @if($coupon['coupon_condition'] ==1)
            <h2 class="note"><b><i>Giảm {{$coupon['coupon_number']}}% cho tổng hóa đơn</i></b></h2>
            @else
            <h2 class="note"><b><i>Giảm {{number_format($coupon['coupon_number'])}} vnđ cho tổng hóa đơn</i></b></h2>
            @endif
            <p>Quỳ khách đã từng mua hàng tại <a style="color: red;" href="http://joyboy.local.com/" target="_blank">Joy Boy</a>
                Nếu đã có tài khoản xin vui lòng <a style="color: blue;" href="http://joyboy.local.com/login-checkout" target="_blank">Đăng Nhập</a>
                vào tài khoản để mua hàng và nhập mã code phía dưới để được giảm giá, xin cảm ơn quý khách. Chúc quý khách thật nhiều sức khỏe và bình an trong cuộc sống.
            </p>
        </div>
        <div class="container">
            <p class="code"> Sử dụng code sau: <span class="promo">{{$coupon['coupon_code']}}</span> với chỉ {{$coupon['coupon_time']}} mã</p>
            <p class="expire">Ngày bắt đầu của code : {{$coupon['coupon_day_start']}}</p>
            <p class="expire">Ngày hết hạn của code : {{$coupon['coupon_day_end']}}</p>
        </div>
    </div>
</body>

</html>