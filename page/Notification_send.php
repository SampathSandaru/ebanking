<?php session_start();?>
<?php require_once('connect.php'); 
    $msg="";
    if(isset($_POST['submit'])){
        $sub=$_POST['subject'];
        $msg=$_POST['msg'];
        
        $expire_date=date("Y-m-d",strtotime("+10 day"));
        $d=date("Y-m-d");
        $query="INSERT INTO `message` (subject,msg,dates,expire) VALUES('{$sub}','{$msg}','{$d}','{$expire_date}')";
        $result=mysqli_query($connect,$query);
        if($result){
            $msg="Message send successfull";
        }else{
            $msg="Message not send ";
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
                background-image: linear-gradient(to right, rgba(255, 255, 255, 255)10%, rgba(0, 0, 0, 0.4)),url("../img/pay-online-credit-card-CNP-fraud.jpg");
                overflow-x: hidden;
            }
            
            table{
                width:35%;
                margin-top:90px;
                margin-left: 400px;
            }
            
            td{
                padding: 10px;
            }
            
            .btn{
                width:49%;
                background-color: rgb(0,0,0,0.4);
                border: 1px solid orange;
                color: aliceblue;
            }
            
            .btn:hover{
                /*background-color: green;*/
                color: aliceblue;
            }
            
            .page-footer2{
                width: 100%;
                height: 55px;
                padding: 20px;
                text-align: center;
                color: white;
            }
        </style>
    </head>
    <body>
        <form method="post">
            <table>
                <tr>
                    <td>
                        Subject
                    </td>
                    <td>
                        <input type="text" name="subject" class="form-control" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <td>
                        Message
                    </td>
                    <td>
                        <textarea cols="30" rows="5" name="msg" class="form-control"></textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="color:red;"><?php  echo $msg;?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="reset" value="Cancel" class="btn">
                        <input type="submit" name="submit" value="Send" class="btn">
                    </td>
                </tr>
            </table>
        </form>
        <br><br><br><br><br><br>
        <br><br><br><br><br><br>
        <br><br>
        <footer class="page-footer2 page-footer font-small pt-4" style="background-color:rgb(0,0,0,0.7);">
        @2019 copyright Green Banking
        </footer>
    </body>
</html>