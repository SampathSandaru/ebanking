<?php session_start();
        include('connect.php');

    $id=$_GET['user_id'];

     function search_date($from_dates,$to_dates,$id,$connect){
                $query="select number as account_number,type,amount,date
                        from `bill_payment`
                        where user_id='{$id}' AND date between '$from_dates' and '$to_dates'

                        union all

                        select account_number,'Green Bank' as no,amount,date
                        from `payment`
                        where user_id='{$id}' AND date between '$from_dates' and '$to_dates'

                        union all

                        select account_number,bank as no,amount,date
                        from `payment_other_bank`
                        where user_id='{$id}' AND date between '$from_dates' and '$to_dates' ;";

                        $result=mysqli_query($connect,$query);
                        return  $result;
    }

    function all_date($id,$connect){
                $query="select number as account_number,type,amount,date
                        from `bill_payment`
                        where user_id='{$id}' 

                        union all

                        select account_number,'Green Bank' as no,amount,date
                        from `payment`
                        where user_id='{$id}' 

                        union all

                        select account_number,bank as no,amount,date
                        from `payment_other_bank`
                        where user_id='{$id}' ";

                        $result=mysqli_query($connect,$query);
                        return  $result;
    }
                
    function set_table($result){
        $tot=0;
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
                }
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
                        <input type="submit" name="all" value="All" class="btn">
                    </td>
                 </tr>
                </form>
        <?php
 
             if(isset($_POST['submit'])){
                $from_dates=$_POST['from-date'];
                $to_dates=$_POST['to-date'];
                
                $result=search_date($from_dates,$to_dates,$id,$connect);
                set_table($result);
            
            }else if(isset($_POST['all'])){
                $result=all_date($id,$connect);
                set_table($result);
            }
?>
        </table>
    </body>
</html>