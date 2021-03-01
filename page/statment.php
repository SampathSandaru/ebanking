<?php session_start();?>
<?php require_once('connect.php');?>
<?php
 $f_name=$_SESSION['user_id'].".txt";
 $email=$_SESSION['email'];
    if(isset($_POST['pdf'])){
        require('../fpdf/fpdf.php');

        class PDF extends FPDF
        {
            // Load data
            function LoadData($file)
            {
                // Read file lines
                $lines = file($file);
                $data = array();
                foreach($lines as $line)
                    $data[] = explode(';',trim($line));
                return $data;
            }
            
            function Header()
            {
                // Logo
                $this->Image('../img/i.jpg',10,12,30,0,'','');
                $this->Ln(15);
                $this->Cell(20,10,$_SESSION['first_name']." ".$_SESSION['last_name']);
                $this->Ln(6);
                $date=date("Y-m-d");
                $this->Cell(20,10,$date);
                // Line break
                $this->Ln(20);
            }
            
            // Colored table
            function FancyTable($header, $data)
            {   
               
               /* $this->Ln(15);
                $this->Cell(20,10,$_SESSION['first_name']." ".$_SESSION['last_name']);
                $this->Ln(6);
                $date=date("Y-m-d");
                $this->Cell(20,10,$date);
                $this->Ln();*/
                
                // Colors, line width and bold font
                $this->SetFillColor(20, 222, 33);
                $this->SetTextColor(255);
                $this->SetDrawColor(128,0,0);
                $this->SetLineWidth(.3);
                $this->SetFont('','B');
                
                
                // Header
                $w = array(40, 35, 40, 45);
                for($i=0;$i<count($header);$i++)
                    $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
                $this->Ln();
                // Color and font restoration
                $this->SetFillColor(224,235,255);
                $this->SetTextColor(0);
                $this->SetFont('');
                // Data
                $fill = false;
                foreach($data as $row)
                {
                    $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
                    $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
                    $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
                    $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
                    $this->Ln();
                    $fill = !$fill;
                }
                // Closing line
                $this->Cell(array_sum($w),0,'','T');
            }
            function Footer()
            {
                // Position at 1.5 cm from bottom
                $this->SetY(-15);
                // Arial italic 8
                $this->SetFont('Arial','I',8);
                // Page number
                $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
            }
        }

        $pdf = new PDF();
        // Column headings
        $header = array('Number', 'Type', 'Date', 'Amount (Rs)');
        
        //$pdf->Cell(20,10,'sampath sandaruwan!');
        // Data loading
        $data = $pdf->LoadData("$f_name");
        $pdf->SetFont('Arial','',14);
        $pdf->AddPage();
        $pdf->FancyTable($header,$data);
        $pdf->Output('statment.pdf','I');
        
        
        
        require '../email/PHPMailerAutoload.php';
            /*$credential = include('../email/credential.php');   //credentials import
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
            //$mail->addAttachment();         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = "Statment";
            $mail->Body    = "";
            $mail->AltBody = 'If you see this mail. please reload the page.';

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                //unlink($f_name);
            } else {
                $error_msg="user password send to <br>".$email;
            }*/

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
                overflow-x: hidden;
            }
            
            .tb{
                margin-top: 30px;
                margin-left: 400px;
                width:50%;
            }
            
            .btn{
                margin-top: 20px;
            }
            
            td{
                padding: 15px;
            }
            th{
                background-color: #b54428;
                padding: 13px;
            }
            
            td{
                background-color: antiquewhite;
               padding: 10px;
                border-bottom:1px solid black;
            }
            .td{
                background-color: rgb(0,0,0,0);
            }
            
        </style>
    </head>
    <body>
        <table class="tb">
         <form method="post">
                <tr>
                    <td class="td">From ;<input type="date"  class="form-control" name="from-date">
                    </td>
                    <td class="td">To ;<input type="date" class="form-control" name="to-date">
                    </td>
                    <td class="td">
                        <input type="submit" name="submit" value="Search" class="btn">
                    </td>
                    <td class="td">
                        <input type="submit" name="pdf" value="Download" class="btn">
                    </td>
                 </tr>
                </form>
            <?php
            
            if(isset($_POST['submit'])){
                $from_dates=$_POST['from-date'];
                $to_dates=$_POST['to-date'];
                $tot=0;
                
                $query="select number as account_number,type,amount,date
                        from `bill_payment`
                        where user_id='{$_SESSION['user_id']}' AND date between '$from_dates' and '$to_dates'

                        union all

                        select account_number,'Green Bank' as no,amount,date
                        from `payment`
                        where user_id='{$_SESSION['user_id']}' AND date between '$from_dates' and '$to_dates'

                        union all

                        select account_number,bank as no,amount,date
                        from `payment_other_bank`
                        where user_id='{$_SESSION['user_id']}' AND date between '$from_dates' and '$to_dates' ;";

                $result=mysqli_query($connect,$query);
                //$f_name=$_SESSION['user_id'].".txt";
                $fp=fopen($f_name,"w");
                if( $fp == false )
                {
                  echo ( "Error in opening file" );
                  exit();
                }
                if($result){
                        $tb="<tr>";
                        $tb.="<th>Accont-number</th>";
                        $tb.="<th>Type</th>";
                        $tb.="<th>Date</th>";
                        $tb.="<th>Amount</th>";
                        $tb.="<tr>";
                        echo $tb;
                        while($recode=mysqli_fetch_assoc($result)){
                            $tb1="<tr>";
                            $tb1.="<td>$recode[account_number]</td>";
                            $tb1.="<td>$recode[type]</td>";
                            $tb1.="<td>$recode[date]</td>";
                            $tb1.="<td>Rs $recode[amount]</td>";
                            $tb1.="</tr>";
                            echo $tb1;
                            $tot=$tot+$recode['amount'];
                            fwrite($fp,$recode['account_number'].';'.$recode['type'].';'.$recode['date'].';'.$recode['amount']);
                            fwrite($fp,"\n");
                            
                        }
                        fwrite($fp,"Totel".';'.';'.';'.$tot);
                        $tb3="<tr>";
                        $tb3.="<td>Totel</td>";
                        $tb3.="<td></td>";
                        $tb3.="<td></td>";
                        $tb3.="<td>Rs $tot /=</td>";
                        $tb3.="</tr>";
                         echo $tb3;
                }else{
                     echo  "<script>alert('no')</script>";
                }
            }
?>
        </table>
    </body>
</html>
