<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('demo5/src/images/favicon.png') }}">
    <!-- Page Title  -->
    <title>Login Kehadiran</title>
    <!-- StyleSheets  -->
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('demo5/src/assets/css/dashlite.css?ver=3.0.3') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('demo5/src/assets/css/theme.css?ver=3.0.3') }}">
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="{{ route('auth.login') }}" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg"
                                    src="{{ asset('demo5/src/images/logo.png') }}" srcset="./images/logo2x.png 2x"
                                    alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="./images/logo-dark.png"
                                    srcset="{{ asset('demo5/src/images/logo-dark2x.png 2x') }}" alt="logo-dark">
                            </a>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content ">
                                        <h4 class="nk-block-title center">SILAHKAN LOGIN</h4>
                                        <div class="nk-block-des">
                                            <p class="center">SISTEM KEHADIRAN PEGAWAI</p>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('login-proses') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="username">Username or Email</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" name="username" class="form-control form-control-lg"
                                                id="username" placeholder="Masukkan username atau email anda">
                                        </div>
                                    </div>
                                    @error('username')
                                        <small>{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Password</label>
                                            <a class="link link-primary link-sm"
                                                href="html/pages/auths/auth-reset-v2.html">Lupa Password??</a>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                                data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye-off"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye"
                                                    style="display:none;"></em>
                                            </a>
                                            <input type="password" name="password"class="form-control form-control-lg"
                                                id="password" placeholder="Masukkan password anda">
                                        </div>
                                    </div>
                                    @error('password')
                                        <small>{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Login</button>
                                    </div>
                                </form>
                                <div class="text-center pt-4 pb-3">
                                    <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
                                </div>
                                <ul class="nav justify-center gx-4">
                                    <li class="nav-item"><a class="nav-link" href="#">Facebook</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Google</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="./assets/js/bundle.js?ver=3.0.3"></script>
    <script src="./assets/js/scripts.js?ver=3.0.3"></script>
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
    @if ($message = Session::get('succes'))
        <script>
            Swal.fire('{{ $message }}');
        </script>
    @endif
    @if ($message = Session::get('failed'))
        <script>
            Swal.fire('{{ $message }}');
        </script>
    @endif

</html>
