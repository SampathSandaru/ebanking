<?php session_start();
require_once('connect.php');
?>
<?php
    
    if(!isset($_SESSION['user_id'])){
        header('location:../index.php');
    }
    $target_file=$_SESSION['img'];
    if(isset($_POST['submit'])){
        $fname=mysqli_real_escape_string($connect,$_POST['fname']);
        $lname=mysqli_real_escape_string($connect,$_POST['lname']);
        $number=mysqli_real_escape_string($connect,$_POST['number']);
        $email=mysqli_real_escape_string($connect,$_POST['email']);
        
        $query="UPDATE `user` SET first_name='{$fname}', last_name='{$lname}',
                email='{$email}', number='{$number}' WHERE id='{$_SESSION['user_id']}'";
        
        $result=mysqli_query($connect,$query);
        
        if($result){
            
            echo "<script>alert('update seccuss.')</script>";
        }else{
            echo "<script>alert('update Fial.')</script>";
        }
        
    }

    if(isset($_POST['upload_pic'])){
        $target_dir="../upload/";
        
        if($_FILES["fileToUpload"]["name"]==""){
            $target_file=$_SESSION['img'];
        }else{
            $target_file =$_FILES["fileToUpload"]["name"];
            $_SESSION['img']= $target_file ;   
        }
        
        $upload_pict=move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],
                          "$target_dir".$_FILES["fileToUpload"]["name"]);
        
        $query="UPDATE `user` SET img='{$target_file}' WHERE id='{$_SESSION['user_id']}'";
        
        $result=mysqli_query($connect,$query);
        
        if($result){
            
           // echo "<script>alert('update seccuss.')</script>";
        }else{
            echo "<script>alert('update Fial.')</script>";
        }
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        
        <link rel="stylesheet" href="../css/pre-loader.css">
        <style>
            body{
                background-attachment: fixed;
                background-size: 100% 100%;
                background-image: linear-gradient(to right, rgba(255, 255, 255, 255)25%, rgba(0, 0, 0, 0.4)),url("../img/online-banking-3559760.jpg");
                overflow-x: hidden;
            }
            
            .edit-details{
                width:75%;
                height: 250px;
                border-collapse: separate;
                border-spacing: 16px;
                position: relative;
                top: 100px;
                left: 100px;
            } 
            .profile_pic{
                width:50%;
                height: 50px;
                border-collapse: separate;
                border-spacing: 16px;
                position: relative;
                top: 100px;
                left: 50px;
            }
            
            
            input[type="submit"],[type="reset"]{
                width: 49%;
            }
            
             .img_p img{
                width: 200px;
                height: 200px;
                 border-radius:50%;
            }
            .chooice_file{
                margin-top: -40px;
                margin-left: 48px;
                z-index: -99;
            }
            
            .upload_pic{
                border: none;
                width: 15px;
                background-color: green;
                color:aliceblue;
                border-radius: 50px;
            }
            
            .upload_pic:hover{
                transform: scale(1.07);
                transition: 0.8s;
            }
           
        </style>
    </head>
    
    <body>
        
        <!--<div  class="loader">
           <img src="../img/load.svg" style="width:50px;">
        </div>-->
        <div class="row">
            <div class="col-md-8 bg">
             <center>
              <form method="post">
                <table class="edit-details">
                    <tr>
                        <td>First Name</td><td><input type="text" class="form-control" value="<?php echo $_SESSION['first_name']?>" name="fname"></td>
                    </tr>
                     <tr>
                        <td>Last Name</td><td><input type="text" class="form-control" value="<?php echo  $_SESSION['last_name']?>" name="lname"></td>
                    </tr>
                     <tr>
                        <td>Email</td><td><input type="email" class="form-control" value="<?php echo  $_SESSION['email']?>" name="email"></td>
                    </tr>
                    <tr>
                        <td>Contact Number</td><td><input type="text" class="form-control" value="<?php echo  $_SESSION['number']?>" name="number"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="reset" class="btn" style="background-color:red">
                            <input type="submit" class="btn" style="background-color:#11cf20" value="Save" name="submit">
                        </td>
                    </tr>
                </table>
                 </form>
                </center>    
            </div>
            <div class="col-md-4">
                <div>
                <form method="post" enctype="multipart/form-data">
                    <table class="profile_pic">
                        <tr>
                            <td class="img_p">
                                <?php
                                    $target_dir=$_SESSION['path'];
                                    echo '<img src="'.$target_dir.$target_file.'">'; 
                                ?>
                                <input type="file" name="fileToUpload" class="chooice_file">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="upload_pic" value="upload" class="upload_pic">
                            </td>
                        </tr>
                    </table>
                </form>
                </div>
            </div>
        </div>
        
    </body>
</html>