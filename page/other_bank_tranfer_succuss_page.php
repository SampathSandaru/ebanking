<?php  session_start();
        include('connect.php');
?>

<?php
$msg="";

        $s_acc=$_GET['s_acc'];
        $to_acc=$_GET['to_acc'];
        $acc_name=$_GET['acc_name'];
        $amount=$_GET['amount'];
        $email=$_GET['email'];
        $msg=$_GET['msg'];
        $bank=$_GET['bank'];
        
?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
            .box1{
                width: 50%;
                height:auto;
                background-color: rgba(0,0,0,0.7);
                margin-top: 8%;
                padding: 10px;
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
            caption{
                background-color: brown;;
                color: white;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-md-12">
                <center>
                    <div class="box1">
                        <form method="POST" action="">
                        <table>
                              <caption><?php echo $msg;?></caption>
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
                                    Bank
                                </td>
                                <td>
                                     <?php echo $bank;?>
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
                        </table>
                        </form>
                    </div>
                </center> 
            </div>
        </div>
    </body>
</html>