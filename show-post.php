<?php require('inc/connection.php'); ?>
<?php require('inc/header.php'); ?>
<?php require('inc/navbar.php'); ?>
<?php 


 /*       Authentication    */
 if(!isset( $_SESSION['admin_id'] ))
 {
     header("location:login.php");
 }
 



 if(isset($_GET['id'])){
     $id=$_GET['id'];
     $query="select `title` ,`body` from `posts` where `id`='$id' " ;
     $result=mysqli_query($connection,$query);
     if(mysqli_num_rows($result)==1){
        $post=mysqli_fetch_assoc($result);
     }
 }else{
     header("location:index.php");
 }

?>

<div class="container-fluid pt-4">
    <div class="row">
        <?php if(isset($post)): ?>
        <div class="col-md-10 offset-md-1">
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3><?= $post['title']?></h3>
                </div>
                <div>
                    <a href="index.php" class="text-decoration-none">Back</a>
                </div>
            </div>
            <div>
                <?= $post['body']?>
            </div>
        </div>
        <?php else:  ?>
        <div class="alert alert-danger text-center"> post is not found in database</div>
        <?php endif ; ?>
    </div>
</div>

<?php require('inc/footer.php'); ?>