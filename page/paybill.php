<?php  session_start();
        include('connect.php');
?>

<?php 
    $query="select * from `account` where user_id='{$_SESSION['user_id']}'";
    $result=mysqli_query($connect,$query);

    if($recode=mysqli_fetch_assoc($result)){
        $_SESSION['acc_no']=$recode['account_number'];
    }

    if(isset($_POST['submit'])){
        $acc=$_POST['acc'];
        $bill_type=$_POST['bill'];
        $amount=$_POST['amount'];
        $number=$_POST['number'];
        
        // echo "<script>alert('$bill_type')</script>";
       header("Location:paybill_confirm.php?acc=$acc&bill=$bill_type&amount=$amount&number=$number");
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
            
            .tb1{
                margin-left: 420px;
                margin-top:80px;
            }
            
            .tb1 td{
                padding: 15px;
            }
            
            .btn{
                width: 48%;
            }
            
            .btn:hover{
                background-color: greenyellow;
            }
        </style>
    </head>
    <body>
         <form method="POST">
                <table class="tb1">
                    <tr>
                        <td>Account Number</td>
                        <td>
                            <select class="form-control" name="acc">
                                <option>Select Account</option>
                                <option value="<?php echo $_SESSION['acc_no'];?>"><?php echo $_SESSION['acc_no'];?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Select Bill</td>
                        <td>
                            <select class="form-control" name="bill">
                                <option value="">Select Account</option>
                                <option value="Dialog">Dialog</option>
                                <option value="Mobitel">Mobitel</option>
                                <option value="Hutch">Hutch</option>
                                <option value="Airtel">Airtel</option>
                                <option value="Water Bill">Water Bill</option>
                                <option value="Electricity Bill">Electricity Bill</option>
                                <option value="ceylinco insurance">ceylinco insurance</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Enter Number</td>
                        <td><input type="text" name="number" class="form-control"> </td>
                    </tr>
                    <tr>
                        <td>Enter Amount</td>
                        <td><input type="text" name="amount" class="form-control"> </td>
                    <tr>
                        <td></td>
                        
                        <td>
                            <input type="reset" class="btn" value="cancel"> 
                            <input type="submit" name="submit" class="btn" value="Next"> </td>
                    </tr>
                </table>
        </form>
    </body>
</html>