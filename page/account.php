<?php  session_start();
        include('connect.php');
?>

<?php
$table="";
    $query="select u.first_name as f_name,u.last_name as l_name,a.account_number as acc,a.amount as amount from user u,account a where u.id=a.user_id AND u.id='{$_SESSION['user_id']}'";
    $result=mysqli_query($connect,$query);

    if($result){
        $table="<tr>";
        $table.="<th>Account Name</th>";
        $table.="<th>Account Number</th>";
        $table.="<th>Currency</th>";
        $table.="<th>Balence</th>";
        while($recode=mysqli_fetch_assoc($result)){
            $table.="</tr>";
            $table.="<tr>";
            $table.="<td>$recode[f_name]  $recode[l_name]</td>";
            $table.="<td>$recode[acc]</td>";
            $table.="<td>LKR</td>";
            $table.="<td>$recode[amount]</td>";
            $table.="</tr>";
            $_SESSION['acc_no']=$recode['acc'];
        }
    }
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
            
            .box{
                width: 60%;
                height:auto;
                margin-top: 8%;
                box-shadow: 6px 6px 6px;
                opacity: 0;
                animation-name: box_ani;
                animation-delay: 0.5s;
                animation-duration: 0.8s;
                animation-fill-mode: forwards;
            }
            
            @-webkit-keyframes box_ani {
                from {opacity: 0;} 
                to {opacity: 1;}
            }
            
            td{
                background-color: antiquewhite;
                border-bottom: 1px solid black;
                border-spacing: 30px;
                padding: 13px;
                text-align: center;
            }
            th{
                background-color: #b54428;
                padding: 13px;
            }
            td:hover{
                background-color: azure;
            }
            table{
                border-collapse:collapse;
                font-size:20px;
                border: none;
                width:100%;
            }
            
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-md-12">
                <center>
                    <div class="box">
                        <table>
                            <?php  echo $table;?>
                        </table>
                    </div>
                </center>    
            </div>
        </div>
    </body>
</html>