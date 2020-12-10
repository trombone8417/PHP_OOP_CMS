<?php
require_once 'assets/php/admin-header.php';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card my-2 border-warning">
            <div class="card-header bg-warning text-white">
                <h4 class="m-0">使用者回饋意見總覽</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllFeedback">
                    <p class="text-center align-self-center lead">
                        請稍等 ...
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showReplyModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">意見回饋回覆</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" class="px-3" id="feedback-reply-form">
                    <div class="form-group">
                        <textarea name="message" id="message" class="form-control" rows="6" placeholder="請在這裡填寫訊息..." required></textarea>
                    </div>
                    <div class="form-froup">
                        <input type="submit" name="submit" value="發送訊息" class="btn btn-primary btn-block" id="feedbackReplyBtn">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- footer -->
</div>
</div>
</div>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // 呼叫函數(列出使用者的回饋意見)
        fetchAllFeedback();
        // 列出使用者的回饋意見
        function fetchAllFeedback() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    action: 'fetchAllFeedback'
                },
                success: function(response) {
                    $("#showAllFeedback").html(response);
                    // 顯示DataTable
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }

        var uid;
        var fid;
        $("body").on("click", ".replyFeedbackIcon", function(e) {
            uid = $(this).attr('id');
            fid = $(this).attr('fid');

        });
        $("#feedbackReplyBtn").click(function(e) {
            if ($("#feedback-reply-form")[0].checkValidity()) {
                let message = $("#message").val();
                e.preventDefault();
                $("#feedbackReplyBtn").val('請稍等...');
                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: {
                        uid: uid,
                        message: message,
                        fid: fid
                    },
                    success: function(response) {
                        $("#feedbackReplyBtn").val('Send Reply');
                        $("#showReplyModal").modal('hide');
                        $("#feedback-reply-form")[0].reset();
                        Swal.fire(
                            '送出',
                            'Reply sent successfully to the user!',
                            'success'
                        )
                        fetchAllFeedback();
                    }
                });
            }
        });
        // 呼叫函數
        checkNotification()
        // 通知顯示
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
    });
</script>
</body>

</html>