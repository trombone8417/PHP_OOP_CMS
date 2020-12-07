<?php
require_once 'assets/php/admin-header.php';
?>
<div class="row">
<div class="col-lg-12">
        <div class="card my-2 border-danger">
            <div class="card-header bg-danger text-white">
                <h4 class="m-0">Total Deleted Users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllDeletedUsers">
                    <p class="text-center align-self-center lead">
                        Please Wait ...
                    </p>
                </div>
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
    // 呼叫函數(列出已刪除使用者)
    fetchAllDeletedUsers();
    // 列出已刪除使用者
    function fetchAllDeletedUsers(){
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: {action: 'fetchAllDeletedUsers'},
            success:function(response){
                $("#showAllDeletedUsers").html(response);
                // 顯示DataTable
                $("table").DataTable({
                    order: [0, 'desc']                
                });
            }
        });
    }
    
// 恢復使用者的帳號  26 8:23                                                            
$("body").on("click", ".restoreUserIcon", function(e) {
      e.preventDefault();
      res_id = $(this).attr('id');
      Swal.fire({
        title: '確定要回復此使用者嗎?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '確定',
        cancelButtonText: '取消'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: {
              res_id: res_id
            },
            success: function(response) {
              Swal.fire(
                '回復',
                '回復成功',
                'success'
              )
              fetchAllDeletedUsers();
            }
          });

        }
      })
    });
});
</script>
</body>
</html>