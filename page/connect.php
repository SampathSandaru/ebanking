<?php
    $connect=mysqli_connect('localhost','root','','e-bank');
if(mysqli_connect_error())
{
    die('Database connection failed'.mysqli_connect_error());
}else
{
    //echo "Connection successful";
}

?>