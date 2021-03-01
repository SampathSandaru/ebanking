<?php session_start();
        include('connect.php');
?>
<?php
    
        $id=$_GET['id'];
        $query="SELECT * FROM `user` WHERE id='{$id}'";
        $result=mysqli_query($connect,$query);
                
        if($result){
                        
            while($recode=mysqli_fetch_assoc($result)){
                $name=$recode['first_name'];
                $lname=$recode['last_name'];
                $email=$recode['email'];
                $number=$recode['phone_number'];
                $nic=$recode['NIC'];
            }
        }

    if(isset($_POST['submit'])){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $number=$_POST['number'];
        $nic=$_POST['nic'];
       
        $query="UPDATE `user` SET first_name='{$fname}' ,last_name='{$lname}',email='{$email}',phone_number='{$number}',NIC='{$nic}' WHERE id='{$id}'";
        $res=mysqli_query($connect,$query);
    }
?>


<html>
    <head>
         <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
         <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
        <style>
             body{
                background-attachment: fixed;
                background-size: 100% 100%;
                background-image: linear-gradient(to right, rgba(255, 255, 255, 255)20%, rgba(0, 0, 0, 0.4)),url("../img/purse-1478852.jpg");
                overflow-x: hidden;
            }
            
            .tb{
                margin-top: 100px;
            }
        </style>
    </head>
    <body>
    <div class="container">
   
    <div class="tb">
    <article class="card-body mx-auto" style="max-width: 400px;">
        <form method="post">
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
             </div>
            <input name="fname" class="form-control" placeholder="Full name" type="text" value="<?php echo $name;?>">
        </div> <!-- form-group// -->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
             </div>
            <input name="lname" class="form-control" placeholder="Full name" type="text" value="<?php echo $lname;?>">
        </div> <!-- form-group// -->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
             </div>
            <input name="email" class="form-control" placeholder="Email address" type="email" value="<?php echo $email;?>">
        </div> <!-- form-group// -->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
            </div>
            <input name="number" class="form-control" placeholder="Phone number" type="text" value="<?php echo $number;?>">
        </div> <!-- form-group// -->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-crosshairs"></i> </span>
            </div>
            <input class="form-control" placeholder="NIC" type="text" name="nic" value="<?php echo $nic;?>">
        </div> <!-- form-group// -->                                  
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" name="submit"> Update Account  </button>
        </div> <!-- form-group// -->                                                       
    </form>
    </article>
    </div> <!-- card.// -->

    </div> 
    <!--container end.//-->
    </body>
</html>