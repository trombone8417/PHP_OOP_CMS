<?php
require_once 'assets/php/header.php';
?>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <?php if($verified == 'Not Verified!'): ?>
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
          <dib class="table-responsive" id="showNote">
            <table class="table table-striped text-center">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Note</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tr>
                <td>1</td>
                <td>Web Design</td>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam</td>
                <td>
                  <a href="#" title="View Details" class="text-success infoBtn">
                    <i class="fas fa-info-circle fa-lg"></i>
                  </a>&nbsp;
                  <a href="#" title="Edit Note" class="text-primary editBtn">
                    <i class="fas fa-edit fa-lg"></i>
                  </a>&nbsp;
                  <a href="#" title="Delete Note" class="text-danger deleteBtn">
                    <i class="fas fa-trash-alt fa-lg"></i>
                  </a>&nbsp;
                </td>
              </tr>
            </table>
          </dib>
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
            <input type="submit" name="addNoteBtn" value="Add Note" class="btn btn-success btn-block btn-lg">
          </div>
          <!-- 09 23:31 -->
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Add New Note Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js" integrity="sha512-iceXjjbmB2rwoX93Ka6HAHP+B76IY1z0o3h+N1PeDtRSsyeetU3/0QKJqGyPJcX63zysNehggFwMC/bi7dvMig==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
</body>
</html>