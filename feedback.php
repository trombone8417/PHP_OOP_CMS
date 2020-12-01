<?php
require_once 'assets/php/header.php';
?>

<div class="container">
<div class="row justify-content-center">
<div class="col-lg-8 mt-3">
<?php if($verified == 'Verified!'): ?>
<div class="card border-primary">
<div class="card-header lead text-center bg-primary text-white">Send Feedback to Admin</div>
<div class="card-body">
<form action="#" method="post" class="px-4" id="feedback-form">
<div class="form-group">
<input type="text" name="subject" placeholder="Write Your Subject" class="form-control-lg form-control rounded-0" required>
</div>
<div class="form-group">
    <textarea name="feedback" class="form-control-lg form-control rounded-0" placeholder="Write Your Feedback Here..." rows="8" required></textarea>
</div>
<div class="form-group">
    <input type="submit" name="feedbackBtn" id="feedbackBtn" value="Send Feedback" class="btn btn-primary btn-block btn-lg rounded-0">
</div>
</form>
</div>
</div>
<?php else: ?>
  <h1 class="text-center text-secondary mt-5">Verify Your Email First to Send Feedback to Admin</h1>  
<?php endif; ?>
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js" integrity="sha512-iceXjjbmB2rwoX93Ka6HAHP+B76IY1z0o3h+N1PeDtRSsyeetU3/0QKJqGyPJcX63zysNehggFwMC/bi7dvMig==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
$(document).ready(function(){
    // Send Feedback to Admin Ajax Request
    $("#feedbackBtn").click(function(e){
        if($("#feedback-form")[0].checkValidity()){
            e.preventDefault();
            $(this).val('Please Wait...');
            $.ajax({
                url:'assets/php/process.php',
                method: 'post',
                data: $("#feedback-form").serialize()+'&action=feedback',
                success:function(response){
                    $("#feedback-form")[0].reset();
                    $("#feedbackBtn").val('Send Feedback');
                    Swal.fire({
                        title:'Feedback Successfully sent to the Admin!',
                        type:'success' 
                    });
                }
            });
        }
    });
});
</script>
</body>
</html>