<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Signup Page</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" />
</head>
<body>
  <body style="background:url('images/logins.png') no-repeat center center fixed; background-size:cover;">
  <?php
  require("element/nav.php");
  ?>

  <div class="container main-con">
    <div class="row">
      <div class="col-md-6"></div>
      <div class="col-md-6 p-5">
        <form class="bg-white rounded p-5 login-form">
          <h1 class="text-center bold">Login Now</h1>
          
          <div class="mb-3 email_con">
            <label for="email" class="form-label">Email Id</label>
            <input type="email" id="email" name="email" class="form-control" required />
            <i class="fa fa-circle-notch fa-spin email_loader d-none"></i>
          </div>
          <div class="mb-3 pass_con">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="pass" class="form-control" required />
            <i class="fa fa-eye pass_icon" style="cursor:pointer;"></i>
          </div>
          
          <div class="text-center">
            <button class="btn btn-primary w-50 login_btn" >Login Now!</button>
          </div>
          <div class="msg"></div>
        </form>

        <form class="bg-white rounded p-5 activation-form d-none" autocomplete="off">
          <h1 class="text-center bold mb-4">Activate Your Account</h1>
          <div class="mb-3">
            <label for="activation_code" class="form-label">Activation Code</label>
            <input type="text" id="activation_code" class="form-control" required />
          </div>
          <div class="text-center">
            <button class="btn btn-primary w-50 activation_btn">Activate Now!</button>
          </div>
          <div class="activation_msg"></div>
        </form>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
       $(".pass_icon").click(function () {
        const type = $("#password").attr("type") === "password" ? "text" : "password";
        $("#password").attr("type", type);
        $(this).css({ color: type === "text" ? "black" : "#ccc" });
      });
        $(".login-form").submit(function(e){

            e.preventDefault();
            $.ajax({
                type:"POST",
                url:"php/user_login.php",
                data:{
                    email:$("#email").val(),
                    pass:$("#password").val()
                },
                beforeSend:function(){
                    $(".login_btn").attr("disabled","disabled");
                    $(".lgoin_btn").html("Please wait...");
                },
                success:function(response){
                      $(".login_btn").removeAttr("disabled","disabled");
                    $(".login_btn").html("Login Now");
                    if(response.trim()=="success")
                    {
                      window.location = "profile.php";
                    }
                    else if(response.trim()=="pending")
                    {
                      $(".login-form").addClass("d-none");
                      $(".activation-form").removeClass("d-none");
                    }
                    else if(response.trim()=="wrong password"){

                      var div =document.createElement("DIV");
                      div.className="alert alert-danger mt-3";
                      div.innerHTML="Wrong Password !";
                      $(".msg").append(div);

                      setTimeout(function() {

                        $(".msg").html("");
                        
                      },3000);
                        
                     

                    }

                    else if(response.trim()=="user not found")
                    {
                      var div =document.createElement("DIV");
                      div.className="alert alert-danger mt-3";
                      div.innerHTML="User Not Registered !";
                      $(".msg").append(div);

                      setTimeout(function() {

                        $(".msg").html("");
                        
                      },3000);

                    }
                }
            })
        })

        //Activation Code Program
        
         $(".activation-form").submit(function (e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "php/check_activation_code.php",
          data: {
            email: $("#email").val(),
            atc: $("#activation_code").val()
          },
          beforeSend: function () {
            $(".activation_btn").html("Checking Activation Code...").attr("disabled", "disabled");
          },
          success: function (response) {
            $(".activation_btn").html("Activate Now!").removeAttr("disabled");
            $(".activation_msg").html("");

            if (response.trim() === "active") {
              $(".activation_msg").html('<div class="alert alert-success mt-3">Account Activated</div>');
              setTimeout(function () {
                window.location = "login.php";
              }, 3000);
            } else {
              $(".activation_msg").html('<div class="alert alert-danger mt-3">' + response + '</div>');
              setTimeout(function () {
                $(".activation_msg").html("");
              }, 3000);
            }
          }
        });
      });
    })
  </script>
</body>
</html>