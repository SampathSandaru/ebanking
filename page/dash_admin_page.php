<?php session_start();?>
<?php require_once('connect.php'); ?>
<?php
    if(isset($_POST['submit'])){
        $email=$_POST['email'];
        $msg=$_POST['msg'];
        
        
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
                    $mail->setFrom("lahirusampathsadaruwan@gmail.com");
                    $mail->addAddress("lahirusampathsadaruwan@gmail.com");             // Name is optional
                    $mail->addReplyTo($email);
                    //$mail->addCC('cc@example.com');
                    //$mail->addBCC('bcc@example.com');
                    //$mail->addAttachment('../img/1.png');         // Add attachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $send1="Reply to this email ; $email";
                    $send2="$msg";
                    $mail->Subject = "Messege";
                    $mail->Body    = "$send1<br><br>$send2<br>";
                    $mail->AltBody = 'If you see this mail. please reload the page.';

                    if(!$mail->send()) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        $error_msg="user password send to <br>".$email;
                    }
    }
?>


<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
             body{
                background-attachment: fixed;
                background-size: 100% 100%;
                background-image: linear-gradient(to right, rgba(255, 255, 255, 255)20%, rgba(0, 0, 0, 0.4)),url("../img/bram-naus-551904-unsplash.jpg");
                overflow-x: hidden;
            }
            
            .dash1{
                width: 300px;
                height:300px;
                background-color:rgb(0,0,0,0.5);
                margin-left: 200px;
                opacity: 0;
                animation-name: cit;
                animation-delay: 0.4s;
                animation-duration: 1.5s;
                animation-fill-mode: forwards;
            }
            
             @keyframes cit{
                from{margin-top:-500px;opacity: 0.0}
                to{margin-top: 0px;opacity: 1.0}
            }
            
            .dash2{
                width: 300px;
                height: 50px;
                background-color:#992020;
                margin-left: 200px;
                margin-top: 0;
                opacity: 0.0;
                animation-name: ci;
                animation-delay: 0.4s;
                animation-duration: 1.5s;
                animation-fill-mode: forwards;
            }
            
             @keyframes ci{
                from{margin-top:-500px;opacity: 0.0}
                to{margin-top: 50px;opacity: 1.0}
            }
           
            .td1 table{
                width: 100%;
            }
            
            
            
            .td1 td{
                padding:30px;
                border-spacing: 20px;
                font-weight: bold;
            }
            
            .td1 tr:hover{
                background-color: #63d682;
                transition: 0.4s;
            }
            
            td a{
              color: white;
            }
          
            .footer_table{
                margin: 40px;
                color: white;
            }
            
            .footer_table td{
                padding: 15px;
            }
            
            .page-footer{
                width: 100%;
                height: auto;
                opacity: 0.0;
                animation-name: fo;
                animation-delay: 1s;
                animation-duration: 1.5s;
                animation-fill-mode: forwards;
            }
            
            .page-footer2{
                width: 100%;
                height: 50px;
                opacity: 0.0;
                padding: 15px;
                text-align: center;
                color: white;
                animation-name: fo;
                animation-delay: 1s;
                animation-duration: 1.5s;
                animation-fill-mode: forwards;
            }
            
            .page-footer3{
                width: 100%;
                height:2px;
                opacity: 0.0;
                animation-name: fo;
                animation-delay: 1s;
                animation-duration: 1.5s;
                animation-fill-mode: forwards;
            }
            
            
             @keyframes fo{
                from{opacity: 0.0}
                to{bottom: 0px;opacity: 1.0}
            }
            
            .btn{
                background-color: green;
                color: white;
                float: right;
            }
            
            .btn:hover{
                transform: scale(1.06);
                transition: 0.5s;
                color: white;
            }
            
             
        .loc{
                margin-top:40px;
            }
            
            .contact{
               padding: 50px;
            }
            
            /****************************calculator************************************/
            input[type="button"]{ 
                background-color:white; 
                color: black; 
                border: solid black 2px; 
                width:100%;
                height: 50px;
            } 

            input[type="text"]{ 
                background-color:white; 
                border: solid black 2px; 
                width:100%;
                height: 50px;
            } 
            
            .cal{
                width: 100%;
                height: 300px;
                
            }
            
            .cal td{
                border-collapse:collapse;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-md-3">
                <div class="dash2"></div>
                <div class="dash1">
                <div class="td1">
                    <table class="t1">
                        <tr>
                            <td><a href="Show_Notification.php" target="page1"> Show Message</a></td>
                        </tr>
                        <tr>
                            <td><a href="Notification_send.php" target="page1">Send Message</a></td>
                        </tr>
                         <tr>
                            <td><a href="Show_Notification.php" target="page1">Add Customer</a></td>
                        </tr>
                      
                    </table>
                </div>    
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="dash2"></div>
                <div class="dash1">
                    <ul class="list-group">
                        <li class="list-group-item">You Can add/manage Customer ,View their trnsaction</li>
                        <li class="list-group-item">You Can view custmoer Transaction ,Account Details</li>
                        <li class="list-group-item">You Can add post</li>
                        <li class="list-group-item">you can add admin</li>
                        
                    </ul>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="dash2"></div>
                <div class="dash1">
        <table class="cal"> 
		<tr> 
			<td colspan="3"><input type="text" id="result"/></td> 
			<!-- clr() function will call clr to clear all value -->
			<td><input type="button" value="c" onclick="clr()"/> </td> 
		</tr> 
		<tr> 
			<!-- create button and assign value to each button -->
			<!-- dis("1") will call function dis to display value -->
			<td><input type="button" value="1" onclick="dis('1')"/> </td> 
			<td><input type="button" value="2" onclick="dis('2')"/> </td> 
			<td><input type="button" value="3" onclick="dis('3')"/> </td> 
			<td><input type="button" value="/" onclick="dis('/')"/> </td> 
		</tr> 
		<tr> 
			<td><input type="button" value="4" onclick="dis('4')"/> </td> 
			<td><input type="button" value="5" onclick="dis('5')"/> </td> 
			<td><input type="button" value="6" onclick="dis('6')"/> </td> 
			<td><input type="button" value="-" onclick="dis('-')"/> </td> 
		</tr> 
		<tr> 
			<td><input type="button" value="7" onclick="dis('7')"/> </td> 
			<td><input type="button" value="8" onclick="dis('8')"/> </td> 
			<td><input type="button" value="9" onclick="dis('9')"/> </td> 
			<td><input type="button" value="+" onclick="dis('+')"/> </td> 
		</tr> 
		<tr> 
			<td><input type="button" value="." onclick="dis('.')"/> </td> 
			<td><input type="button" value="0" onclick="dis('0')"/> </td> 
			<!-- solve function call function solve to evaluate value -->
			<td><input type="button" value="=" onclick="solve()"/> </td> 
			<td><input type="button" value="*" onclick="dis('*')"/> </td> 
		</tr> 
	</table> 
                </div>
            </div>
            
        </div>
         <br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br>

        <footer class="page-footer font-small pt-4" style="background-color:rgb(0,0,0,0.8);">
            <div class="row">
                <div class="col-md-4">
                     <div class="contact">
                        <i class="fa fa-home" style="font-size: 21px;color:white">
                        NO 80/1,Gall Road,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Colombo.
                        </i>
                        <br>
                        <br>
                        <i class="fa fa-phone" style="font-size: 21px;color:white">
                            &nbsp;0763304183
                        </i>
                        <br>
                        <br>
                        <i class="fa fa-fax" style="font-size: 21px;color:white">&nbsp;0112204444</i>
                        <br>
                        <br>
                        <i class="fa fa-envelope-o" style="font-size: 21px;color:white">&nbsp;lahirusampath8899@gmail.com</i>
                    </div>
                </div>
                <div class="col-md-4">
                    
                </div>
                <div class="col-md-4">
                    <div class="loc">
                    <iframe style="position:relative;width:100%;height:270px" id="gmap_canvas" src="https://maps.google.com/maps?q=colombu&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                    </iframe>
                <style>.mapouter{text-align:right;height:500px;width:600px;}.gmap_canvas                         {overflow:hidden;background:none!important;height:500px;width:600px;}
                </style>
        </div>
                </div>
                </div>
        </footer>
         <footer class="page-footer3" style="background-color:white;">
        </footer>
        <footer class="page-footer2" style="background-color:rgb(0,0,0,1);">
        @2019 copyright Green Banking
        </footer>
            
        
        <!-- Footer -->

<!-- Footer --><!--******************Calculator************************************-->
        <script> 
		//function that display value 
		function dis(val) 
		{ 
			document.getElementById("result").value+=val 
		} 
		
		//function that evaluates the digit and return result 
		function solve() 
		{ 
			let x = document.getElementById("result").value 
			let y = eval(x) 
			document.getElementById("result").value = y 
		} 
		
		//function that clear the display 
		function clr() 
		{ 
			document.getElementById("result").value = "" 
		} 
	</script> 
<!--****************************************************************-->
    </body>
</html>