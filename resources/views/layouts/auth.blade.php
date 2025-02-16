<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Sistem Informasi StokMate</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Raleway:wght@400;600&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Raleway', sans-serif;
            background-image: url('{{ asset('lte/dist/img/gudang.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .login-box {
            width: 400px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .login-logo a {
            font-size: 30px;
            color: #4d5f71;
            font-weight: bold;
            font-family: 'Raleway', sans-serif;
            letter-spacing: 0;
            text-align: center;
        }

        .card-body {
            padding: 20px;
        }

        .login-box-msg {
            font-family: 'Raleway', sans-serif;
            font-size: 18px;
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 12px 0;
        }

        .social-auth-links {
            text-align: center;
            margin-top: 15px;
        }

        .social-auth-links .btn {
            width: 100%;
        }

        .form-control {
            border-radius: 5px;
            font-size: 14px;
        }

        .alert-danger {
            font-size: 14px;
            text-align: center;
        }

        .input-group-text {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}"><b>Sistem Informasi</b> StokMate</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Selamat Datang</p>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" required
                            autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
