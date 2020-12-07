<?php
require_once 'assets/php/admin-header.php';
?>
<div class="row">
<div class="col-lg-12">
        <div class="card my-2 border-secondary">
            <div class="card-header bg-secondary text-white">
                <h4 class="m-0">Total Notes By All Users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllNotes">
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
$(doucument).ready(function(){
// 呼叫函數(列出Notes)
fetchAllNotes();
    // 列出Notes
    function fetchAllNotes(){
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: {action: 'fetchAllNotes'},
            success:function(response){
                $("#showAllNotes").html(response);
                // 顯示DataTable
                $("table").DataTable({
                    order: [0, 'desc']                
                });
            }
        });
    }
});

</script>   
</body>
</html>