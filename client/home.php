<?php 

    require_once('./code/conn.php');
    session_start();
    require('./code/userpost-req.php');
    require('./components/header.php');
    require('./components/navbar.php');
    require('./redirecting.php');

?>

<div class="wrapper">
    <div class="hometext"><span>HOME</span></div>
    <form class="post" method="POST" action="<?php $_SERVER['PHP_SELF']?>">
        <textarea name="status" placeholder="Share your Thoughts" id="status" cols="30" rows="10"></textarea>
        <span id='postErr' class='form-text'><?php echo $postErr; ?> </span>
        <button style="border:none;" class="btn btn-primary" type="submit" name="post">POST</button>
    </form>
    <?php
    $q = "SELECT * FROM `post` WHERE `status` = 'active' ORDER BY posted_at DESC";
    $r = mysqli_query($conn,$q);
    if(mysqli_num_rows($r) > 0){
        while ($row = mysqli_fetch_assoc($r)){
            require('./components/postview.php');
        }
    }else{
        echo "<h1 style=\"width:100%; text-align:center;\" > NO ONE POSTED YET </h1>";
    }
    ?>
</div>




<?php require('./components/footer.php')?>
