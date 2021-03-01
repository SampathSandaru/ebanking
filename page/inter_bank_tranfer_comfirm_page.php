<?php  session_start();
        include('connect.php');
?>

<?php
$msg="insufficient balance on account";
$msg1="a";
$update_result=true;
        $s_acc=$_GET['s_acc'];
        $to_acc=$_GET['to_acc'];
        $acc_name=$_GET['acc_name'];
        $amount=$_GET['amount'];
        $email=$_GET['email'];
            if(isset($_POST['submit'])){
                
                $isAmount="SELECT amount FROM `account` WHERE user_id={$_SESSION['user_id']}";
                $isAmount_result=mysqli_query($connect,$isAmount);
                
                $recode=mysqli_fetch_assoc($isAmount_result);
                $bal=($recode['amount'])-$amount;
                if((($recode['amount'])<0)||($bal<0)){
                    $msg="insufficient balance on account";
                    $msg1="fail";
                }else{
                    $msg="Transaction succussful";
                    $msg1="succuss";
                    $amount_update="UPDATE `account` SET amount=amount-$amount WHERE user_id='{$_SESSION['user_id']}'";
                    
                        
                        $sql="SELECT * from `account` where account_number='{$to_acc}' LIMIT 1";
                        $sql_result=mysqli_query($connect,$sql);
                        if($sql_result){
                             if(mysqli_num_rows($sql_result)==1){
                                 $update="UPDATE `account` SET amount=amount+$amount WHERE account_number='{$to_acc}'";
                                 $up_re=mysqli_query($connect,$update);
                                 $update_result=mysqli_query($connect,$amount_update);
                             }else{
                                 $msg="Transaction Not succussful (invalid Account number)";
                                 $msg1="Fial";
                             }
                        }else{
                             echo "<script>alert('errorrr')</script>";
                        }
                    
                }
                $date=date("Y-m-d");
                $payment="INSERT INTO `payment` (account_number,status,amount,date,user_id)  VALUES ('{$to_acc}','{$msg1}','{$amount}','{$date}','{$_SESSION['user_id']}')";
                $pay_result=mysqli_query($connect,$payment);
                if($pay_result){
                  // echo "<script>alert('ok')</script>";
                }else{
                    echo "<script>alert('errorrrrrrrrrrr')</script>";
                }
                
                
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
                    $send1="$msg";
                    $send2="Source Account : $s_acc";
                    $send3="Account Holder Name : $acc_name";
                    $send4="To Account :  $to_acc";
                    $send5="Amount : $amount";
                    $mail->Subject = "Payment";
                    $mail->Body    = "$send1<br>$send2<br>$send3<br>$send4<br>$send5<br>";
                    $mail->AltBody = 'If you see this mail. please reload the page.';

                    if(!$mail->send()) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        $error_msg="user password send to <br>".$email;
                    }
                    
                      header("location:inter_bank_tranfer_succuss_page.php?to_acc=$to_acc&amount=$amount&email=$email&s_acc=$acc_n&acc_name=$acc_name&s_acc=$s_acc&msg=$msg");
                }else{
                    $msg="Error";
                } 
?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
        <link rel="stylesheet" href="../css/pre-loader.css">
        <style>
            body{
                background-attachment: fixed;
                background-size: 100% 100%;
                background-image: linear-gradient(to right, rgba(255, 255, 255, 255)20%, rgba(0, 0, 0, 0.4)),url("../img/online-banking-3559760.jpg");
                overflow-x: hidden;
            }
            
            .box{
                
            }
            
            td{
                
                border-spacing: 30px;
                padding: 10px;
            }
            table{
                border-collapse:collapse;
                font-size:18px;
                border: none;
                width:100%;
                color: white;
            }
            
            .btn{
                float: right;
                width: 30%;
                background-color: #24c79b;
                margin-right: 4%;
            }
            .btn:hover{
                background-color: green;
                color: white;
            }
            .box{
                width: 45%;
                height:auto;
                background-color:  rgba(0,0,0,0.7);
                margin-top: 8%;
                padding: 10px;
                box-shadow: 6px 6px 6px;
                /*opacity: 0;
               animation-name: box_ani;
                animation-delay: 0.5s;
                animation-duration: 0.8s;
                animation-fill-mode: forwards;*/
            }
           /* @-webkit-keyframes box_ani {
                from {opacity: 0;} 
                to {opacity: 1;}
            }*/
            
        </style>
    </head>
    <body>
         <div  class="loader hidden">
           <img src="../img/load.svg" style="width:50px;">
        </div>
        <div class="row">
            <div class="col-md-12">
                <center>
                    <div class="box">
                        <form method="POST" action="">
                        <table class="ani">
                            <tr>
                                <td>Source Account</td>
                                <td>
                                    <?php echo $s_acc;?>
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Account Holder
                                </td>
                                <td>
                                     <?php echo $acc_name;?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    To Account
                                </td>
                                <td>
                                     <?php echo $to_acc;?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Amount
                                </td>
                                <td>
                                     <?php echo "Rs : ".$amount;?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   Email
                                </td>
                                <td>
                                     <?php echo $email;?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <a href="inter_bank_tranfer.php"> <input type="button" class="btn" value="Back" onclick=""></a>
                                    <input type="submit" class="btn" name="submit" value="Comfirm" id="btn" onclick="btn()">
                                </td>
                            </tr>
                        </table>
                        </form>
                    </div>
                </center> 
            </div>
        </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js" integrity="sha256-lPE3wjN2a7ABWHbGz7+MKBJaykyzqCbU96BJWjio86U=" crossorigin="anonymous"></script>
        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TimelineMax.min.js" integrity="sha256-fIkQKQryItPqpaWZbtwG25Jp2p5ujqo/NwJrfqAB+Qk=" crossorigin="anonymous"></script>
        
     <script src="../js/animation.js"></script>
    </body>
</html>