<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inventory & Sales Management System</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('dashboard/assets/images/favicon.ico') }}">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #0f172a;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .auth-thumbnail {
            width: 100%;
            max-width: 920px;
            background: #ffffff;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        }

        .top-area {
            background: linear-gradient(135deg, #537aef, #537aef);
            padding: 60px 25px 100px;
            position: relative;
            text-align: center;
            color: white;
        }

        .top-area::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -1px;
            width: 100%;
            height: 90px;
            background: white;
            border-radius: 100% 100% 0 0;
        }

        .shield {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.3);
            margin: auto;
            border-radius: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(10px);
        }

        .shield i {
            font-size: 45px;
        }

        .content {
            padding: 20px 30px 40px;
            text-align: center;
            margin-top: -30px;
            position: relative;
            z-index: 10;
        }

        .content h1 {
            font-size: 38px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 10px;
        }

        .content p {
            color: #64748b;
            font-size: 30px;
            margin-bottom: 35px;
            text-transform: uppercase
        }

        .btn-custom {
            width: 100%;
            padding: 14px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            transition: 0.3s;
            margin-bottom: 18px;
        }

        .btn-login {
            background: linear-gradient(135deg, #537aef, #14b8a6);
            color: white;
            border: none;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            opacity: 0.95;
        }

        .btn-register {
            background: white;
            color: #0f766e;
            border: 2px solid #537aef;
        }

        .btn-register:hover {
            background: #537aef;
            color: white;
        }

        .bottom-text {
            margin-top: 15px;
            color: #94a3b8;
            font-size: 14px;
        }

        .bottom-text a {
            list-style: none;
            text-decoration: none;
            color: #0f172a;
            font-size: 20px;
            font-weight: 700;
        }

        @media(max-width:576px) {

            .top-area {
                padding: 45px 20px 85px;
            }

            .content {
                padding: 15px 20px 35px;
            }

            .content h1 {
                font-size: 30px;
            }

            .btn-custom {
                font-size: 16px;
                padding: 12px;
            }

        }
    </style>
</head>
<body>

    <div class="auth-thumbnail">
        <div class="top-area"></div>
        <div class="content">
            <h1>Welcome</h1>
            <p>
                Mini Inventory & Sales Management System
            </p>
            <a href="{{ route('login') }}" class="btn btn-custom btn-login">
                Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-custom btn-register">
                Registration
            </a>
            <div class="bottom-text">
                <a href="https://github.com/rbrazib77">Razib Bepary Imran</a>
            </div>
        </div>
    </div>
</body>

</html>
