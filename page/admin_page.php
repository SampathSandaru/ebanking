<?php session_start();?>
<?php require_once('connect.php'); ?>

<?php 
    if(!isset($_SESSION['user_id'])){
        header("location:../index.php");
    }

    if(isset($_POST['pwd_change'])){
        $current_pwd=mysqli_real_escape_string($connect,$_POST['current_pwd']);
        $new_pwd1=mysqli_real_escape_string($connect,$_POST['new_pwd1']);
        $new_pwd2=mysqli_real_escape_string($connect,$_POST['new_pwd2']);
        
        $query="SELECT password FROM `admin` WHERE id='{$_SESSION['user_id']}' AND password='{$current_pwd}' LIMIT 1";
        
        $result=mysqli_query($connect,$query);
        
        if($result){
            if(mysqli_num_rows($result)==1){
                if($new_pwd1==$new_pwd2){
                    $query2="UPDATE `admin` SET password='{$new_pwd1}' WHERE id='{$_SESSION['user_id']}'";
                    
                    $result2=mysqli_query($connect,$query2);
                    if($result){
                        echo "<script>alert('Password change succuss..')</script>";
                    }else{
                         echo "<script>alert('Password change Fail..')</script>";
                    }
                }else{
                     echo "<script>alert('New Password Not Match..')</script>";
                }
            }else{
                 echo "<script>alert('Current password incorrect..')</script>";
            }
        }
    }
    
?>

<html>
    <head>
        <link rel="stylesheet" href="../css/admin_page_secon_navbar.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <link rel="shortcut icon" type="image/x-icon" href="../img/icon.ico"/>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        
         <link rel="stylesheet" type="text/css" href="../css/log-page.css">
        
        <style>
            body{
                overflow-x: hidden;
            }
            
            img{width: 65px;
                height: 65px;
                border-radius: 50%;
            }
            
            .first{
                height: auto;
            }
            .nav_table{
                float: right;
                width: 100%;
            }
            
            .fa{
                cursor: pointer;
                color: white;
                font-size: 25px;
            }
            
            .poupbox-navbar{
                background-color: darkgreen;
            }
            
            .box_nav{
                height: 50px;
                width: 100%;
                background-color: brown;
                color: aliceblue;
                text-align: left;
                padding: 12px;
                font-size: 23px;
            }  
/******poup box***************************************************************/
            .mod {
                display: none; /* Hidden by default */
                position:fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: hidden; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.8);/* Black w/ opacity */
                padding-top: 60px;
            }
            .mod-content {
                
                background-color: #fefefe;
                margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
                border: 1px solid #888;
                width: 50%; /* Could be more or less, depending on screen size */
            }
            .animate {
                -webkit-animation: animatezoom 0.6s;
                animation: animatezoom 0.6s
            }

        @-webkit-keyframes animatezoom {
                from {transform: scale(0)} 
                to {transform: scale(1)}
            }
            
            .imgcontainer {
                text-align: center;
                margin: 24px 0 12px 0;
                position: relative;
            }
            .close {
                position: absolute;
                right:25px;
                margin-top:-70px;
                top: 0;
                color: black;
                font-size: 35px;
                font-weight: bold;
            }
            .close:hover,.close:focus {
                color: black;
                cursor: pointer;
            }
           
            img.avatar {
                width: 13%;
                height: 60px;
                border-radius: 50%;
            }
            
            .box_tb{
                height: 220px;
                width: 90%;
                padding: 20px;
            }
    /***********************************************************/
            .col-md-12{
                float: right;
                margin-top: 2.1%;
            }
            
            .pwd:hover{
                background-color: green;
            }
           
            a.active{
                color: #989bed;
            }
            a{
                color: white;
            }
            
            a:hover{
                color: #a5a8f0;
            }
            
            .iframe-style{
                border:none;
                width:100%;
                height:700px;
                margin-top:-154px;
            }
            .dropbtn{
                background-color: #06800a;
            }
    
            /*************************log_out_box*******************************************/
            .log_out_box{
                border-spacing: 20px;
               margin: 20PX;
            }
            /******************************************************************************/
        </style>
    </head>
    <body>
        <div class="row">
                <div class="col-md-12">
                        <nav class="navbar first nav-animation navbar-default navbar-fixed-top">
                            <div class="col-md-6">
                             <a class="navbar-brand" href="#">GREEN BANKING</a>
                            </div>
                            <div class="col-md-6">
                                <table class="nav_table">
                                    <tr>
                                        <td>
                                            <?php echo "Welcome  ".$_SESSION['first_name']." ";
                                            echo $_SESSION['last_name'];
                                            ?>
                                        </td>
                                        <td>
                                        <?php
                                            echo date("Y-m-d");
                                            ?>
                                        </td>
                                        <td>
                                            <i class="fa fa-user-circle-o" style="font-size:24px;color:blue;" onclick="document.getElementById('id02').style.display='block'" id="change" title="Detail" data-toggle="detail" data-placement="bottom"></i>
                                        </td>
                                        <td>
                                            <i class="fa fa-sign-out" style="font-size:24px;color:blue;" title="Log Out" onclick="document.getElementById('id04').style.display='block'" data-toggle="log_out" data-placement="bottom"></i>
                                        </td>
                                        <td>
                                            <?php 
                                                $path = $_SESSION['path'];
                                                $img = $_SESSION['img'];
                                                echo "<img src=".$path."/".$img.">";
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                                
                            </div>
                        </nav>    
            </div>
        </div>
        
<!--****************second navbar************************-->
        <div class="row">
            <div class="col-md-12">
                <div class="nav-child-full">
                    <div class="row-my">
                    <div class="dropdown-T">
                        <button class="dropbtn nav-child-color">
                            <div class="font-vw-1">
                             <i class="fa fa-home active" style="font-size: 25px;color:white">&nbsp;&nbsp;<a href="dash_admin_page.php" target="page1" style="text-decoration:none">Dashboard</a></i>
                            </div>
                        </button>
                    </div>
                    
                    <div class="dropdown-T">
                        <button class="dropbtn nav-child-color" >
                            <div class="font-vw-1">
                             <i class="fa fa-user-o">&nbsp;&nbsp;My Profile</i>
                            </div>
                        </button>
                        <div class="dropdown-content font-vw-1">
                            <a href="edit_profile.php" target="page1">Edit Profile</a>
                            <a href="#" onclick="document.getElementById('id03').style.display='block'">Change Password</a>
                        </div>
                    </div>

                    <div class="dropdown-T">
                        <button class="dropbtn nav-child-color">
                            <div class="font-vw-1">
                             <i class="fa fa-user" style="">&nbsp;&nbsp;Add User</i> 
                            </div>
                        </button>
                        <div class="dropdown-content font-vw-1">
                            <a href="add_user.php" target="page1">Add New User</a>
                            <a href="add_admin.php" target="page1"> Add New Admin</a>
                        </div>
                    </div>
                    
                <div class="dropdown-T">
                    <!--First item-->
                    <button class="dropbtn nav-child-color">
                        <div class="font-vw-1">
                         <i class="fa fa-users">&nbsp;&nbsp;Manage Coustmer</i>
                        </div>
                    </button>
                    <div class="dropdown-content font-vw-1">
                        <a href="users.php" id="" target="page1"> Users</a>
                        <a href="Account_Details.php" target="page1">Account Details</a>
                    </div>
                </div>
                    
                <div class="dropdown-T">
                    <!--First item-->
                    <button class="dropbtn nav-child-color" >
                        <div class="font-vw-1">
                          <i class="fa fa-clone">&nbsp;&nbsp; <a href="" style="text-decoration:none">Notification</a></i>
                        </div>
                    </button>
                    <div class="dropdown-content font-vw-1">
                        <a href="Notification_send.php" target="page1">Send Message</a>
                        <a href="Show_Notification.php" target="page1">Show Message</a>
                    </div>
                </div>
                    </div> 
                </div>
            </div>
        </div>
<!--****************************************************-->      
        
<!--Details poup box *************************-->
<div class="row">
<div class="col-md-12">    
  <div id="id02" class="mod">
    <div class="mod-content animate">
          <div class="box_nav">
            Details
        </div>
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal" id="cancel2">&times;</span>
      
    </div>
      <center>
      <table class="box_tb cont">
          <tr>
              <td><samp>Name : </samp><?php echo $_SESSION['first_name']." ".$_SESSION['last_name'];?></td>
              <td><samp>Email : </samp><?php echo $_SESSION['email'];?></td>
          </tr>
          <tr>
              <td><samp>Phone : </samp><?php echo $_SESSION['number'];?></td>
              <td><samp>Last Login time : </samp><?php echo $_SESSION['log_time']?></td>
          </tr>
          <tr>
              <td><samp>NIC : </samp><?php echo $_SESSION['NIC'];?></td>
          </tr>
      </table>
    </center>      
      </div>
      
  </div>      
</div>
</div>
<!--***********************************************************************-->
        
<!--Log out box *************************-->
<div class="row">
<div class="col-md-12">
  <div id="id04" class="mod">
    <div class="mod-content animate">
        <div class="box_nav">
        Log out Confirm
        </div>
    <div class="imgcontainer">
      <span onclick="document.getElementById('id04').style.display='none'" class="close" title="Close Modal" id="cancel2">&times;</span>
        
    </div>
    <center>
        <table class="log_out_box">
            <tr>
                <td>Are you sure you want to logout?</td>
                <td>
                <input type="button" value="No" class="btn" style="color:black;width:48%;" onclick="document.getElementById('id04').style.display='none'">
                <a href="logout.php"><input type="button" value="Yes" class="btn" style="color:black;width:48%;"> </a></td>
            </tr>
        </table>
    </center>      
    </div>
      
  </div>      
</div>
</div>
<!--***********************************************************************-->

<!--change pasword poup box *************************-->
<div class="row">
<div class="col-md-12">    
  <div id="id03" class="mod">

    <!--<div class="change_pwd_tb ">-->
    <div class="mod-content animate">
        <div class="box_nav">
        change password
        </div>
    <div class="imgcontainer">
      <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal" id="cancel2">&times;</span>
        
    </div>
      <center>
    <form method="post">
      <table class="box_tb cont" >
          <tr>
              <td>
                  Current Password : 
              </td>
              <td>
                  <input type="password" class="form-control pwdbtn1" name="current_pwd" style="width:85%;">
                  <button class="btn btn1" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
              </td>
          </tr>
          <tr>
              <td>
                  New Password : 
              </td>
              <td>
                  <input type="password" class="form-control pwdbtn2" name="new_pwd1" style="width:85%;">
                   <button class="btn btn2"  type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
              </td>
          </tr>
          <tr>
              <td>
                  Confirm New Password : 
              </td>
              <td>
                  <input type="password" class="form-control pwdbtn3" name="new_pwd2" style="width:85%;">
                   <button class="btn btn3" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
              </td>
          </tr>
          <tr>
              <td>
              </td>
              <td>
                  <input type="reset" value="Cancel" class="btn pwd" style="width:48%;">
                  <input type="submit" name="pwd_change" value="Save" class="btn pwd" style="width:48%;">
              </td>
          </tr>
        </table>
        </form>
    </center>      
      </div>
      
  </div>      
</div>
</div>
<!--***********************************************************************-->
        

<br>    
<div class="row">
    <div class="col-md-12">
        <iframe class="iframe-style" name="page1" src="dash_admin_page.php">
            
        </iframe>
    </div>
</div>
        
<!--Auto logout code *************************-->
<script>
    /*$(function()
    {
        function timeChecker()
        {
            setInterval(function(){
               var storredTimeStamp = sessionStorage.getItem("lastTimeStamp");
                timeCompare(storredTimeStamp);
            },3000);
        }
        
        function timeCompare(timeString){
        var currentTime = new Date();
        var pastTime = new Date(timeString);
        var timeDiff = currentTime - pastTime;
        var minPast = Math.floor( (timeDiff/60000) );
        
        if( minPast > 10)
        {
            window.location="logout.php";
            return false;
        }else{
                console.log(currentTime + " - "+pastTime+"-"+minPast+"min past");
                }
        }
        $(document).mousemove(function(){
           var timestap = new Date();
        
            sessionStorage.setItem("lastTimeStamp",timestap);
        });
        
        timeChecker();
    });*/
</script>
<!--*****************************************************************--> 
<!--*******************show password*********************************-->

<script>
    $(".btn1").on('click',function() {
    var $pwd = $(".pwdbtn1");
    if ($pwd.attr('type') == 'password') {
        $pwd.attr('type', 'text');
    } else {
        $pwd.attr('type', 'password');
    }
});
    
    $(".btn2").on('click',function() {
    var $pwd = $(".pwdbtn2");
    if ($pwd.attr('type') == 'password') {
        $pwd.attr('type', 'text');
    } else {
        $pwd.attr('type', 'password');
    }
});
    
$(".btn3").on('click',function() {
    var $pwd = $(".pwdbtn3");
    if ($pwd.attr('type') == 'password') {
        $pwd.attr('type', 'text');
    } else {
        $pwd.attr('type', 'password');
    }
});
</script> 

<!--**************************main *******************************--> 
<script>
    $(document).ready(function(){
        //$('main').load('edit_profile.php');
        
        $('a').click(function(){
            $('iframe').html('<center><img src="../img/load.svg"></center>');
            
            $('a').removeClass('active');
            $(this).addClass('active');
            
           /* var link=$(this).attr('id');
            $('main').load(link);*/
        });
    });
</script>
<!--**************************************************************-->
        
<!--****************tooltip**************************************-->

<script>
     $(document).ready(function(){
        $('[data-toggle="log_out"]').tooltip({
                  //trigger:'click'
        });
         
        $('[data-toggle="detail"]').tooltip({
        });
    });
</script>
<!--****************************************************************-->
    </body>
</html>