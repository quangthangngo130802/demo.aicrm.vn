<!DOCTYPE html>
<html>


<!-- Mirrored from id.tenten.vn/loginNavi by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2024 01:24:10 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>Login</title>
    <!-- css -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/6.0.0-beta1/css/tempus-dominus.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('auth/css/style.css') }}">
    <link rel="icon" href="https://sgomedia.vn/wp-content/uploads/2023/06/cropped-favicon-sgomedia-32x32.png"
        type="image/x-icon">
    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.marquee/1.5.0/jquery.marquee.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pause/0.2/jquery.pause.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/6.0.0-beta1/js/tempus-dominus.min.js">
    </script>
    <script src="{{ asset('auth/js/api.js') }}" async defer></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

</head>
<style type="text/css">
    .error_txt {
        color: red;
    }

    .active {
        display: none;
    }

    .btn {
        margin-top: 20px;
    }

    .pointer {
        cursor: pointer;
    }

    .g-recaptcha div {
        margin: auto;
    }

    .logo_login img {
        margin-bottom: 20px;
    }

    .loginButton:disabled {
        cursor: no-drop;
    }

    .disabled_button {
        background: #6d9abb !important;
        cursor: no-drop;
    }

    @media (min-width: 768px) {
        .login_page .ct_left {
            min-height: 625px;
        }

        .login_page .ct_right {
            min-height: 625px;
        }

        .add_phone {
            display: block;
            text-align: right;
        }

        .add_phone:first,
        {
        padding: 0px 26px !important;
    }
    }

    @media (min-width: 375px) and (max-width: 550px) {
        .rc-image-tile-33 {
            width: 200%;
            height: 200%;
        }

        .rc-image-tile-44 {
            width: 300%;
            height: 300%;
        }

        .add_phone {
            display: block;
            text-align: right;
            /* padding: 0px 29px; */
        }

        .add_phone:nth-of-type(1),
        {
        padding: 0px 29px;
    }
    }

    .support-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .support-item {
        display: flex;
        /* justify-content: space-between; */
        align-items: center;
        /* margin-bottom: 20px; */
    }

    .diff_strong {
        font-weight: bold;
        color: #fff;
        flex-shrink: 0;
        margin-right: 20px;
    }

    .phone-wrapper {
        display: flex;
        flex-direction: column;
        text-align: right;
        /* Căn phải */
    }

    .phone-wrapper span {
        /* display: flex; */
        justify-content: flex-end;
        /* Căn nội dung số điện thoại và chú thích bên phải */
        align-items: center;
        gap: 10px;
        /* Khoảng cách giữa số và chú thích */
    }

    .normal_strong {
        font-weight: normal;
        color: #fff;
    }

    p {
        margin: 0;
        font-size: 14px;
        color: #ddd;
    }

    body.no-scroll {
        margin: 0;
        height: 125vh;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa;
    }

</style>

<body class="form_page no-scroll">
    <div id="qb_content_navi_2021">
        <div class="login_display_02 login_page">
            <div class="ct_left">
                <h2 class="title_login">Liên hệ với chúng tôi</h2>
                <div class="ct_left_ct">
                    <ul class="support-list">
                        <li>
                            <div class="support-item">
                                <strong class="diff_strong">Hỗ trợ kỹ thuật:</strong>
                                <div class="phone-wrapper">
                                    <span>
                                        <strong class="normal_strong">(024) 62 927 089</strong>
                                        <p>(24/7)</p>
                                    </span>
                                    {{-- <span>
                                        <strong class="normal_strong">0981 185 620</strong>
                                        <p>(24/7)</p>
                                    </span> --}}
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="support-item">
                                <strong class="diff_strong">Hỗ trợ hoá đơn:</strong>
                                <div class="phone-wrapper">
                                    <span>
                                        <strong class="normal_strong">(024) 62 927 089</strong>
                                        <p>(8h30 - 18h00)</p>
                                    </span>
                                    {{-- <span>
                                        <strong class="normal_strong">0912 399 322</strong>
                                        <p>(8h30 - 18h00)</p>
                                    </span> --}}
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="support-item">
                                <strong class="diff_strong">Hỗ trợ gia hạn:</strong>
                                <div class="phone-wrapper">
                                    <span>
                                        <strong class="normal_strong">(024) 62 927 089</strong>
                                        <p>(8h30 - 18h00)</p>
                                    </span>
                                    {{-- <span>
                                        <strong class="normal_strong">0981 185 620</strong>
                                        <p>(8h30 - 18h00)</p>
                                    </span> --}}
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="support-item">
                                <strong class="diff_strong">Email:</strong>
                                <span>
                                    <strong class="normal_strong">info@sgomedia.vn</strong>
                                </span>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="ct_right">
                <div class="ct_right_ct">


                    <figure class="logo_login">
                        <a href="#"><img style="width: 250px !important"
                                src="{{ asset('images/sgovn.png') }}"
                                alt="logo-sgo-media"></a>
                    </figure>

                    <div class="login_form" id="login_form" style="display: block">
                        <form method="post" accept-charset="utf-8" id="form-login" action="{{ route('login') }}">
                            @csrf

                            <div class="form_group" style="display: block;">
                                <div class="list_group">
                                    <input type="text" name="username" autocomplete="off" required=""
                                        placeholder="username" id="username" value="{{ old('username') }}">
                                    <figure class="feild_icon"><img
                                            src="{{ asset('auth/images/login_user_icon.png') }}"></figure>
                                    @error('username')
                                        <small class="text-danger mb-2">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="list_group">
                                    <input type="password" name="password" autocomplete="off" required=""
                                        placeholder="Password" id="password" value="{{ old('password') }}">
                                    <figure class="feild_icon"><img
                                            src="{{ asset('auth/images/login_padlock_icon.png') }}"></figure>
                                    @error('password')
                                        <small class="text-danger mb-2">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="form-check my-3">
                                        <input class="form-check-input" name="remember" type="checkbox" id="remember">
                                        <label class="form-check-label" for="remember">
                                            Lưu mật khẩu
                                        </label>
                                    </div>
                                </div>


                                {{-- {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}

                                @error('g-recaptcha-response')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror --}}

                                <div class="btn">
                                    <button type="submit" name="button"
                                        class="loginButton loginButtonGg remove-msg before-login " id="submitBtn">Đăng
                                        nhập</button>
                                </div>
                            </div>

                        </form>
                        <div class="create_forget_acc" style="display: flex; justify-content: end;">
                            <a href="{{ route('forget-password') }}" class="btn_login remove-msg forgot-pass"
                                style="margin-bottom: 15px;" id="forgot-password">Quên mật khẩu?</a>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>

</body>


</html>
