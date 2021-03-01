<?php include('connect.php')?>

<?php
    
    $email="lahirusampath3366@gmail.com";
           // lahirusampath3366@gmail.com

        function isEmail($connect,$email){
    
            $email_check="SELECT email FROM `user` WHERE email='{$email}' LIMIT 1";
            $result_query=mysqli_query($connect,$email_check);
            
            if($result_query){
                if(mysqli_num_rows($result_query)==1){
                    // echo "user already registrd";

                    return 1;
                }else{
                    return 0;
                    //echo "user already not registrd";
                }
            }
        }

    echo isEmail($connect,$email);
?>