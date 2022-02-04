<?php
 require('inc/connection.php');
if(isset($_POST['submit'])){
    $title=trim(stripslashes(htmlspecialchars($_POST['title'])));
    $body=trim(stripslashes(htmlspecialchars($_POST['body'])));

    // validation
   
    $errors=[];
    if(empty($title)){
        $errors[]="Title is requierd" ;
    }elseif(!is_string($title)){
        $errors[]="Title must be string";
    }elseif(strlen($title)>255){
        $errors[]="Title must be less than 255 char";
    }

    if(empty($body)){
        $errors[]="body is requierd" ;
    }elseif(!is_string($body)){
        $errors[]="body must be string";
    }
    // echo "<pre>";
    // print_r($errors);
    // echo "</pre>";
    //insert
    if(empty($errors)){
        $query="INSERT INTO `posts`( `title`, `body`, `user_id`) values ('$title','$body','1')";
        $result=mysqli_query($connection,$query);
        if($result ==1){
            setcookie("flash_message","data is inserted",time() +3,'/');
            header("location: index.php");
        }
        
    }else{
        $_SESSION['errors']= $errors;
        header("location:create-post.php");
    }
 

}