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
    <link rel="shortcut icon" href="{{ asset('demo5/src/images/kehadirangacor.png') }}">
    <!-- Page Title  -->
    <title>Reset Password</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('demo5/src/assets/css/dashlite.css?ver=3.0.3') }}">
    <link id="skin-default" rel="stylesheet"
        href="{{ asset('demo5/src/assets/css/theme.css?ver=3.0.3"') }}'>
</head>

<body class="nk-body npc-crypto
        bg-white pg-auth">
    <!-- app body @s -->
    <div class="nk-app-root">
        <div class="nk-split nk-split-page nk-split-md">
            <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white w-lg-45">
                <div class="nk-block nk-block-middle nk-auth-body">
                    <div class="brand-logo pb-5">
                        <a href="{{ route('resetpassword') }}" class="logo-link">
                            <img class="logo-light logo-img logo-img-lg"
                                src="{{ asset('demo5/src/images/kehadiranmantap.png') }}"
                                srcset="{{ asset('demo5/src/images/kehadiranmantap.png') }} 2x" alt="logo">
                            <img class="logo-dark logo-img logo-img-lg"
                                src="{{ asset('demo5/src/images/kehadiranmantap.png') }}"
                                srcset="{{ asset('demo5/src/images/kehadiranmantap.png') }} 2x" alt="logo-dark">
                        </a>
                    </div>
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title">Reset password</h5>
                            <div class="nk-block-des">
                                <p>If you forgot your password, well, then we’ll email you instructions to reset your
                                    password.</p>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <form action="{{ route('gantipassword') }}" method="POST">
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password">Password Baru</label>
                            </div>
                            <div class="form-control-wrap">
                                <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                    data-target="password">
                                    <em class="passcode-icon icon-show icon ni ni-eye-off"></em>
                                    <em class="passcode-icon icon-hide icon ni ni-eye" style="display:none;"></em>
                                </a>
                                <input type="password" name="password" class="form-control form-control-lg"
                                    id="password" placeholder="Masukkan Password baru anda" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password">Konfirmasi Password</label>
                            </div>
                            <div class="form-control-wrap">
                                <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                    data-target="password">
                                    <em class="passcode-icon icon-show icon ni ni-eye-off"></em>
                                    <em class="passcode-icon icon-hide icon ni ni-eye" style="display:none;"></em>
                                </a>
                                <input type="password" name="password" class="form-control form-control-lg"
                                    id="password" placeholder="Konfirmasi Password baru anda" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-secondary">Ganti Password</button>
                        </div>
                    </form>

                    <div class="form-note-s2 pt-5">
                        <a href="{{ route('auth.login') }}"><strong>Return to login</strong></a>
                    </div>
                </div><!-- .nk-block -->
                <div class="nk-block nk-auth-footer">
                    <div class="mt-3">
                        <p>&copy; 2024 Sistem Kehadiran Pegawai. All Rights Reserved.</p>
                    </div>
                </div><!-- .nk-block -->
            </div><!-- .nk-split-content -->
            <div class="nk-split-content nk-split-stretch bg-abstract"></div><!-- .nk-split-content -->
        </div><!-- .nk-split -->
    </div><!-- app body @e -->
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
    <!-- select region modal -->

    </body>

</html>
