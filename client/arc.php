<?php 
    require_once('./code/conn.php');
    session_start();
    require('./code/userpost-req.php');
    require('./components/header.php');
    require('./components/navbar.php');
    require('./redirecting.php');
?>
<div class="wrapper">
<div class="hometext" style="margin-bottom: 1em;"><span>ARCHIVE</span></div>

    <?php
        $sessId = $_SESSION['id'];
        $query = "SELECT * FROM `post` WHERE `account_id` = $sessId AND `status` = 'archive' ORDER BY posted_at DESC";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            require('./components/archive.php');
        }
    ?>

</div>
<!-- html footer -->
<?php require('./components/footer.php');?>