<?php session_start();
       // sleep(1);
        include('connect.php');
?>

<?php

$error_msg='';

    if(isset($_POST['submit'])){
        
        $first_name=mysqli_real_escape_string($connect,$_POST['first_name']);
        $last_name=mysqli_real_escape_string($connect,$_POST['last_name']);
        $number=mysqli_real_escape_string($connect,$_POST['number']);
        $nic=mysqli_real_escape_string($connect,$_POST['nic']);
        $u_name=mysqli_real_escape_string($connect,$_POST['u_name']);
        $acc_no=mysqli_real_escape_string($connect,$_POST['acc_no']);
        $email=mysqli_real_escape_string($connect, $_POST['email1']);
        $email2=mysqli_real_escape_string($connect, $_POST['email2']);
        $img_dir="../upload/";
        $img="user.png";
        
        $user_pwd=rand(10000,100000);
        
                function isEmail($connect,$email){

                    $email_check="SELECT * FROM `user` WHERE email='{$email}' LIMIT 1";
                    $result_query=mysqli_query($connect,$email_check);
                    if($result_query){
                        if(mysqli_num_rows($result_query)==""){
                            return true;
                        }else{
                             return false;
                        }
                    }
                }
            
                function isUname($connect,$u_name){
                    $uname_query="SELECT * FROM `user` WHERE user_name='{$u_name}' LIMIT 1";
                    $uname_query_result=mysqli_query($connect,$uname_query);
                    if($uname_query_result){
                        if(mysqli_num_rows( $uname_query_result)==""){
                            return true;
                        }else{
                             return false;
                        }
                    }
                }
        
        $query="INSERT INTO `user`(first_name,last_name,user_name,password,email,NIC,phone_number,path,img)
        VALUES ('{$first_name}','{$last_name}','{$u_name}','{$user_pwd}','{$email}','{$nic}','{$number}','{$img_dir}','{$img}')";
        
        if($email==$email2){
            if((isEmail($connect,$email))&&(isUname($connect,$u_name))){
                $result=mysqli_query($connect,$query);
                
                $get_id_query="SELECT id FROM `user` WHERE user_name='{$u_name}' LIMIT 1";//get user id
                $get_id_query_result=mysqli_query($connect,$get_id_query);
                if($get_id_query_result){
                    $recode=mysqli_fetch_assoc($get_id_query_result);
                    $reg_user_id=$recode['id'];
                    
                    $account_tab="INSERT INTO `account` (account_number,user_id)
                    VALUES ('{$acc_no}','{$reg_user_id}')";
                    
                    $acc_result=mysqli_query($connect,$account_tab);
                
                if(($result)&&($acc_result)){

                    require '../email/PHPMailerAutoload.php';
                    $credential = include('../email/credential.php');   //credentials import
                    $mail = new PHPMailer;
                    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = $credential['user'];           // SMTP username
                    $mail->Password = $credential['pass'];             // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to
                    $mail->setFrom($email);
                    $mail->addAddress($email);             // Name is optional
                    $mail->addReplyTo('hello');
                    //$mail->addCC('cc@example.com');
                    //$mail->addBCC('bcc@example.com');
                    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $send2="";
                    $user_name="user Name is : ".$u_name;
                    $pwd="Your E-banking password is : ".$user_pwd;
                    $mail->Subject = "Password";
                    $mail->Body    = "$pwd<br><br>$user_name<br><br>$send2";
                    $mail->AltBody = 'If you see this mail. please reload the page.';

                    if(!$mail->send()) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        $error_msg="user password send to <br>".$email;
                    }
                }else{
                    echo " error";
                }
               }
            }else{
                 $error_msg="user already registrd";
            }
        }else{
             $error_msg="Email Address Not Match";
        }
    }

?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <style>
             body{
                background-attachment: fixed;
                background-size: 100% 100%;
                background-image: linear-gradient(to right, rgba(255, 255, 255, 255)25%, rgba(0, 0, 0, 0.4)),url("../img/online-banking-3559760.jpg");
                overflow-x: hidden;
            }
            
            .form-table{
                border-collapse: separate;
                border-spacing: 35px;
                position: relative;
                top: 50px;
                left: -100px;
            }
            
            .form-table input[type="text"],[type="email"]{
                background-color: rgba(0,0,0,0);
                color:black;
                border: none;
                outline: none;
                border-bottom: 1px solid green;
            }
            .form-table input[type="submit"],[type="reset"]{
                width:100%;
            }
            
            .btn:hover{
                background-color: green;
                transform: scale(1.05);
                transition: 1s;
                color: wheat;
            }
        </style>
    </head>
    
    <body>
        <div class="row">
            <div class="col-md-12">
                <div>
                    <form method="post" action="add_user.php">
                        <center>
                            <h1>Add New User</h1>
                            <table class="form-table">
                                <tr>
                                    <td>
                                        First Name  
                                    </td>
                                    <td>
                                        :<input type="text" name="first_name" required>
                                    </td>
                                    <td>
                                       Last Name  
                                    </td>
                                    <td>
                                        :<input type="text" name="last_name" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       NIC 
                                    </td>
                                    <td>
                                        :<input type="text" name="nic" required>
                                    </td>
                                    <td>
                                       Contact Number 
                                    </td>
                                    <td>
                                        :<input type="text" name="number" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        User Name
                                    </td>
                                    <td>
                                        :<input type="text" name="u_name" required>
                                    </td>
                                     <td>
                                        Account Number
                                    </td>
                                    <td>
                                        :<input type="text" name="acc_no" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Email
                                    </td>
                                    <td>
                                        :<input type="email" name="email1" required>
                                    </td>
                                     <td>
                                        Confirm Email
                                    </td>
                                    <td>
                                        :<input type="email" name="email2" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                     <td>
                                    </td>
                                    <td style="color:red;">
                                        <?php
                                            echo $error_msg;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                     <td>
                                         <input type="reset" class="btn">
                                    </td>
                                    <td>
                                        <input type="submit" class="btn" value="Register User" name="submit">
                                    </td>
                                </tr>
                            </table>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>