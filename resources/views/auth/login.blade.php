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

            body {
                min-height: 100vh;
                background: #134E8E;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .login-card {
                width: 100%;
                max-width: 420px;
                background: white;
                border-radius: 20px;
                padding: 35px;
                box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            }

            .login-icon {
                width: 70px;
                height: 70px;
                background: #FFB2B2;
                color: #134E8E;
                border-radius: 18px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 20px;
                font-size: 32px;
            }

            .form-control {
                height: 48px;
                border-radius: 10px;
            }

            .btn-login {
                height: 48px;
                border: none;
                border-radius: 10px;
                background: #134E8E;
                color: white;
                font-weight: 600;
            }

            .btn-login:hover {
                background: #0e3d70;
                color: white;
            }

        </style>

    </head>

    <body>

        <div class="login-card">

            <div class="text-center">

                <div class="login-icon">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>

                <h3 class="fw-bold mb-1">
                    Admin Sekolah
                </h3>

                <p class="text-muted mb-4">
                    Silakan masuk untuk mengelola data sekolah
                </p>

            </div>


            @if(session('error'))

                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>

            @endif


            @if($errors->any())

                <div class="alert alert-danger">

                    @foreach($errors->all() as $error)

                        <div>{{ $error }}</div>

                    @endforeach

                </div>

            @endif


            <form action="{{ route('login.process') }}"
                method="POST">

                @csrf


                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Username
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>

                        <input type="text"
                            name="username"
                            class="form-control"
                            value="{{ old('username') }}"
                            placeholder="Masukkan username"
                            required>

                    </div>

                </div>


                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>

                        <input type="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan password"
                            required>

                    </div>

                </div>


                <button type="submit"
                        class="btn btn-login w-100">

                    <i class="bi bi-box-arrow-in-right me-2"></i>

                    Login

                </button>

            </form>

        </div>

    </body>

    </html>
