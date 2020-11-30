<?php
require_once 'assets/php/header.php';
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card rounded-0 mt-3 border-primary">
                <div class="card-header border-primary">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="#profile" class="nav-link active font-weight-bold" data-toggle="tab">Profile</a></li>
                        <li class="nav-item">
                            <a href="#editProfile" class="nav-link  font-weight-bold" data-toggle="tab">Edit Profile</a></li>
                        <li class="nav-item">
                            <a href="#changePass" class="nav-link  font-weight-bold" data-toggle="tab">Change Password</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- 簡歷開始 -->
                        <div class="tab-pane container active" id="profile">
                            <div class="card-deck">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-light text-center lead">
                                        User ID : <?= $cid; ?>
                                    </div>
                                    <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>姓名 : </b><?= $cname; ?></p>
                                    <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Email : </b><?= $cemail; ?></p>
                                    <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>性別 : </b><?= $cgender; ?></p>
                                    <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>生日 : </b><?= $cdob; ?></p>
                                    <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>手機 : </b><?= $cphone; ?></p>
                                    <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>註冊時間 : </b><?= $reg_on; ?></p>
                                    <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>E-Mail 註冊時間 : </b><?= $verified; ?>
                                        <?php if ($verified == 'Not Verified!') : ?>
                                            <a href="#" id="verify-email" class="float-right">Verify Now</a>
                                        <?php endif; ?>
                                    </p>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="card border-primary align-self-center">
                                    <?php if (!$cphoto) : ?>
                                        <img src="assets/img/profile.png" class="img-thumbnail img-fluid" width="480px">
                                    <?php else : ?>
                                        <img src="<?= 'assets/php/' . $cphoto; ?>" class="img-thumbnail img-fluid" width="480px">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- 簡歷結束 -->
                        <!-- 編輯簡歷開始 -->
                        <div class="tab-pane container fade" id="editProfile">
                            <div class="card-deck">
                                <div class="card border-danger align-self-center">
                                    <?php if (!$cphoto) : ?>
                                        <img src="assets/img/profile.png" class="img-thumbnail img-fluid" width="480px">
                                    <?php else : ?>
                                        <img src="<?= 'assets/php/' . $cphoto; ?>" class="img-thumbnail img-fluid" width="480px">
                                    <?php endif; ?>
                                </div>
                                <div class="card border-danger">
                                    <form action="" method="post" class="px-3 mt-2" enctype="multipart/form-data" id="profile-update-form">
                                        <input type="hidden" name="oldimage" value="<?= $cphoto; ?>">
                                        <div class="form-group m-0">
                                            <label for="profilePhoto" class="m-1">上傳照片</label>
                                            <input type="file" name="image" id="profilePhoto">
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="name" class="m-1">姓名</label>
                                            <input type="text" name="name" id="name" class="form-control" value="<?= $cname; ?>">
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="gender" class="m-1">姓別</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="" disabled <?php if ($cgender == null) {
                                                                                echo 'selected';
                                                                            } ?>>Select</option>
                                                <option value="Male" <?php if ($cgender == 'Male') {
                                                                            echo 'selected';
                                                                        } ?>>Male</option>
                                                <option value="Female" <?php if ($cgender == 'Female') {
                                                                            echo 'selected';
                                                                        } ?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="dob" class="m-1">生日</label>
                                            <input type="date" name="dob" id="dob" value="<?= $cdob; ?>" class="form-control">
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="phone" class="m-1">手機</label>
                                            <input type="tel" name="phone" id="phone" value="<?= $cphone; ?>" class="form-control" placeholder="手機號碼">
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="submit" name="profile_update" value="更新履歷" class="btn btn-danger btn-block" id="profileUpdateBtn">
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 編輯簡歷結束 -->
                        <!-- 更新密碼開始 -->
                        <div class="tab-pane container fade" id="changePass">
                            <div id="changepassAlert"></div>
                            <div class="card-deck">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white text-center lead">更換密碼</div>
                                <form action="#" method="post" class="px-3 mt-2" id="change-pass-form">
                                    <div class="form-group">
                                        <label for="curpass">輸入現在的密碼</label>
                                        <input type="password" class="form-control form-control-lg" name="curpass" id="curpass" placeholder="現在的密碼" required minlength="5">
                                    </div>
                                    <div class="form-group">
                                        <label for="newpass">輸入新密碼</label>
                                        <input type="password" class="form-control form-control-lg" name="newpass" id="newpass" placeholder="新密碼" required minlength="5">
                                    </div>
                                    <div class="form-group">
                                        <label for="cnewpass">確認新密碼</label>
                                        <input type="password" class="form-control form-control-lg" name="cnewpass" id="cnewpass" placeholder="確認新密碼" required minlength="5">
                                    </div>
                                    <div class="form-group">
                                        <p id="changepassError" class="text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="changepass" value="Change Password" class="btn btn-success btn-block btn-lg" id="changePassBtn">
                                    </div>

                                </form>
                                
                            </div>
                            <div class="card border-success align-self-center">
                                    <img src="assets/img/changePass.jpg" class="img-thumbnail img-fluid" width="408px">
                                </div>
                            </div>
                        </div>

                        <!-- 更新密碼結束 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js" integrity="sha512-iceXjjbmB2rwoX93Ka6HAHP+B76IY1z0o3h+N1PeDtRSsyeetU3/0QKJqGyPJcX63zysNehggFwMC/bi7dvMig==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<script type="text/javascript">
$(document).ready(function(){
    // 更新履歷Ajax
    $("#profile-update-form").submit(function(e){
        e.preventDefault();
        $.ajax({
            url:'assets/php/process.php',
            method: 'post',
            processData:false,
            contentType:false,
            cache:false,
            data: new FormData(this),
            success:function(response){
                // 刷新頁面
                location.reload();
            }
        });
    });
    $("#changePassBtn").click(function(e){
        if($("#change-pass-form")[0].checkValidity()){
            e.preventDefault();
            $("#changePassBtn").val('Please Wait...');
            if($("#newpass").val() != $("#cnewpass").val()){
                $("#changepassError").text('* 密碼不相符');
                $("#changePassBtn").val('Change Password');
            }
            else{
                $.ajax({
                    url:'assets/php/process.php',
                    method:'post',
                    data: $("#change-pass-form").serialize()+'&action=change_pass',
                    success:function(response){
                        $("#changepassAlert").html(response);
                        $("#changePassBtn").val('Change Password');
                        $("#changepassError").text('');
                        $("#change-pass-form")[0].reset();

                    }
                });
            }
        }
    });
});
</script>

</body>

</html>