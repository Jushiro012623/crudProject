<?php 
    require_once('./code/conn.php');
    session_start();
    require('./components/header.php');
    require('./components/navbar.php');
    require('./redirecting.php');
    if($_SESSION['postid'] == false){
        header('Location: /crudapp/client/home.php');
    }else{
        $post = $_SESSION['postid'];
        
        $query = "SELECT * FROM `post` WHERE `id` = $post AND `status` = 'active' ";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
        $body = '';
        if(mysqli_num_rows($result) > 0){
            $body = $row['body'];
        }
       
    }
    require('./code/userpost-req.php');
?>
<div class="wrapper">
<div class="hometext" style="margin-bottom: 1em;"><span>EDIT POST</span></div>

    <form class="post" method="POST" action="<?php $_SERVER['PHP_SELF']?>">
        <textarea name="editstatus" placeholder="Share your Thoughts" id="status" cols="30" rows="10"><?php echo $body ;?></textarea>
        <span id='postErr' class='form-text'><?php echo $postErr; ?> </span>
        <button style="border:none;" class="btn btn-primary" type="submit" name="save">SAVE</button>
        <button  type="submit" style="border:none; margin-top:1em;" name="cancel" class="btn btn-secondary" >CANCEL</button>
    </form>

</div>
<!-- html footer -->
<?php require('./components/footer.php');?>