<?php
require('inc/connection.php');

 /*       Authentication    */
 if(!isset( $_SESSION['admin_id'] ))
 {
     header("location:login.php");
 }
 



if(isset($_POST['submit'])){
    $title=trim(stripslashes(htmlspecialchars($_POST['title'])));
    $body=trim(stripslashes(htmlspecialchars($_POST['body'])));
    $id=trim(stripslashes(htmlspecialchars($_POST['id'])));


    // validation
    // validate title requierd | length <255 | string 
    $errors=[];
    if(empty($title)){
        $errors[]="Title is requierd" ;
    }elseif(is_numeric($title)){
        $errors[]="Title must be string";
    }elseif(strlen($title)>255){
        $errors[]="Title must be less than 255 char" ;
    }
     // validate body requierd | string 
    if(empty($body)){
        $errors[]= "body is requierd" ;
    }elseif(is_numeric($body)){
        $errors[]="body must be string";
    }
    // echo "<pre>";
    // print_r($errors);
    // echo "</pre>";
    
    //update
    if(empty($errors))
    {
        $query = "UPDATE posts SET title='$title' , body='$body' WHERE id = '$id' ";
        // print_r($query);die;
        $result = mysqli_query($connection,$query);
        if($result){
            setcookie("flash_message","data is updated successfully",time() +3,'/');
            header("location: index.php");
        }else{
            echo "error in update";

        }
        
        
    }else{
        $_SESSION['errors']= $errors;
        header("location:edit-post.php?id=$id");
    }
 
}else{
     header("location:index.php");
}



