<?php session_start();?>
<?php require_once('connect.php');

    $sql = "DELETE FROM `message` WHERE expire <= CURDATE()";
    $result=mysqli_query($connect,$sql);
    
?>

<html>
    <head>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <style>
            body{
                background-attachment: fixed;
                background-size: 100% 100%;
                background-image: linear-gradient(to right, rgba(255, 255, 255, 255)10%, rgba(0, 0, 0, 0.4)),url("../img/pay-online-credit-card-CNP-fraud.jpg");
                overflow-x: hidden;
            }
            
            table{
                width:55%;
                margin-top:80px;
                margin-left: 350px;
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
                padding: 15px;
                background-color: antiquewhite;
            }
            th{
                background-color: firebrick;
                color: aliceblue;
                padding: 15px;
            }
            
        </style>
    </head>
    <body>
        <table>
            <?php 
            $sql="SELECT * FROM `message` order by dates DESC;";
        $result=mysqli_query($connect,$sql);
    
        if($result){
                $tb="<tr>";
                $tb.="<th>Subject</th>";
                $tb.="<th>Message</th>";
                $tb.="<th width='15%;'>Date</th>";
                $tb.="</tr>";

                echo $tb;
                while($recode=mysqli_fetch_assoc($result)){
                    $tb1="<tr>";
                    $tb1.="<td>$recode[subject]</td>";
                    $tb1.="<td>$recode[msg]</td>";
                    $tb1.="<td>$recode[dates]</td>";
                    $tb1.="</tr>";
                    echo $tb1;
                }
        }else{
            echo "<script>alert('errorrrr')</script>";
        }
            ?>
        </table>
        <br><br><br><br><br><br>
        <br><br><br><br>
    </body>
</html>