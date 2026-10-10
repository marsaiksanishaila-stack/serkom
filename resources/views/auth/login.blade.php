<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Login | Admin Sekolah</title>

    <link rel="stylesheet"
        href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;

            font-family:
                "Segoe UI",
                Tahoma,
                Geneva,
                Verdana,
                sans-serif;

            background:
                linear-gradient(
                    135deg,
                    #0f3f73 0%,
                    #134E8E 45%,
                    #2874b9 100%
                );

            display: flex;
            align-items: center;
            justify-content: center;

            position: relative;
            overflow: hidden;
        }


        /* =========================
           BACKGROUND DECORATION
        ========================= */

        body::before {
            content: "";
            position: absolute;

            width: 500px;
            height: 500px;

            background: rgba(255, 255, 255, 0.08);

            border-radius: 50%;

            top: -220px;
            left: -180px;
        }


        body::after {
            content: "";
            position: absolute;

            width: 600px;
            height: 600px;

            background: rgba(255, 178, 178, 0.10);

            border-radius: 50%;

            bottom: -300px;
            right: -220px;
        }


        /* =========================
           LOGIN WRAPPER
        ========================= */

        .login-wrapper {
            width: 100%;
            max-width: 1000px;

            padding: 25px;

            position: relative;
            z-index: 2;
        }


        /* =========================
           LOGIN CARD
        ========================= */

        .login-card {
            width: 100%;

            background: rgba(255, 255, 255, 0.98);

            border-radius: 26px;

            overflow: hidden;

            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.20);

            display: flex;

            min-height: 560px;
        }


        /* =========================
           LEFT SIDE
        ========================= */

        .login-left {
            width: 45%;

            background:
                linear-gradient(
                    145deg,
                    #134E8E,
                    #1d65a3
                );

            color: white;

            padding: 55px 45px;

            display: flex;
            flex-direction: column;
            justify-content: center;

            position: relative;

            overflow: hidden;
        }


        .login-left::before {
            content: "";

            position: absolute;

            width: 300px;
            height: 300px;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.06);

            top: -120px;
            right: -100px;
        }


        .login-left::after {
            content: "";

            position: absolute;

            width: 220px;
            height: 220px;

            border-radius: 50%;

            background: rgba(255, 178, 178, 0.10);

            bottom: -100px;
            left: -80px;
        }


        .school-icon {
            width: 82px;
            height: 82px;

            border-radius: 22px;

            background: rgba(255, 255, 255, 0.15);

            border: 1px solid rgba(255, 255, 255, 0.25);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 38px;

            margin-bottom: 28px;

            position: relative;
            z-index: 2;
        }


        .login-left h1 {
            font-size: 34px;

            font-weight: 700;

            line-height: 1.25;

            margin-bottom: 15px;

            position: relative;
            z-index: 2;
        }


        .login-left p {
            font-size: 15px;

            line-height: 1.8;

            color: rgba(255, 255, 255, 0.82);

            max-width: 330px;

            margin-bottom: 30px;

            position: relative;
            z-index: 2;
        }


        .school-info {
            display: flex;

            align-items: center;

            gap: 10px;

            font-size: 14px;

            color: rgba(255, 255, 255, 0.85);

            position: relative;
            z-index: 2;
        }


        .school-info i {
            color: #FFB2B2;
        }


        /* =========================
           RIGHT SIDE
        ========================= */

        .login-right {
            width: 55%;

            padding: 55px 60px;

            display: flex;

            flex-direction: column;

            justify-content: center;
        }


        .login-header {
            margin-bottom: 30px;
        }


        .login-header h3 {
            color: #1d2939;

            font-size: 28px;

            font-weight: 700;

            margin-bottom: 8px;
        }


        .login-header p {
            color: #667085;

            font-size: 14px;

            margin-bottom: 0;
        }


        /* =========================
           ALERT
        ========================= */

        .alert {
            border: none;

            border-radius: 12px;

            font-size: 14px;
        }


        /* =========================
           FORM
        ========================= */

        .form-label {
            color: #344054;

            font-size: 14px;

            margin-bottom: 8px;
        }


        .input-group {
            position: relative;
        }


        .input-group-text {
            width: 48px;

            justify-content: center;

            background: #f8fafc;

            border: 1px solid #d0d5dd;

            border-right: none;

            color: #667085;

            border-radius: 12px 0 0 12px;
        }


        .form-control {
            height: 50px;

            border: 1px solid #d0d5dd;

            border-left: none;

            border-radius: 0 12px 12px 0;

            font-size: 14px;

            color: #101828;

            box-shadow: none;
        }


        .form-control:focus {
            border-color: #134E8E;

            box-shadow:
                0 0 0 3px rgba(19, 78, 142, 0.10);
        }


        .input-group:focus-within .input-group-text {
            border-color: #134E8E;

            color: #134E8E;

            background: #f5f9fd;
        }


        .form-control::placeholder {
            color: #98a2b3;
        }


        /* =========================
           LOGIN BUTTON
        ========================= */

        .btn-login {
            height: 50px;

            border: none;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    #134E8E,
                    #1d65a3
                );

            color: white;

            font-size: 15px;

            font-weight: 600;

            transition: all 0.25s ease;

            box-shadow:
                0 8px 20px rgba(19, 78, 142, 0.20);
        }


        .btn-login:hover {
            color: white;

            transform: translateY(-2px);

            box-shadow:
                0 12px 25px rgba(19, 78, 142, 0.28);
        }


        .btn-login:active {
            transform: translateY(0);
        }


        /* =========================
           FOOTER
        ========================= */

        .login-footer {
            text-align: center;

            margin-top: 28px;

            color: #98a2b3;

            font-size: 12px;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 768px) {

            body {
                padding: 20px;
            }


            .login-wrapper {
                padding: 0;
            }


            .login-card {
                display: block;

                min-height: auto;

                border-radius: 20px;
            }


            .login-left {
                width: 100%;

                padding: 35px 30px;

                text-align: center;

                align-items: center;
            }


            .login-left h1 {
                font-size: 27px;
            }


            .login-left p {
                max-width: 500px;
            }


            .school-icon {
                margin-bottom: 20px;
            }


            .school-info {
                justify-content: center;
            }


            .login-right {
                width: 100%;

                padding: 40px 30px;
            }

        }


        @media (max-width: 480px) {

            .login-left {
                padding: 30px 22px;
            }


            .login-right {
                padding: 35px 22px;
            }


            .login-header h3 {
                font-size: 24px;
            }

        }

    </style>

</head>


<body>


    <div class="login-wrapper">

        <div class="login-card">


            <!-- =========================
                 LEFT
            ========================== -->

            <div class="login-left">

                <div class="school-icon">

                    <i class="bi bi-mortarboard-fill"></i>

                </div>


                <h1>
                    Admin Sekolah
                </h1>


                <p>
                    Kelola informasi dan data sekolah
                    dengan mudah melalui halaman
                    administrator.
                </p>


                <div class="school-info">

                    <i class="bi bi-shield-check"></i>

                    <span>
                        Sistem Administrasi Sekolah
                    </span>

                </div>

            </div>



            <!-- =========================
                 RIGHT
            ========================== -->

            <div class="login-right">


                <div class="login-header">

                    <h3>
                        Selamat Datang 👋
                    </h3>

                    <p>
                        Silakan masuk menggunakan akun administrator Anda.
                    </p>

                </div>



                <!-- ERROR SESSION -->

                @if(session('error'))

                    <div class="alert alert-danger mb-4">

                        <i class="bi bi-exclamation-circle me-2"></i>

                        {{ session('error') }}

                    </div>

                @endif



                <!-- VALIDATION ERROR -->

                @if($errors->any())

                    <div class="alert alert-danger mb-4">

                        <div class="fw-semibold mb-1">
                            Terjadi kesalahan:
                        </div>

                        @foreach($errors->all() as $error)

                            <div>
                                {{ $error }}
                            </div>

                        @endforeach

                    </div>

                @endif



                <form action="{{ route('login.process') }}"
                      method="POST">

                    @csrf


                    <!-- USERNAME -->

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Username

                        </label>


                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-person-fill"></i>

                            </span>


                            <input type="text"
                                   name="username"
                                   class="form-control"
                                   value="{{ old('username') }}"
                                   placeholder="Masukkan username"
                                   autocomplete="username"
                                   required>

                        </div>

                    </div>



                    <!-- PASSWORD -->

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Password

                        </label>


                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-lock-fill"></i>

                            </span>


                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Masukkan password"
                                   autocomplete="current-password"
                                   required>

                        </div>

                    </div>



                    <!-- BUTTON -->

                    <button type="submit"
                            class="btn btn-login w-100">

                        <i class="bi bi-box-arrow-in-right me-2"></i>

                        Masuk 

                    </button>

                </form>



                <div class="login-footer">

                    <i class="bi bi-lock-fill me-1"></i>

                    Akses khusus administrator sekolah

                </div>


            </div>


        </div>

    </div>


</body>

</html>