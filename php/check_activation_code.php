<?php

require("db.php");
if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $email=$_POST['email'];
        $atc=$_POST['atc'];

        $check = "SElect * from users where email='$email' and activation_code='$atc'";
        $response=$db->query($check);
        if($response->num_rows !=0){

        $status_update="update users set status='active' where email='$email'";
        if($db->query($status_update)){

            $get_id= "select id from users where email='$email'";
            $id_response=$db->query($get_id);
           $id_arry= $id_response->fetch_assoc();
           $user_table_name= "user_".$id_arry['id'];

           $create_user_table="create table $user_table_name(id int(11) not null auto_increment, file_name varchar(100), file_size
           varchar(100),star varchar(100) default 'no', date_time DATETIME default current_timestamp, primary key(id))";

           if($db->query($create_user_table))
           {
                if(mkdir("../data/".$user_table_name))
                {
                    echo "active";
                }
                else{
                    echo "folder not created";
                }
           }

           else{
            echo "table not created";
           }
           
        }
            else{
                echo "status not update";
            }

        }
        else{
            echo "Wrong activation code";
        }
}

else{
    echo "unauthorized request";
}
?>