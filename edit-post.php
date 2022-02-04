<?php require('inc/connection.php'); ?>
<?php require('inc/header.php'); ?>
<?php require('inc/navbar.php'); ?>
<?php 

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query="select `id`, `title`,`body` from `posts` where `id`='$id' " ;
    $result=mysqli_query($connection,$query);
    if(mysqli_num_rows($result)==1){
       $posts= mysqli_fetch_assoc($result);
    }
    
}else{

    header("location:index.php");
}


?>
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3>Edit post</h3>
                </div>
                <div>
                    <a href="index.php" class="text-decoration-none">Back</a>
                </div>
            </div>
            <?php if(!empty($_SESSION['errors'])): ?>
            <div class="alert alert-danger">
                    <?php foreach( $_SESSION['errors'] as $error): ?>
                   
                        <p> <?= $error; ?></p>
                   
                    <?php endforeach ; ?>
                    </div>

            <?php endif; session_unset(); ?>
            <form method="POST" action="update-post.php">
                    <input type="hidden" name="id" value="<?= $posts['id']?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $posts['title']?>">
                </div>

                <div class="mb-3">
                    <label for="body" class="form-label">Body</label>
                    <textarea class="form-control" id="body" name="body" rows="5" >o<?= $posts['body']?></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php require('inc/footer.php'); ?>