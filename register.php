<?php
require("header.php");
?>
<div class="container" style="position: relative;left:260px;top:-11px;margin-bottom: -70px;">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
           
            <!-- Form -->
            <form id="submit_register_form" class="submit_form"  method="POST" autocomplete="off" style="height:505px;width:610px;">
                <h2>register here</h2>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control first_name" placeholder="Enter name" requried>
                </div>
                <div class="form-group" >
                    <p class="email11">Email</p>
                    <input type="email" name="email" id="email" class="form-control email" placeholder="Email Address" requried style="width:58%;position:relative;left:70px;">
                    <button type="button"  class="btn" id="email_sent_otp1" onclick="email_sent_otp()"  style="width:90px;height:35px;font-size:12px;border-radius:10px;position:relative;left:70px;">Send OTP</button><br>
                     
                    <input type="text" id="form_control2" class="email_verify_otp1" placeholder="OTP" requried style="width:58%;margin-left:140px;">
                    <input type="button"  class="email_verify_otp1" id="otp_button1" onclick="email_verify_otp()" style="width:80px;font-size:12px;border-radius:10px;" value="Verify OTP">
                    <span class="error_msg_email"></span> 
                </div>
                <span id="email_otp_result"></span>  
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="phone" name="mobile" id="mobile" class="form-control mobile" placeholder="Mobile" requried >
                    <!--<button type="button"  class="btn" id="mobile_sent_otp1" onclick="mobile_sent_otp()"  style="width:90px;height:35px;font-size:12px;border-radius:10px;position:relative;left:70px;">Send OTP</button><br>
                     
                    <input type="text" id="form_control3" class="mobile_verify_otp1" placeholder="OTP" requried style="width:58%;margin-left:140px;">
                    <input type="button"  class="mobile_verify_otp1" id="otp_button2" onclick="mobile_verify_otp()" style="width:80px;font-size:12px;border-radius:10px;" value="Verify OTP">
                    <span class="error_msg_mobile"></span>-->
                </div>
                
                <span id="mobile_otp_result"></span>  
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id = "password" class="form-control pass_word" placeholder="Password" requried>
                </div>
                <input type="button" id="submit" name="submit" class="btn" value="submit">
                <div id="response"></div>
            </form>
            <!-- /Form -->
            
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script>
  $(document).ready(function(){
    $("#submit").click(function(){
      var name = $("#name").val();
      var email = $("#email").val();
      var mobile = $("#mobile").val();
      var password = $("#password").val();

      if(name == "" || email == "" || mobile == "" || password ==""){
        $('#response').fadeIn();
        $('#response').removeClass('success-msg').addClass('error-msg').html('All fields are required.');
      }else{
       // $('#response').html($('#submit_form').serialize());
        $.ajax({
          url: "register_submit.php",
          type: "POST",
          data : $('#submit_register_form').serialize(),
          beforesend: function(){
            $('#response').fadeIn();
            $('#response').removeClass('success-msg error-msg').addClass('process-msg').html('Loading response...');
          },
          success: function(data){
            $('#submit_register_form').trigger("reset");
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
<script type="text/javascript" src="js/jquery.js"></script>
<script>
    function email_sent_otp(){
      jQuery('.error_msg_email').html('');
    var email=jQuery('#email').val();
    if(email==''){
      jQuery('.error_msg_email').html('* Please enter valid email id');
    }else{
      jQuery('#email_sent_otp1').html('Please wait..');
      jQuery('#email').attr('disabled',true);
      jQuery('#email_sent_otp1');
      jQuery.ajax({
        url:'send_otp.php',
        type:'post',
        data:'email='+email+'&type=email',
        success:function(result){
          if(result=='done'){
            jQuery('#email').attr('disabled',true).css("width","75%");
            jQuery('.email_verify_otp1').show();
            jQuery('#email_sent_otp1').hide();
          }else{
            jQuery('#email_sent_otp1').html('Send OTP');
            jQuery('.error_msg_email').html('* Please try after sometimes');
            jQuery('#email').attr('disabled',false).css("width","75%");
          }
        }
      });
    }
  }
  function email_verify_otp(){
    jQuery('.error_msg_email').html('');
    var form_control2=jQuery('#form_control2').val();
    if(form_control2==''){
      jQuery('.error_msg_email').html('* Please enter valid OTP');
    }else{
      jQuery.ajax({
        url:'check_otp.php',
        type:'post',
        data:'otp='+form_control2+'&type=email',
        success:function(result){
          if(result=='done'){
            jQuery('.email_verify_otp1').hide();
            jQuery('#email_otp_result').html('Email id Verified');
          }else{
            jQuery('.error_msg_email').html('* Please enter valid OTP');
          }
        }
      });
    
    }
  } 
</script>