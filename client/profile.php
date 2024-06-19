<?php 
    require('./config/post.php');
    require('./components/header.php');
    require('./components/navbar.php');
    require('./redirecting.php');

?>
<div class="wrapper">
    <form class="post" method="POST" action="<?php $_SERVER['PHP_SELF']?>">
        <textarea name="status" placeholder="Share your Thoughts" id="status" cols="30" rows="10"></textarea>
        <span id='postErr' class='form-text'><?php echo $postErr; ?> </span>
        <button style="border:none;" class="btn btn-primary" type="submit" name="post">POST</button>
    </form>
    <?php
    $sessId = $_SESSION['id'];
    $query = "SELECT * FROM `post` WHERE `account_id` = $sessId AND `status` = 'active' ORDER BY posted_at DESC";
    $result = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_assoc($result)){

        require('./components/postview.php');
    }
    ?>

</div>
<!-- html footer -->
<?php require('./components/footer.php');?>