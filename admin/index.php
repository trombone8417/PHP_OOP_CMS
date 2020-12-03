<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location: admin-dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style type="text/css">
        html,
        body {
            height: 100%;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-lg-5">
                <div class="card border-danger shadow-lg">
                    <div class="card-header bg-danger">
                        <h3 class="m-0 text-white"><i class="fas fa-user-cog">&nbsp;Admin Panel Login</i></h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="px-3" id="admin-login-form">
                            <!-- 錯誤訊息提示 -->
                            <div id="adminLoginAlert"></div>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control form-control-lg rounded-0" placeholder="Username" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg rounded-0" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="admin-login" class="btn btn-danger btn-block btn-lg rounded-0" value="Login" id="adminLoginBtn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js" integrity="sha512-iceXjjbmB2rwoX93Ka6HAHP+B76IY1z0o3h+N1PeDtRSsyeetU3/0QKJqGyPJcX63zysNehggFwMC/bi7dvMig==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <script type="text/javascript">
    $(document).ready(function() {  
        $("#adminLoginBtn").click(function(e){
            e.preventDefault();
            $(this).val('Please Wait...');
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: $("#admin-login-form").serialize()+'&action=adminLogin',
                success:function(response){
                    if (response === 'admin_login') {
                        window.location = 'admin-dashboard.php';
                    }else{
                        $("#adminLoginAlert").html(response);
                    }
                    $("#adminLoginBtn").val('Login');
                }
            });
        });
    });
</script>
</body>

</html>