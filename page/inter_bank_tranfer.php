<?php  session_start();
        include('connect.php');
?>

<?php
    $query="select u.first_name as f_name,u.last_name as l_name,a.account_number as acc,a.amount as amount from user u,account a where u.id=a.user_id AND u.id='{$_SESSION['user_id']}'";
    $result=mysqli_query($connect,$query);

    if($result){
        //$count=0;
        while($recode=mysqli_fetch_assoc($result)){
            $acc_n=$recode['acc'];
        }
    }

    if(isset($_POST['submit'])){
        $to_acc=mysqli_real_escape_string($connect,$_POST['to_acc']);
        $acc_name=mysqli_real_escape_string($connect,$_POST['acc_name']);
        $amount=mysqli_real_escape_string($connect,$_POST['amount']);
        $email=mysqli_real_escape_string($connect,$_POST['email']);
        header("location:inter_bank_tranfer_comfirm_page.php?to_acc=$to_acc&amount=$amount&email=$email&s_acc=$acc_n&acc_name=$acc_name");
    }
?>

<html>
    <head>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
       
        <style>
            body{
                background-attachment: fixed;
                background-size: 100% 100%;
                background-image: linear-gradient(to right, rgba(255, 255, 255, 255)20%, rgba(0, 0, 0, 0.4)),url("../img/bram-naus-551904-unsplash.jpg");
                overflow-x: hidden;
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
            .box{
                width: 40%;
                height:380px;
                background-color: rgba(0,0,0,0.7);
                margin-top: 6%;
                padding: 10px;
                box-shadow: 6px 6px 6px;
                color: white;
                opacity: 0.0;
                animation-name: box_ani;
                animation-delay: 0.5s;
                animation-duration:1s;
                animation-fill-mode: forwards;
            }
           @-webkit-keyframes box_ani{
                from { margin-top: -500px; opacity: 0;} 
                to {margin-top:70px; opacity: 1;}
            }
        </style>
    </head>
    <body>
          
        <div class="row">
            <div class="col-md-12">
                <center>
                    <div class="box">
                        <form method="post" action="inter_bank_tranfer.php">
                        <table class="ani">
                            <tr>
                                <td>Source Account</td>
                                <td>
                                <select  class="form-control">
                                    <option>Select Account</option>
                                    <option value="<?php $acc_n;?>"><?php echo $acc_n;?></option>
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Account Holder Name
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="acc_name" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    To Account
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="to_acc" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Amount
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="amount" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   Email
                                </td>
                                <td>
                                    <input type="email" class="form-control" name="email" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <input type="reset" class="btn">
                                    <input type="submit" class="btn" name="submit" value="Next">
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