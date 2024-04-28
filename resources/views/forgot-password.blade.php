<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/svg/logo.svg') }}" type="image/x-icon">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">

    <style>
        .login-header {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
            text-align: center;

        }

        .form-btn {
            margin-top: 0.2rem;
        }
    </style>
</head>

<body>
		@include('sweetalert::alert')
    <div class="layer"></div>
    <main class="page-center">
        <article class="sign-up">
            <form class="sign-up-form form mt-5" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col text-center">
                        <h2 class="fw-bold text-center mb-3">Sistem Pemilihan Atlet PraPON Terbaik</h2>
                        <h3 class="fw-bold login-header">
                            PPLP Provinsi Bengkulu
                        </h3>
                    </div>
                </div>
                <label class="form-label-wrapper">
                    <p class="form-label">Email</p>
                    <input class="form-input" type="email" placeholder="Masukkan email" name="email" autofocus required>
					@error('email')
						<span>{{ $message }}</span>
					@enderror
                </label>
                <button type="submit" class="form-btn primary-default-btn transparent-btn">Kirim link reset password</button>
            </form>
        </article>
    </main>
    <!-- Chart library -->
    <script src="{{ asset('plugins/chart.min.js') }}"></script>
    <!-- Icons library -->
    <script src="{{ asset('plugins/feather.min.js') }}"></script>
    <!-- Custom scripts -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
