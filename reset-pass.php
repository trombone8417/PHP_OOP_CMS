<?php
// #07 14:52 
?>
<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>重置密碼</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container">
        <!-- 登入頁面開始 -->
        <div class="row justify-content-center wrapper" >
            <div class="col-lg-10 my-auto">
                <div class="card-group myShadow">
                <div class="card justify-content-center rounded-left myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">重置密碼</h1>
                      
                    </div>
                    <div class="card rounded-right p-4" style="flex-grow: 2;">
                        <h1 class="text-center font-weight-bold text-primary">輸入新密碼</h1>
                        <hr class="my-3">
                        <form action="#" method="post" class="px-3" >
                           
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="fas fa-key fa-lg "></i>
                                    </span>
                                </div>
                                <input type="password" name="pass"  class="form-control rounded-0" minlength="5" placeholder="新密碼" required minlength="5">
                            </div>

                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="fas fa-key fa-lg "></i>
                                    </span>
                                </div>
                                <input type="password" name="cpass"  class="form-control rounded-0" minlength="5" placeholder="確認新密碼" required minlength="5">
                            </div>
                          
                            <div class="form-group">
                                <input type="submit" value="重置密碼" name="submit" id="login-btn" class="btn btn-primary btn-lg btn-block myBtn">
                            </div>
                        </form>
                    </div>
                 
                </div>
            </div>
        </div> 
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
</body>
</html>