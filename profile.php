<?php 
session_start();
if(empty($_SESSION['user']))
{
    header("Location:login.php");
}
require("php/db.php");
$user_email=$_SESSION['user'];
$user_sql="select * from users where email='$user_email'";
$user_res=$db->query($user_sql);
$user_data=$user_res->fetch_assoc();
$user_name=$user_data['full_name'];
$total_storage=$user_data['storage'];
$used_storage=round($user_data['used_storage'],2);
//$per=round(($used_storage*100)/$total_storage,2);
$total_storage = $user_data['storage'];
$used_storage = round($user_data['used_storage'],2);
$plan=$user_data['plans'];

if($total_storage > 0){
    $per = round(($used_storage*100)/$total_storage,2);
} else {
    $per = 0; // avoid division by zero
}
$user_id=$user_data['id'];
$total_storage=$user_data['storage'];
$tf="user_".$user_id;
$free_storage = $total_storage-$used_storage;
$p_status=" ";

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Signup Page</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" />
  <style><style>
/* Overall Layout */
body {
  background: #4a00e0;
  font-family: 'Poppins', sans-serif;
  color: #333;
  margin: 0;
  padding: 0;
}

/* Sidebar */
.left {
  width: 20%; /* increased width */
  min-height: 100vh;
  background: linear-gradient(135deg, #4a00e0, #8e2de2);
  color: #fff;
  box-shadow: 2px 0 10px rgba(0,0,0,0.1);
  padding: 20px 10px;
}

.profile_pic {
  width: 110px;
  height: 110px;
  border-radius: 50%;
  border: 4px solid #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 15px;
}

.line {
  background-color: rgba(255,255,255,0.3);
  height: 1px;
  border: none;
  margin: 15px 0;
}

.my_menu {
  list-style: none;
  padding: 0;
  margin: 0;
}
.my_menu li {
  padding: 12px 15px;
  border-radius: 8px;
  margin-bottom: 8px;
  transition: 0.3s;
}
.my_menu li:hover {
  background: #fff;
  color: #4a00e0;
  cursor: pointer;
}

/* Storage Progress */
.storage {
  background: rgba(255,255,255,0.2);
  border-radius: 8px;
  height: 10px;
}
.pb {
  border-radius: 8px;
  background: linear-gradient(90deg, #00c6ff, #0072ff); /* cyan gradient for clarity */
}

/* Buttons */
.upload, .btn-light {
  border-radius: 25px;
  font-weight: 600;
  transition: 0.3s;
}
.upload:hover, .btn-light:hover {
  background: #8e2de2;
  color: #fff;
}

/* Right Content */
.right {
  width: 80%;
  background: linear-gradient(135deg, #f9f9f9, #eef1f6); /* subtle gradient instead of plain white */
  overflow: auto;
}

/* Navbar */
.navbar {
  background: #fff !important;
  border-bottom: 1px solid #e0e0e0;
  box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}
.navbar .form-control {
  border-radius: 25px;
  border: 1px solid #666;
}
.navbar .btn-outline-primary {
  border-radius: 25px;
  font-weight: 600;
}

/* Content Area */
.content {
  padding: 30px;
 
 background-image: url(images/cloud_im.png);
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  min-height: 80vh;
}

/* File Cards */
.file-card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  padding: 15px;
  text-align: center;
  transition: 0.3s;
}
.file-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 16px rgba(0,0,0,0.1);
}
.file-card img {
  max-height: 120px;
  border-radius: 8px;
  margin-bottom: 10px;
}
.file-card h6 {
  font-weight: 600;
  font-size: 0.95rem;
  margin-bottom: 10px;
}
.file-card .actions i {
  margin: 0 8px;
  cursor: pointer;
  color: #666;
  transition: 0.3s;
}
.file-card .actions i:hover {
  color: #8e2de2;
}
</style>
  

  <style>
    .main-container{
        width: 100%;
        height: 100vh;
    }
    .left{
        width: 17%;
        height: 100%;
        background-color: #080429;

    }
    .right{
        width: 83%;
        height: 100%;
        overflow: auto;
     
    }
    .profile_pic{
        width: 100px;
        height: 100px;
        border-radius: 100%;
        border: 4px solid white;
    }
    .line{
        background-color: gray;
        width: 100%;
    }
    .storage{
        width: 80%;
    }

    .thumb{
        width: 75px;
        height: 75px;
    }
    .my_menu{
        list-style: none;
        padding: 0;
        margin: 0;
        width: 100%;
        

    }
    .my_menu li:hover{
        background-color: white;
        color: #080429;
        cursor: pointer;

    }

    .my_menu li{
        width: 100%;
        padding: 10px;
        color: #fff;
    }
    .msg{
        width: 100%;
        height: 100vh;
        background-color: rgba(0,0,0,0,7);
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index=1000000;
    }
  </style>
</head>
<body>

    <div class="main-container d-flex">
        <div class="left">
            <div class="d-flex justify-content-center align-items-center flex-column p-5">
                <div class="profile_pic d-flex justify-content-center align-items-center">
                    <i class="fa fa-user fs-1 text-white"></i>
                </div>
                <span class="text-white fs-4"><?php echo $user_name?></span>
                <hr class="line">
                <button class="btn btn-light rounded-pill upload"> <i class="fa fa-upload"></i>Upload File</button>
                   
                <div class="progress storage mt-3 d-none u_pro">
                    <div class="progress-bar bg-primary upload_p" style="width:0%"></div>
                </div>

                <div class="upload_msg"></div>

                <hr class="line">
                <ul class = "my_menu">
                    <li class="menu" p_link="my_files"><i class="far fa-folder-open"></i> My Files</li>
                    <li class="menu" p_link="f_files"><i class="fas fa-star"></i> Favourite Files</li>
                    <li class="menu" p_link="buy_storage"><i class="fas fa-shopping-cart"></i> Buy storage</li>
                </ul>
                <hr class="line">
                <span class="text-white"><i class="fas fa-database"></i> USED STORAGE</span>
                <div class="progress storage">
                    <div class="progress-bar bg-primary pb" style="width:<?php echo $per ?>%"></div>

                </div>
                <span class="text-white"><span class="us"><?php echo $used_storage?></span>MB / <?php echo $total_storage?>MB</span>
                <a href="php/logout.php" class="btn btn-light mt-3">Log out</a>
            </div>
        </div>

        <div class="right">
            <nav class="navbar navbar-light bg-light p-3 shadow-sm sticky-top">
        <div class="container-fluid">
            
            <form class="d-flex ms-auto search_frm">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search">
            <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
        </div>
        </nav>
        
            <div class="content p-4">
                
            </div>
    </div>
    </div>

    <div class="msg d-none"></div>
    <?php
    if($plan != "free")
    {
    $ed =$user_data['expiry_date'];
    $cd =date('Y-m-d');

    if($ed<$cd)
        {
                $p_status="deactivate";
                echo "<style>.upload,[p_link='my_files'],[p_link='f_files']{pointer-events:none;}</style>";
        }
        else 
            {
                $p_status = "activate";
            }
    }
    ?>

       <script>
$(document).ready(function () {
    $(".upload").click(function () {
        var input = document.createElement("INPUT");
        input.setAttribute("type", "file");
        input.click();

        input.onchange = function () {

            $(".u_pro").removeClass("d-none");

            var file = new FormData();
            file.append("data", input.files[0]);

            // Fixed size calculation
            var file_Size = Math.floor(input.files[0].size / 1024 / 1024);

            // FIXED: echo PHP value correctly
            var free_storage = <?php echo $free_storage; ?>;

            // FIXED: wrong variable name
            if (file_Size < free_storage) {

                $.ajax({
                    type: "POST",
                    url: "php/upload.php",
                    data: file,
                    processData: false,
                    contentType: false,
                    cache: false,

                    xhr: function () {
                        var request = new window.XMLHttpRequest();
                        request.upload.onprogress = function (e) {
                            var loaded = (e.loaded / 1024 / 1024).toFixed(2);
                            var total = (e.total / 1024 / 1024).toFixed(2);
                            var upload_per = ((loaded * 100) / total).toFixed(0);

                            $(".upload_p").css("width", upload_per + "%");
                            $(".upload_p").html(upload_per + "%");
                        };
                        return request;
                    },

                    success: function (response) {
                        var obj = JSON.parse(response);
                        $(".u_pro").addClass("d-none");

                        var new_per = (obj.used_storage * 100) / <?php echo $total_storage ?>;
                        $(".us").html(obj.used_storage);
                        $(".pb").css("width", new_per + "%");

                        var div = document.createElement("DIV");
                        div.className = "alert mt-3 " + (obj.msg == "File Upload Successfully" ? "alert-success" : "alert-danger");
                        div.innerHTML = obj.msg;
                        $(".upload_msg").append(div);
                        my_files();

                        setTimeout(function () {
                            $(".upload_msg").html("");
                            $(".upload_p").css("width", "0%");
                            $(".upload_p").html("");
                        }, 3000);
                    }
                });

            } else {
                var div = document.createElement("DIV");
                div.className = "alert alert-danger mt-3";
                div.innerHTML = "File size too large. Kindly purchase more storage.";

                $(".upload_msg").append(div);

                setTimeout(function () {
                    $(".upload_msg").html("");
                    $(".upload_p").css("width", "0%");
                    $(".u_pro").addClass("d-none");
                }, 3000);
            }
        };
    });

    $(".menu").each(function() {
        $(this).click(function() {
            var page_link = $(this).attr("p_link");
            $.ajax({
                type:"POST",
                url:"php/pages/"+page_link+".php",
                beforeSend:function(){
                    var div = document.createElement("DIV");
                    $(div).addClass("alert alert-success fs-1 text-center p-5");
                    $(div).html("<i class='fas fa-spinner fa-spin fs-1'></i><br>Loading....");
                    $(".msg").html(div);
                    $(".msg").removeClass("d-none");

                },
                success:function(response){
                    $(".msg").addClass("d-none");
                    $(".content").html(response);
                }
            })
            
            
        })
        
    })
    function my_files()
    {if("<?php echo $plan;?>" !="free"){
    if("<?php echo $p_status;?>"=="activate")
    {
        $("[p_link='my_files']").click();
    }
    else{
        $("[p_link='buy_storage']").click();
    }
         

    }
    else{
        $("[p_link='my_files']").click();
    }
}

    my_files();
    $(".search_frm").submit(function(e){
        e.preventDefault();
        var query =$('#search').val();
       
            $.ajax({
                type:"POST",
                url:"php/pages/search.php",
                data:{
                    query:query
                },
                beforeSend:function(){
                    var div = document.createElement("DIV");
                    $(div).addClass("alert alert-success fs-1 text-center p-5");
                    $(div).html("<i class='fas fa-spinner fa-spin fs-1'></i><br>Loading....");
                    $(".msg").html(div);
                    $(".msg").removeClass("d-none");

                },
                success:function(response){
                    $(".msg").addClass("d-none");
                    $(".content").html(response);
                }
            })
    })
   
});
</script>

</body>
</html>