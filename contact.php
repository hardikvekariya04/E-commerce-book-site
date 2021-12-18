<?php
require("header.php");
?>
<div class="container">
<form  method="post" id="submit_form">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom01">Name:</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustomUsername">Email:</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend">@</span>
        </div>
        <input type="text" class="form-control" id="email" name="email" placeholder="email"  required>
        <div class="invalid-feedback">
          Please choose a username.
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustom02">Mobile:</label>
      <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Last name"  required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom03">Message</label>
      <textarea type="text" class="form-control" id="comment" name="comment" placeholder="Comment" required></textarea>
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>
  <button class="btn btn-primary" id="submit" name="submit"  type="submit">Submit form</button>
</form>
<div id="response"></div>  
</div>


<script type="text/javascript" src="js/jquery.js"></script>
<script>
  $(document).ready(function(){
    $("#submit").click(function(){
      var name = $("#name").val();
      var email = $("#email").val();
      var mobile = $("#mobile").val();
      var comment = $("#comment").val();

      if(name == "" || email == "" ||mobile==""||comment==""){
        $('#response').fadeIn();
        $('#response').removeClass('success-msg').addClass('error-msg').html('All fields are required.');
      }else{
       // $('#response').html($('#submit_form').serialize());
        $.ajax({
          url: "send_message.php",
          type: "POST",
          data : $('#submit_form').serialize(),
          beforesend: function(){
            $('#response').fadeIn();
            $('#response').removeClass('success-msg error-msg').addClass('process-msg').html('Loading response...');
          },
          success: function(data){
            $('#submit_form').trigger("reset");
            $('#response').fadeIn();
            $('#response').removeClass('error-msg').addClass('success-msg').html(data);
            setTimeout(function(){
              $('#response').fadeOut("slow");
            },4000);
          }
        });
      }
    });
  });
</script>
<?php
require("footer.php");
?>