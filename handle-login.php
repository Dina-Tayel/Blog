<?php 
 require('inc/connection.php');

 /*       Authentication    */
if(!isset( $_SESSION['admin_id'] ))
{
    header("location:login.php");
}



if(isset($_POST['submit'])){
 $email=trim(stripslashes(htmlspecialchars($_POST['email'])));
 $password=trim(stripslashes(htmlspecialchars($_POST['password'])));
 
  
 // vaildationEmail -requierd - valid email  - length<255 (unique in mysql)
 $errors=[];
 if( empty($email)){
     $errors[]='email is requierd ! ' ;
 }elseif( ! filter_var($email , FILTER_VALIDATE_EMAIL)){
    $errors[]= 'email is not valid !';
 }elseif(strlen($email)>255){
     $errors[]='email must be less than 255 characters ' ;
 }

 // vaildationPassword -requierd -password  - length<255
 if(empty($password)){
     $errors[]='password is requierd !' ;
 }elseif(strlen($password)>64){
    $errors[]='password must be less than 64 characters ' ;
}elseif( is_numeric($password)){
    $errors[]="Password must be string";
}

// compare data in database
 if(empty($errors)){
        $query="SELECT * FROM  `users` WHERE email='$email'";
        $result=mysqli_query($connection,$query);
            if(mysqli_num_rows($result)==1){
                $row= mysqli_fetch_assoc($result);
                $isVerify=password_verify($password,$row['password']);
                if($isVerify==true){
                    
                    $_SESSION['admin_id']=$row['id'];
                    $_SESSION['admin_email']=$row['email'];
                    header("location:index.php");
                }else {
                    $_SESSION['errors']=['credentials not correct '];
                    header("location:login.php");
                }
            }else{
            $_SESSION['errors']=['credentials not correct '];
            header("location:login.php");
            }



 }else{
     $_SESSION['errors']=$errors;
     header("location:login.php");
 }



}else{
    header("location:login.php");
}