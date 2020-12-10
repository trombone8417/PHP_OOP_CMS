<?php
require_once 'assets/php/admin-header.php';
?>
<div class="row justify-content-center my-2">
    <div class="col-lg-6 mt-4" id="showNotification">

    </div>
</div>
<!-- footer -->
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        // 呼叫函數
        fetchNotification();
        // 列出訊息
        function fetchNotification() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    action: 'fetchNotification'
                },
                success: function(response) {
                    $("#showNotification").html(response);
                }
            });
        }
        // 呼叫函數
        checkNotification()
        // 訊息通知
        function checkNotification() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    action: 'checkNotification'
                },
                success: function(response) {
                    $("#checkNotification").html(response);
                }
            });
        }
        // 刪除訊息
        $("body").on("click", ".close", function(e) {
            e.preventDefault();
            notification_id = $(this).attr('id');
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    notification_id: notification_id
                },
                success: function(response) {
                    // 列出訊息
                    fetchNotification();
                    // 訊息通知
                    checkNotification();
                }
            });
        });
    });
</script>
</body>

</html>