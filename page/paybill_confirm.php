<?php  session_start();
        include('connect.php');
?>

<?php 
    $acc=$_GET['acc'];
    $bill_type=$_GET['bill'];
    $amount=$_GET['amount'];
    $number=$_GET['number'];
    $email=$_SESSION['email'];
$msg="";

    if(isset($_POST['submi'])){
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
                $update_result=mysqli_query($connect,$amount_update);
            }
        $date=date("Y-m-d");
        $payment="INSERT INTO `bill_payment` (number,status,amount,date,type,user_id)  VALUES ('{$number}','{$msg1}','{$amount}','{$date}','{$bill_type}','{$_SESSION['user_id']}')";
        $pay_result=mysqli_query($connect,$payment);
        if($pay_result){
            echo "<script>alert('ok')</script>";
        }else{
            echo "<script>alert('error')</script>";
        }
        
        if($update_result){
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
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $send1="$msg";
                    $send2="Source Account : $acc";
                    $send4="Number :  $number";
                    $send5="Amount : $amount";
                    $mail->Subject = "Bill Payment";
                    $mail->Body    = "$send1<br>$send2<br>$send4<br>$send5<br>";
                    $mail->AltBody = 'If you see this mail. please reload the page.';

                    if(!$mail->send()) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                    header("Location:paybill_success.php?acc=$acc&bill=$bill_type&amount=$amount&number=$number&msg=$msg");
                        $error_msg="";
                    }
        }else{
            echo "<script>alert('error')</script>";
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
                background-image: linear-gradient(to right, rgba(255, 255, 255, 255)20%, rgba(0, 0, 0, 0.4)),url("../img/online-banking-3559760.jpg");
            }
            
            table{
               margin-left: 450px;
                margin-top: 140px;
                border-collapse:collapse;
                width: 25%;
                opacity: 0.0;
                animation-name: tb;
                animation-delay: 0.4s;
                animation-duration: 0.8s;
                animation-fill-mode: forwards;
            }
            
            @-webkit-keyframes tb{
                from{margin-top: -500;opacity: 0.0;}
                to{margin-top: 100px;opacity: 1}
            }
            
            td{
                padding:20px;
                background-color: rgb(0,0,0,0.6);
                color: white;
            }
            
            
            
        </style>
    </head>
    <body>
        <form method="post">
        <table>
            <tr>
                <td>
                    Account Number
                </td>
                <td>
                    <?php echo $acc;?>
                </td>
            </tr>
             <tr>
                <td>
                    Bill Type
                </td>
                <td>
                    <?php  echo $bill_type;?>
                </td>
            </tr>
            <tr>
                <td>
                   Number
                </td>
                <td>
                    <?php  echo $number;?>
                </td>
            </tr>
            <tr>
                <td>
                   Amount
                </td>
                <td>
                    <?php  echo $amount;?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="reset"  value="cancel" class="btn"> 
                    <input type="submit" name="submi" value="Pay" class="btn"> </td>
            </tr>
        </table>
        </form>
    </body>
</html>