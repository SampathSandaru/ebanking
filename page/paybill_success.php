<?php  session_start();
        include('connect.php');
?>

<?php 
    $acc=$_GET['acc'];
    $bill_type=$_GET['bill'];
    $amount=$_GET['amount'];
    $number=$_GET['number'];
    $msg=$_GET['msg'];
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
                margin-top: 100px;
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
            
            .btn{
               
            }
            
        </style>
    </head>
    <body>
        <table>
            <tr>
                <td colspan="2" style="background-color:#c9222d;text-align:center;">
                <?php echo $msg;?>
                </td>
            </tr>
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
        </table>
    </body>
</html>