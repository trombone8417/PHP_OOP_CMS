<?php
require_once 'assets/php/admin-header.php';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card my-2 border-success">
            <div class="card-header bg-success text-white">
                <h4 class="m-0">Total Regsitered Users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllUsers">
                    <p class="text-center align-self-center lead">
                        Please Wait ...
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
$(document).ready(function(){
    // 呼叫函數(列出使用者)
    fetchAllUsers();
    // 列出使用者
    function fetchAllUsers(){
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: {action: 'fetchAllUsers'},
            success:function(response){
                $("#showAllUsers").html(response);
                // 顯示DataTable
                $("table").DataTable({
                    order: [0, 'desc']                
                });
            }
        });
    }
    $("body").on("click", ".userDetailsIcon", function(e){
        e.preventDefault();
        details_id = $(this).attr('id');
        $.ajax({
            url: 'assets/php/admin-action.php',
            type:'post',
            data:{details_id: details_id},
            success:function(response){
                data = JSON.parse(response);
                $("#getName").text(data.name+ ' ' +'(ID:'+data.id+')');
                $("#getEmail").text('Email : '+ data.email);
                $("#getPhone").text('Phone : ' + data.phone);
                $("#getGender").text('Gender : ' + data.gender);
                $("#getDob").text('DOB : '+ data.dob);
                $("#getCreated").text('Joined On '+data.created_at);
                $("#getVerified").text('Verified : '+data.verified);
                if (data.photo != '') {
                    $("#getImage").html('<img src="../assets/php/'+data.photo+'" alt="" class="img-thumbnail img-fluid align-self-center" width="280px">');                    
                }else{
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
    checkNotification()
function checkNotification(){
    $.ajax({
        url:'assets/php/admin-action.php',
        method: 'post',
        data:{action: 'checkNotification'},
        success:function(response){
            $("#checkNotification").html(response);
        }
    });
}
});
</script>
</body>

</html>