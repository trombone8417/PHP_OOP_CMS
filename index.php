<?php
session_start();
if (isset($_SESSION['user'])) {
    header('location:home.php');
}
?>
<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KUEI OOP PHP</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container">
        <!-- 登入頁面開始 -->
        <div class="row justify-content-center wrapper" id="login-box">
            <div class="col-lg-10 my-auto">
                <div class="card-group myShadow">
                    <div class="card rounded-left p-4" style="flex-grow: 1.4;">
                        <h1 class="text-center font-weight-bold text-primary">登入</h1>
                        <hr class="my-3">
                        <form action="#" method="post" class="px-3" id="login-form">
                            <div id="loginAlert"></div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="far fa-envelope fa-lg"></i>
                                    </span>
                                </div>
                                <!-- 若有選擇記住我的話，顯示Email -->
                                <input type="email" name="email" id="email" class="form-control rounded-0" placeholder="Email" required value="<?php if (isset($_COOKIE['email'])) {
                                                                                                                                                    echo $_COOKIE['email'];
                                                                                                                                                }; ?>">

                            </div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="fas fa-key fa-lg "></i>
                                    </span>
                                </div>
                                <!-- 若有選擇記住我的話，顯示密碼 -->
                                <input type="password" name="password" id="password" class="form-control rounded-0" minlength="5" placeholder="Password" required autocomplete="off" value="<?php if (isset($_COOKIE['password'])) {
                                                                                                                                                                                                echo $_COOKIE['password'];
                                                                                                                                                                                            }; ?>">

                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox float-left">
                                    <!-- 若有存COOKIE的話checkbox打勾 -->
                                    <input type="checkbox" name="rem" class="custom-control-input" id="customCheck" <?php if (isset($_COOKIE['email'])) { ?> checked <?php } ?>>
                                    <label for="customCheck" class="custom-control-label">記住我</label>

                                </div>
                                <div class="forget float-right">
                                    <a href="#" id="forgot-link">忘記密碼</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="登入" id="login-btn" class="btn btn-primary btn-lg btn-block myBtn">
                            </div>
                        </form>
                    </div>
                    <div class="card justify-content-center rounded-right myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">您好</h1>
                        <hr class="my-3 bg-light myHr">
                        <p class="text-center font-weight-bolder text-light lead">Enter your personal details and start your journey with us! </p>
                        <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="register-link">註冊</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 登入頁面結束 -->

        <!-- 註冊頁面開始 -->
        <div class="row justify-content-center wrapper" id="register-box" style="display: none;">
            <div class="col-lg-10 my-auto">
                <div class="card-group myShadow">
                    <div class="card justify-content-center rounded-left myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">歡迎回來</h1>
                        <hr class="my-3 bg-light myHr">
                        <p class="text-center font-weight-bolder text-light lead">Enter your personal details and start your journey with us! </p>
                        <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="login-link">登入</button>
                    </div>
                    <div class="card rounded-right p-4" style="flex-grow: 1.4;">
                        <h1 class="text-center font-weight-bold text-primary">註冊</h1>
                        <hr class="my-3">
                        <form action="#" method="post" class="px-3" id="register-form">
                            <div id="regAlert"></div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="far fa-user fa-lg"></i>
                                    </span>
                                </div>

                                <input type="text" name="name" id="name" class="form-control rounded-0" placeholder="全名" required>

                            </div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="far fa-envelope fa-lg"></i>
                                    </span>
                                </div>

                                <input type="email" name="email" id="remail" class="form-control rounded-0" placeholder="Email" required>

                            </div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="fas fa-key fa-lg "></i>
                                    </span>
                                </div>

                                <input type="password" name="password" id="rpassword" class="form-control rounded-0" minlength="5" placeholder="輸入密碼" required autocomplete="off">

                            </div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="fas fa-key fa-lg "></i>
                                    </span>
                                </div>

                                <input type="password" name="cpassword" id="cpassword" class="form-control rounded-0" minlength="5" placeholder="確認密碼" required autocomplete="off">

                            </div>
                            <div class="form-group">
                                <div id="passError" class="text-danger font-weight-bold"></div>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="註冊" id="register-btn" class="btn btn-primary btn-lg btn-block myBtn">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- 註冊頁面結束 -->
        <!-- 忘記密碼開始 -->
        <div class="row justify-content-center wrapper" id="forgot-box" style="display: none;">
            <div class="col-lg-10 my-auto">
                <div class="card-group myShadow">
                    <div class="card justify-content-center rounded-left myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">回登入頁面</h1>
                        <hr class="my-3 bg-light myHr">

                        <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="back-link">Back</button>
                    </div>
                    <div class="card rounded-right p-4" style="flex-grow: 1.4;">
                        <h1 class="text-center font-weight-bold text-primary">忘記密碼</h1>
                        <hr class="my-3">
                        <p class="lead text-center text-secondary">為了重置密碼，請輸入email</p>
                        <form action="#" method="post" class="px-3" id="forgot-form">
                        <div id="forgotAlert"></div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="far fa-envelope fa-lg"></i>
                                    </span>
                                </div>

                                <input type="email" name="email" id="femail" class="form-control rounded-0" placeholder="Email" required>

                            </div>


                            <div class="form-group">
                                <input type="submit" value="重置密碼" id="forgot-btn" class="btn btn-primary btn-lg btn-block myBtn">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- 忘記密碼結束 -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js" integrity="sha512-iceXjjbmB2rwoX93Ka6HAHP+B76IY1z0o3h+N1PeDtRSsyeetU3/0QKJqGyPJcX63zysNehggFwMC/bi7dvMig==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <script type="text/javascript">
        $(document).ready(function() {
            // ======================================
            // 註冊頁面
            $("#register-link").click(function() {
                $("#login-box").hide();
                $("#register-box").show();

            });
            // 登入頁面
            $("#login-link").click(function() {
                $("#login-box").show();
                $("#register-box").hide();

            });
            // 密碼頁面
            $("#forgot-link").click(function() {
                $("#login-box").hide();
                $("#forgot-box").show();
            });
            // 回登入頁面
            $("#back-link").click(function() {
                $("#login-box").show();
                $("#forgot-box").hide();
            });
            // ===================================================
            // 註冊頁面驗證
            $("#register-btn").click(function(e) {
                // 表單驗證
                if ($("#register-form")[0].checkValidity()) {
                    // 取消按鈕送出觸發
                    e.preventDefault();
                    $("#register-btn").val('請稍等...');
                    // 驗證密碼是否相符
                    if ($("#rpassword").val() != $("#cpassword").val()) {
                        $("#passError").text('* 密碼必須相符');
                        $("#register-btn").val('註冊');
                    } else {
                        $("#passError").text('');
                        // 表單送出
                        $.ajax({
                            url: 'assets/php/action.php',
                            method: 'post',
                            data: $("#register-form").serialize() + '&action=register',
                            success: function(response) {
                                if (response === 'register') {
                                    window.location = 'home.php';
                                } else {
                                    $("#regAlert").html(response);
                                }
                            }
                        });
                    }
                }
            });
            // ========================================================
            // 登入Ajax Request
            $("#login-btn").click(function(e) {
                if ($("#login-form")[0].checkValidity()) {
                    e.preventDefault();
                    $("#login-btn").val('請稍等...');
                    $.ajax({
                        url: 'assets/php/action.php',
                        method: 'post',
                        data: $("#login-form").serialize() + '&action=login',
                        success: function(response) {
                            console.log(response);
                            $("#login-btn").val('登入')
                            if (response === 'login') {
                                window.location = 'home.php';
                            } else {
                                $("#loginAlert").html(response);
                            }
                        }
                    });
                }
            });
            // ==================================================
            // 忘記密碼Ajax
            $("#forgot-btn").click(function(e){
                if ($("#forgot-form")[0].checkValidity()) {
                    e.preventDefault();
                    $("#forgot-btn").val('請稍等...');

                    $.ajax({
                        url: 'assets/php/action.php',
                        method: 'post',
                        data: $("#forgot-form").serialize()+'&action=forgot',
                        success:function(response){
                            $("#forgot-btn").val('Reset Password');
                            // 清空email
                            $("#femail").val("");
                           console.log(response);
                            $("#forgotAlert").html(response);
                        }
                    });
                    
                }
            });
        });
    </script>
</body>

</html>