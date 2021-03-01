<?php session_start();
        include('connect.php');
?>
<html>
    <head>
        <style>
            body{
                background-attachment: fixed;
                background-size: 100% 100%;
                background-image: linear-gradient(to right, rgba(255, 255, 255, 255)20%, rgba(0, 0, 0, 0.4)),url("../img/online-banking-3559760.jpg");
                overflow-x: hidden;
            }
            
            .user_table{
                position: relative;
                top: 80px;
                left: -40px;
                border-collapse: collapse;
                
            }
            
            .user_table td{
                padding: 15px;
                border-bottom: 1px solid black;
                background-color:antiquewhite;
            }
            
            .user_table th{
                background-color: #b54428;
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <div class="row">
        <div class="col-md-12">
        <center>
            <table class="user_table form-control">
                <?php
                    $count=1;
                    $table="<tr>";
                    $table.="<th>NO</th>";
                    $table.="<th>Name</th>";
                    $table.="<th>Account Number</th>";
                    $table.="<th>Amount</th>";
                    $table.="<th>Transaction</th>";
                    $table.= "</tr>";
                
                    $query="SELECT * FROM `user` u,`account` a WHERE u.id=a.user_id";
                    $result=mysqli_query($connect,$query);
                
                    if($result){
                        
                        while($recode=mysqli_fetch_assoc($result)){
                                $table.="<tr>";
                                $id=$recode['user_id'];
                                $table.="<td>$count</td>";
                                $table.="<td>$recode[first_name] $recode[last_name]</td>";
                                $table.="<td>$recode[account_number]</td>";
                                $table.="<td>$recode[amount]</td>";
                                $table.="<td><a href=\"View_Transaction.php?user_id=$id\" target=\"page1\" style=\"text-decoration:none\">View Transaction</a></td>";
                                $table.="</tr>";
                                
                                $count++;
                        }
                    }
                
                   echo $table;
                ?>
            </table>
        </center>
        </div>
        </div>
    </body>
</html>