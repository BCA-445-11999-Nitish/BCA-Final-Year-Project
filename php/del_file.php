<?php
session_start();
$user_email=$_SESSION['user'];
require("db.php");
$id= $_POST['id'];
$folder = $_POST['folder'];
$file = $_POST['file'];

$del= unlink("../data/".$folder."/".$file);
if($del)
    {
       $del_sql= $db->query("delete from $folder where id ='$id'");
       if($del_sql)
        {
              $fs_sql="select sum(file_size) as uds from $folder";
                $response=$db->query($fs_sql);
                $aa = $response->fetch_assoc();
               $total_used_file_size= $aa['uds'];

               $update="update users
                         set used_storage = '$total_used_file_size' where email='$user_email'";

                         if($db->query($update))
                         {
                         echo json_encode(array("msg"=>"File Deleted Successfully","used_storage"=>
                         $total_used_file_size));
                         }
                         else
                        {   
                                echo json_encode(array("msg"=>"Storage not updated"));
                                
                         }
        }

        else
            {
                 echo json_encode(array("msg"=>"failed"));
            }
    }
    else
        {
             echo json_encode(array("msg"=>"file not deleted"));
        }


?>