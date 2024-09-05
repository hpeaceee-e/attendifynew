<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="{{ asset('demo5/src/images/favicon.png') }}">
    <!-- Page Title -->
    <title>Login Kehadiran</title>
    <!-- StyleSheets -->
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('demo5/src/assets/css/dashlite.css?ver=3.0.3') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('demo5/src/assets/css/theme.css?ver=3.0.3') }}">

    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            color: #fff;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .left-side {
            width: 50%;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
        }

        .right-side {
            width: 50%;
            background-image: url('{{ asset('demo5/src/images/background/attendance2.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Kotak tambahan */
        .form-container {
            background: #f7f9fc;
            padding: 2rem;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .form-wrapper {
            width: 100%;
            max-width: 400px;
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo img {
            max-width: 50px;
        }

        .nk-block-title {
            text-align: center;
            margin-bottom: 1rem;
        }

        .nk-block-des {
            text-align: center;
            margin-bottom: 2rem;
        }

        @media screen and (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left-side,
            .right-side {
                width: 100%;
                height: 50vh;
            }

            .form-container {
                margin-top: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Left Side: Login Form -->
        <div class="left-side">
            <div class="form-wrapper">
                <div class="form-container">
                    <div class="brand-logo">
                        <a href="{{ route('auth.login') }}" class="logo-link">
                            <img class="logo-light logo-img logo-img-lg" src="{{ asset('demo5/src/images/logo.png') }}"
                                srcset="{{ asset('demo5/src/images/logo2x.png') }} 2x" alt="logo">
                        </a>
                    </div>
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title">Login</h5>
                            <div class="nk-block-des">
                                <p>Access the attendance system using your username and password.</p>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <form action="{{ route('login-proses') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="username">Username</label>
                            <div class="form-control-wrap">
                                <input type="text" name="username" class="form-control form-control-lg"
                                    id="username" placeholder="Enter your username">
                            </div>
                            @error('username')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <div class="form-control-wrap">
                                <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                    data-target="password">
                                    <em class="passcode-icon icon-show icon ni ni-eye-off"></em>
                                    <em class="passcode-icon icon-hide icon ni ni-eye" style="display:none;"></em>
                                </a>
                                <input type="password" name="password" class="form-control form-control-lg"
                                    id="password" placeholder="Enter your password">
                            </div>
                            @error('password')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-primary btn-block">Login</button>
                        </div>
                    </form><!-- form -->
                    <div class="nk-block nk-auth-footer">
                        <div class="mt-3">
                            <p>&copy; 2022 DashLite. All Rights Reserved.</p>
                        </div>
                    </div><!-- .nk-block -->
                </div><!-- .form-container -->
            </div><!-- .form-wrapper -->
        </div><!-- .left-side -->

        <!-- Right Side: Attendance Image -->
        <div class="right-side">
            <!-- The background image is set via CSS -->
        </div><!-- .right-side -->
    </div><!-- .container -->

    <!-- JavaScript -->
    <script src="{{ asset('demo5/src/assets/js/bundle.js?ver=3.0.3') }}"></script>
    <script src="{{ asset('demo5/src/assets/js/scripts.js?ver=3.0.3') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('.passcode-switch');
            const passwordInput = document.getElementById('password');
            const iconShow = togglePassword.querySelector('.icon-show');
            const iconHide = togglePassword.querySelector('.icon-hide');

            togglePassword.addEventListener('click', function(e) {
                e.preventDefault();
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    iconShow.style.display = 'none';
                    iconHide.style.display = 'block';
                } else {
                    passwordInput.type = 'password';
                    iconShow.style.display = 'block';
                    iconHide.style.display = 'none';
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginButton = document.querySelector('button[type="submit"]');

            @if ($message = Session::get('success'))
                Swal.fire({
                    title: '{{ $message }}',
                    icon: 'success',
                    confirmButtonColor: '#28a745'
                }).then(() => {
                    loginButton.style.backgroundColor = '#28a745'; // Green
                    loginButton.style.borderColor = '#28a745';
                });
            @endif

            @if ($message = Session::get('failed'))
                Swal.fire({
                    title: '{{ $message }}',
                    icon: 'error',
                    confirmButtonColor: '#dc3545'
                }).then(() => {
                    loginButton.style.backgroundColor = '#dc3545'; // Red
                    loginButton.style.borderColor = '#dc3545';
                });
            @endif
        });
    </script>
</body>

</html>
