
<!-- html body -->
<?php require('./components/header.php');?>
<?php
    require('./config/post.php');
?>

<section class="login-wrapper">

    <form   class="form"
            action="<?php $_SERVER['PHP_SELF'];?>"
            method="POST"
    >
    <!-- <h1>Login</h1> -->
        <!-- Username -->
    <div class="mb-3">
        <label for="username" class="form-label">
            Username
        </label>
        <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp" value=<?php echo $username; ?>>
        <span id='userErr' class='form-text'><?php echo $usernameErr; ?> </span>    
    </div>
    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">
            Password
        </label>
        <input type="password" name="password" class="form-control" id="password" value=<?php echo $password; ?>>
        <span id='userErr' class='form-text'><?php echo $passwordErr; ?> </span>
    </div>
    <!-- Submit button -->
    <button type="submit" name="login" class="btn_login btn btn-primary">
        <?php if($loadingAnim == false ){echo 'Register';}else{echo '<i class="loading fa-solid fa-spinner"></i>';}?>
    </button>
    <a href="register.php" class="signup_link">don't have an account?</a>
    </form>

</section>

<?php require('./components/footer.php');?>
