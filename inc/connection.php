<?php

session_start();
$connection=mysqli_connect("localhost","root","","blog");
if(!$connection){
    die("Error in database Connection :" .mysqli_connect_error($connection));
}