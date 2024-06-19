<?php require('./config/post.php');?>


<!-- html header -->
<?php require('./components/header.php');?>
<?php require('./components/navbar.php');?>
<div class="wrapper">
    <form class="post" method="POST" action="<?php $_SERVER['PHP_SELF']?>">
        <textarea name="status" placeholder="Share your Thoughts" id="status" cols="30" rows="10"></textarea>
        <span id='postErr' class='form-text'><?php echo $postErr; ?> </span>
        <button style="border:none;" class="btn btn-primary" type="submit" name="post">POST</button>
    </form>
    <?php
    $sessId = $_SESSION['id'];
    $q = "SELECT * FROM `post` WHERE `account_id` = $sessId AND `status` = 'active' ORDER BY posted_at DESC";
    $r = mysqli_query($conn,$q);
    while ($row = mysqli_fetch_assoc($r)){

        require('./components/userpost.php');
    }

    ?>

</div>
<!-- html footer -->
<?php require('./components/footer.php');?>