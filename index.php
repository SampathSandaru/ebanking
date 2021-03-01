<?php session_start();?>
<?php require_once('page/connect.php'); ?>

<?php
$error='';
    if(isset($_POST['submit'])){
        $u_name=mysqli_real_escape_string($connect,$_POST['user_name']);
        $pwd=mysqli_real_escape_string($connect,$_POST['password']);
        
        if(isset($_POST['isAdmin'])){
           
            $query="SELECT * FROM `admin`
                    WHERE user_name='$u_name' AND password='$pwd' AND isActive='1' LIMIT 1";

            $result=mysqli_query($connect,$query);

            if($result){
                if(mysqli_num_rows($result)==1){
                    
                    $admin=mysqli_fetch_assoc($result);
                    $_SESSION['user_id']=$admin['id'];
                    $_SESSION['first_name']=$admin['first_name'];
                    $_SESSION['last_name']=$admin['last_name'];
                    $_SESSION['log_time']=$admin['log_time'];
                    $_SESSION['log_out_time']=$admin['log_out_time'];
                    $_SESSION['password']=$admin['password'];
                    $_SESSION['path']=$admin['img_path'];
                    $_SESSION['img']=$admin['img'];
                    $_SESSION['email']=$admin['email'];
                    $_SESSION['number']=$admin['number'];
                    $_SESSION['NIC']=$admin['NIC'];

                    $time_update="UPDATE `admin` SET log_time=NOW() WHERE id={$_SESSION['user_id']}";
                    $time_update_result=mysqli_query($connect,$time_update);
                    setcookie('email',$u_name,time()+60*60);
                    $_SESSION['email']=$u_name;
                    header("Location:page/admin_page.php?user_id=$_SESSION[user_id]");
                }else{
                    $error="User name or password incorect";
                }
             } 
        }else{
            $query="SELECT * FROM `user`
                    WHERE user_name='$u_name' AND password='$pwd' LIMIT 1";

            $result=mysqli_query($connect,$query);

            if($result){
                if(mysqli_num_rows($result)==1){

                    $admin=mysqli_fetch_assoc($result);
                    $_SESSION['user_id']=$admin['id'];
                    $_SESSION['first_name']=$admin['first_name'];
                    $_SESSION['last_name']=$admin['last_name'];
                    $_SESSION['log_time']=$admin['log_time'];
                    $_SESSION['logout_time']=$admin['logout_time'];
                    $_SESSION['password']=$admin['password'];
                    $_SESSION['path']=$admin['path'];
                    $_SESSION['img']=$admin['img'];
                    $_SESSION['email']=$admin['email'];
                    $_SESSION['number']=$admin['phone_number'];
                    $_SESSION['NIC']=$admin['NIC'];

    
                    header("Location:page/user_page.php?user_id=$_SESSION[user_id]");
                    
                    $time_update="UPDATE `user` SET log_time=NOW() WHERE id={$_SESSION['user_id']}";
                    $time_update_result=mysqli_query($connect,$time_update);
                }else{
                    $error="User name or password incorect";
                }
             } 
        }
        
    }
?>


<?php


    if(isset($_POST['send_email'])){
        
        $email=mysqli_real_escape_string($connect, $_POST['email']);
        $query="SELECT * FROM `user` WHERE email='$email'";
        $result=mysqli_query($connect,$query);
        
        require 'email/PHPMailerAutoload.php';

        if($result){
            if(mysqli_num_rows($result)==1){
                
                $admin=mysqli_fetch_assoc($result);
                $_SESSION['password']=$admin['password'];
                
                $credential = include('email/credential.php');   //credentials import

                $mail = new PHPMailer;

                //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = $credential['user']  ;           // SMTP username
                $mail->Password = $credential['pass']  ;                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                $mail->setFrom($email);
                $mail->addAddress($email);             // Name is optional

                $mail->addReplyTo('hello');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                $mail->addAttachment('a.txt');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                $mail->isHTML(true);                                  // Set email format to HTML
                $send1="";
                $send2="";
                $pwd="Your password is : ".$_SESSION['password'];
                
                $mail->Subject = "Password";
                $mail->Body    = "$pwd<br><br>$send1<br><br>$send2";
                $mail->AltBody = 'If you see this mail. please reload the page.';

                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo "<script>alert('Your password send your Email')</script>";
                }
          }else{
                echo "<script>alert('invalide email')</script>";
            }
        }
    }

?>

<html>
    <head>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/log-page.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shorcut icon" type="image/x-icon" href="img/icon.ico" />

        <style>
            
            .btn{
                background-color: greenyellow;
            }
            
            input[type="password"],input[type="text"]{
                border: none;
                outline: none;
            }
            
            .img_index{
                width: 100%;
                position: relative;
                top: -20px;
            }
            
          
            
            /******poup box***************************************************************/
            .mod {
                display: none; /* Hidden by default */
                position:fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: auto; /* Full height */
                overflow: hidden; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.9);/* Black w/ opacity */
                padding-top: 60px;
            }
            .mod-content {
                
                background-color: #fefefe;
                margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
                border: 1px solid #888;
                width: 50%; /* Could be more or less, depending on screen size */
            }
            .animate {
                -webkit-animation: animatezoom 0.6s;
                animation: animatezoom 0.6s
            }

        @-webkit-keyframes animatezoom {
                from {transform: scale(0)} 
                to {transform: scale(1)}
            }
            
            .imgcontainer {
                text-align: center;
                margin: 24px 0 12px 0;
                position: relative;
            }
            .close {
                position: absolute;
                right:25px;
                top: 0;
                color:black;
                font-size: 35px;
                font-weight: bold;
            }
            .close:hover,.close:focus {
                color: green;
                cursor: pointer;
            }
           
            img.avatar {
                width: 13%;
                height: 60px;
                border-radius: 50%;
            }
            .change_pwd_tb{
                width:50%;
                height: 350px;
                border-collapse: separate;
                border-spacing: 16px;
            }
            .box_tb{
                height: 220px;
                width: 90%;
                padding: 20px;
            }
            
             .box_nav{
                height: 50px;
                width: 100%;
                background-color: brown;
            }
  
        </style>
    </head>
    <body>
       
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar first nav-animation">
                        <a class="navbar-brand" href="#">GREEN BANKING</a>
                    </nav>
                </div>    
            </div>
    
    <div class="row">
     <div class="col-md-8">
        <img src="img/img1.PNG" class="main-animation img_index">
    </div>
        
    <!-- #endregion Jssor Slider End -->
     <div class="col-md-4">    
        <div  class="log-table">
            <form method="post">
                <table>
                    <tr>
                        <td style="color:red;">
                            <?php echo "$error";?>
                        </td>
                    </tr>
                    <tr>
                        <td>USER NAME</td>
                    </tr>
                    <tr>
                        <td>
                           <!--<i class="fa fa-user-circle-o" style="font-size:24px"></i>-->
                            <input type="text"  style="border:none;border-bottom:1px solid green;" name="user_name" required>
                        </td>
                    </tr>
                    <tr>
                        <td>PASSWORD</td>
                    </tr>
                    <tr>
                        <td>
                            <!--<i class="fa fa-lock" style="font-size:24px; "></i>&nbsp;&nbsp;-->
                            <input type="password" style="border:none;border-bottom:1px solid green; display: inline-block;" name="password" required>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" value="admin" name="isAdmin">admin login</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="btn" name="submit" value="Log-in" style="background-color:green;position:relative;left:50px;width:50%">
                        </td>
                    </tr>
                    <tr>
                        <td style="color:red;cursor: pointer;" ><samp onclick="document.getElementById('id02').style.display='block'"> forget Password ?..</samp></td>
                    </tr>
                </table>
            </form>
        </div>
        </div> 
    </div>
      
<!--poup box *************************-->
   
  <div id="id02" class="mod">

    <div class="change_pwd_tb mod-content animate">
        <div class="imgcontainer">
          <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal" id="cancel2">&times;</span>
            <div class="box_nav"></div>
        </div>
          <center>
            <form method="post"> 
            <table class="box_tb cont">
              <tr>
                  <td><input type="email" name="email" placeholder="Your Email" class="form-control"></td>
                  <td><center><input type="submit" name="send_email" value="Send Email" class="btn"></center></td>
              </tr>
              
          </table>
        </form>        
        </center>      
    </div>
      
  </div>       
    </body>
</html>