<?php

require('inc/connection.php'); ?>

<?php require('inc/header.php'); ?>
<?php require('inc/navbar.php'); ?>
<?php 


 /*       Authentication    */
 if(!isset( $_SESSION['admin_id'] ))
 {
     header("location:login.php");
 }
 

$query="select `id`,`title`,`created_at` from `posts` " ;
$result=mysqli_query($connection,$query);
if(mysqli_num_rows($result)>0){
   $posts= mysqli_fetch_all($result,MYSQLI_ASSOC);
}


?>

<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="d-flex justify-content-between border-bottom mb-5">
                
                <div>
                    <h3>All posts</h3>
                </div>
                <?php if(isset($_COOKIE['flash_message'])): ?>
                <div>
                    <h3>
                        <?= $_COOKIE['flash_message'] ;?>
                    </h3>
                </div>
                <?php endif; ?>
                <div>
                    <a href="create-post.php" class="btn btn-sm btn-success">Add new post</a>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Published At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($posts as $post): ?>
                    <tr>
                        <td><?= $post['title']?></td>
                        <td><?= $post['created_at']?></td>
                        <td>
                            <a href="show-post.php?id=<?= $post['id']?>" class="btn btn-sm btn-primary">Show</a>
                            <a href="edit-post.php?id=<?= $post['id']?>" class="btn btn-sm btn-secondary">Edit</a>
                            <a href="delete-post.php?id=<?= $post['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('do you really want to delete post?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require('inc/footer.php'); ?>