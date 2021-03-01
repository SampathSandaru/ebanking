<?php include('connect.php');
        session_start();

?>
<html>
    <header>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <style>
            body{
                 background-attachment: fixed;
                background-size: 100% 100%;
                background-image: linear-gradient(to right, rgba(255, 255, 255, 255)20%, rgba(0, 0, 0, 0.4)),url("../img/online-banking-3559760.jpg");
            }
            
            table{
                width:55%;
                padding-top: 20px;  
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
            .btn{
                margin-top: 17px;
            }
        </style>
    </header>
    <body>
        <center>
            <table>
                <form method="post">
                <tr>
                    <td class="td">From ;<input type="date"  class="form-control" name="from-date">
                    </td>
                    <td class="td">To ;<input type="date" class="form-control" name="to-date">
                    </td>
                    <td class="td">
                        <input type="submit" name="submit" value="Search" class="btn">
                    </td>
                </tr>
                </form>
               <?php
                
                if(isset($_POST['submit'])){
                    $from_dates=$_POST['from-date'];
                    $to_dates=$_POST['to-date'];
                    $query="select * from `payment_other_bank` where date between '$from_dates' and '$to_dates';";
                    $result=mysqli_query($connect,$query);
                    if($result){
                            $tb="<tr>";
                            $tb.="<th>Accont-number</th>";
                            $tb.="<th>Amount</th>";
                            $tb.="<th>Status</th>";
                            $tb.="<th>Date</th>";
                            $tb.="<tr>";

                            echo $tb;
                            while($recode=mysqli_fetch_assoc($result)){
                                $tb1="<tr>";
                                $tb1.="<td>$recode[account_number]</td>";
                                $tb1.="<td>$recode[amount]</td>";
                                $tb1.="<td>$recode[status]</td>";
                                $tb1.="<td>$recode[date]</td>";
                                $tb1.="</tr>";
                                echo $tb1;
                        }
                    }else{
                        echo "<script>alert('errorrrr')</script>";
                    }   
                        
                }else{
                  $query="SELECT * FROM `payment_other_bank` WHERE user_id='{$_SESSION['user_id']}'";
                        $result=mysqli_query($connect,$query);
                        if($result){
                            $tb="<tr>";
                            $tb.="<th>Accont-number</th>";
                            $tb.="<th>Amount</th>";
                            $tb.="<th>Bank</th>";
                            $tb.="<th>Status</th>";
                            $tb.="<th>Date</th>";
                            $tb.="<tr>";

                            echo $tb;
                            while($recode=mysqli_fetch_assoc($result)){
                                $tb1="<tr>";
                                $tb1.="<td>$recode[account_number]</td>";
                                $tb1.="<td>$recode[amount]</td>";
                                $tb1.="<td>$recode[bank]</td>";
                                $tb1.="<td>$recode[status]</td>";
                                $tb1.="<td>$recode[date]</td>";
                                $tb1.="</tr>";
                                echo $tb1;
                        }
                    }else{
                        echo "<script>alert('errorrrr')</script>";
                    }  
            }
                ?>
            </table>
        </center>
    </body>
</html>