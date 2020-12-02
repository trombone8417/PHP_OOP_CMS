<?php
require_once 'assets/php/header.php';
?>

<div class="container">
    <div class="row justify-content-center my-2">
        <div class="col-lg-6 mt-4" id="showAllNotification">
            
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js" integrity="sha512-iceXjjbmB2rwoX93Ka6HAHP+B76IY1z0o3h+N1PeDtRSsyeetU3/0QKJqGyPJcX63zysNehggFwMC/bi7dvMig==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<script type="text/javascript">
    $(document).ready(function() {
        // call function 列出訊息
        fetchNotification();
        // 列出訊息
        function fetchNotification() {
            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: {
                    action: 'fetchNotification'
                },
                success: function(response) {
                    $("#showAllNotification").html(response);
                }
            });
        }
        checkNotification()
        function checkNotification(){
            $.ajax({
                url:'assets/php/process.php',
                method:'post',
                data: { action: 'checkNotification'},
                success:function(response){
                    $("#checkNotification").html(response);
                }
            });
        }
        // 刪除訊息
        $("body").on("click", ".close", function(e){
            e.preventDefault();
            // 點選關閉按鈕id
            notification_id = $(this).attr('id');
            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: {notification_id: notification_id},
                success:function(response){
                    // 訊息頁通知
                    checkNotification();
                    // 導航列通知
                    fetchNotification();
                }
            });
        });
    });
</script>
</body>

</html>