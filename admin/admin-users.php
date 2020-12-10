<?php
require_once 'assets/php/admin-header.php';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card my-2 border-success">
            <div class="card-header bg-success text-white">
                <h4 class="m-0">使用者註冊總覽</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllUsers">
                    <p class="text-center align-self-center lead">
                        請稍等 ...
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 顯示使用者詳細資訊Modal -->
<div class="modal fade" id="showUserDetailModal">
    <div class="modal-dialog modal-dialog-centered mw-100 w-50">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="getName">
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-deck">
                    <div class="card border-primary">
                        <div class="card-body">
                            <p id="getEmail"></p>
                            <p id="getPhoto"></p>
                            <p id="getDob"></p>
                            <p id="getGender"></p>
                            <p id="getCreated"></p>
                            <p id="getVerified"></p>
                        </div>
                    </div>
                    <div class="card align-self-center" id="getImage">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        // 呼叫函數(列出使用者)
        fetchAllUsers();
        // 列出使用者
        function fetchAllUsers() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    action: 'fetchAllUsers'
                },
                success: function(response) {
                    // 列出所有使用者
                    $("#showAllUsers").html(response);
                    // 顯示DataTable
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }
        // 點選按鈕，出現詳細資訊
        $("body").on("click", ".userDetailsIcon", function(e) {
            e.preventDefault();
            // 使用者的ID
            details_id = $(this).attr('id');
            $.ajax({
                url: 'assets/php/admin-action.php',
                type: 'post',
                data: {
                    details_id: details_id
                },
                success: function(response) {
                    // JSON字串轉換成JavaScript的數值或是物件
                    data = JSON.parse(response);
                    $("#getName").text(data.name + ' ' + '(ID:' + data.id + ')');
                    $("#getEmail").text('Email : ' + data.email);
                    $("#getPhone").text('電話 : ' + data.phone);
                    $("#getGender").text('性別 : ' + data.gender);
                    $("#getDob").text('生日 : ' + data.dob);
                    $("#getCreated").text('註冊時間 ' + data.created_at);
                    $("#getVerified").text('驗證 : ' + data.verified);
                    // 確認使用者是否上傳圖片
                    if (data.photo != '') {
                        // 有的話，帶入相對路徑
                        $("#getImage").html('<img src="../assets/php/' + data.photo + '" alt="" class="img-thumbnail img-fluid align-self-center" width="280px">');
                    } else {
                        // 沒有的話，帶入預設相對路徑
                        $("#getImage").html('<img src="../assets/img/profile.png" alt="" class="img-thumbnail img-fluid align-self-center" width="280px">');
                    }
                }
            });
        });
        // 刪除使用者                                                              
        $("body").on("click", ".deleteUserIcon", function(e) {
            e.preventDefault();
            del_id = $(this).attr('id');
            Swal.fire({
                title: '確定要刪除嗎?',
                text: "刪除之後資料無法回復!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '刪除!',
                cancelButtonText: '取消'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'assets/php/admin-action.php',
                        method: 'post',
                        data: {
                            del_id: del_id
                        },
                        success: function(response) {
                            Swal.fire(
                                '刪除',
                                '刪除成功',
                                'success'
                            )
                            // 更新Notes
                            fetchAllUsers();
                        }
                    });

                }
            })
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