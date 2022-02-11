<?php require('inc/connection.php'); 

if(!isset( $_SESSION['admin_id'] ))
{
    header("location:login.php");
}

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query="delete from `posts` where `id`='$id'";
    $result=mysqli_query($connection,$query);
    if($result==1){
        setcookie("flash_message","data is deleted",time() +3,'/');
        header("location: index.php");
    }
}