<?php
session_start();
require("db.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $email=$_POST['email'];
    $password=md5($_POST['pass']);
$check="select email from users where email='$email'";
$response=$db->query($check);
if($response->num_rows!=0)
{
    $user_check="select * from users where email='$email' and password='$password'";
    $res=$db->query($user_check);
    if($res->num_rows !=0){

        $check_status= "select * from users where email='$email' and password = '$password' and status='active'";

        $status = $db->query($check_status);

        if($status->num_rows !=0)
        {
                echo "success";
                $_SESSION['user']=$email;
        }

        else{

            echo "pending";
        }
    }

    else{
        echo "wrong password";
    }
}

else{
    echo "user not found";
}


}
else{
    echo "unauthorized request";
}
?>