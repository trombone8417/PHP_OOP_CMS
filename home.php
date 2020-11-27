<?php
require_once 'assets/php/header.php';
?>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <?php if ($verified == 'Not Verified!') : ?>
        <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
          <button class="close" type="button" data-dismiss="alert">&times;</button>
          <strong>您的Email未驗證，請到Email信箱點選驗證的連結</strong>
        </div>
      <?php endif; ?>
      <h4 class="text-center text-primary mt-2">Write Your Notes Here & Access Anytime Anywhere!</h4>
      <div class="card border-primary">
        <h5 class="card-header bg-primary d-flex justify-content-between">
          <span class="text-light lead align-self-center">All Notes</span>
          <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addNoteModal"><i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add New Note</a>
        </h5>
        <div class="card-body">
          <div class="table-responsive" id="showNote">
          <p class="text-center lead mt-5">Please Wait...</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Start Add New Note Modal -->
<div class="modal fade" id="addNoteModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h4 class="modal-title text-light">Add New Note</h4>
        <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="#" method="post" id="add-note-form" class="px-3">
          <div class="form-group">
            <input type="text" name="title" class="form-control form-control-lg" placeholder="Enter Title" required>
          </div>
          <div class="form-group">
            <textarea name="note" class="form-control form-control-lg" placeholder="Write Your Note Here..."></textarea>
          </div>
          <div class="form-group">
            <input type="submit" name="addNote" id="addNoteBtn" value="Add Note" class="btn btn-success btn-block btn-lg">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Add New Note Modal -->
<!-- Start Edit  Note Modal -->
<div class="modal fade" id="editNoteModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title text-light">Edit Note</h4>
        <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="#" method="post" id="edit-note-form" class="px-3">
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Enter Title" required>
          </div>
          <div class="form-group">
            <textarea name="note" id="note" class="form-control form-control-lg" placeholder="Write Your Note Here..."></textarea>
          </div>
          <div class="form-group">
            <input type="submit" name="editNote" id="editNoteBtn" value="Update Note" class="btn btn-info btn-block btn-lg">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Edit  Note Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js" integrity="sha512-iceXjjbmB2rwoX93Ka6HAHP+B76IY1z0o3h+N1PeDtRSsyeetU3/0QKJqGyPJcX63zysNehggFwMC/bi7dvMig==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>


<script type="text/javascript">
  $(document).ready(function() {

    // =================  Ajax新增Note  ================
    $("#addNoteBtn").click(function(e) {
      // 驗證欄位
      if ($("#add-note-form")[0].checkValidity()) {
        // 取消預設button觸發
        e.preventDefault();
        // button文字改成"請稍等..."
        $("#addNoteBtn").val('請稍等...');
        $.ajax({
          url: 'assets/php/process.php',
          method: 'post',
          // 傳送資料
          data: $("#add-note-form").serialize() + '&action=add_note',
          // 成功接收資料
          success: function(response) {

            $("#addNoteBtn").val('Add Note');
            // 清空表單
            $("#add-note-form")[0].reset();
            // 隱藏表單
            $("#addNoteModal").modal('hide');
            Swal.fire({
              title: 'Note 新增成功',
              type: 'success'
            });
            // 更新Note
            displayAllNotes();
          }
        });
      }

    });

    // ===================  編輯使用者Ajax  ===============
    $("body").on("click", ".editBtn", function(e) {
      e.preventDefault();
      edit_id = $(this).attr('id');
      $.ajax({
        url: 'assets/php/process.php',
        method: 'post',
        data: {
          edit_id: edit_id
        },
        success: function(response) {
          data = JSON.parse(response);
          // 帶出資料
          $("#id").val(data.id);
          $("#title").val(data.title);
          $("#note").val(data.note);
        }
      });
    });
    // ===========  更新Ajax  ===========
    $("#editNoteBtn").click(function(e) {
      if ($("#edit-note-form")[0].checkValidity()) {
        e.preventDefault();

        $.ajax({
          url: 'assets/php/process.php',
          method: 'post',
          data: $("#edit-note-form").serialize() + "&action=update_note",
          success: function(response) {
            Swal.fire({
              title: '更新成功!',
              type: 'success'
            });
            $("#edit-note-form")[0].reset();
            $("#editNoteModal").modal('hide');
            displayAllNotes();
          }
        });
      }
    });

    // ============  刪除Notes  =============
    $("body").on("click", ".deleteBtn", function(e) {
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
            url: 'assets/php/process.php',
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
              displayAllNotes();
            }
          });

        }
      })
    });
    // 列出Note內容
    $("body").on("click", ".infoBtn", function(e){
      e.preventDefault();
      info_id = $(this).attr('id');
      $.ajax({
        url:'assets/php/process.php',
        method: 'post',
        data: { info_id: info_id},
        success:function(response){
          data = JSON.parse(response);
          Swal.fire({
            title:'<strong>Note:ID('+data.id+')</strong>',
            type: 'info',
            html:'<b>Title: </b>'+data.title+'<br><br> <b>Note: </b>'+data.note+'<br><br><b>Written On : </b>'+data.created_at+'<br><br><b>Updated On : </b>'+data.updated_at,
            showCloseButton: true,
          });
        }
      });
    });
    // 一開始列出所有的Notes
    displayAllNotes();
    // ==========  列出所有Note  ==============
    function displayAllNotes() {
      $.ajax({
        url: 'assets/php/process.php',
        method: 'post',
        data: {
          action: 'display_notes'
        },
        success: function(response) {
          // 顯示datatable
          $("#showNote").html(response);
          $("table").DataTable({
            order: [0, 'desc']
          });
        }
      });
    }
    // ===========        =================
  });
</script>
</body>

</html>