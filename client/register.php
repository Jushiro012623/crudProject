<?php
    require('./config/post.php');
    
?>
<!-- html header -->
<?php require('./components/header.php');?>
<section class="login-wrapper">

    <form   class="form"
            action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>"
            method="POST"
            autocomplete="off" 
    >
        <!-- <h3>Register</h3> -->
        <!-- Username -->
        <div class="forminput mb-3">
            <label for="username" class="form-label">
                Username
            </label>
            <input type="text" class="form-control" id="username" value="<?php echo $username?>" name="username" >
            <span id='userErr' class='form-text'><?php echo $usernameErr; ?> </span>
        </div>
        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">
                Email
            </label>
            <input type="text" name="email" class="form-control" id="email" value="<?php echo $email?>" >
            <span id='userErr' class='form-text'><?php echo $emailErr; ?> </span>
        </div>
        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">
                Password
            </label>
            <input type="password" class="form-control" name="password" id="password" value="<?php echo $password?>">
            <span id='userErr' class='form-text'><?php echo $passwordErr; ?> </span>
        </div>
        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="confirm_password" class="form-label">
                Confirm Password
            </label>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" value="<?php echo $confirm_password?>">
            <span id='userErr' class='form-text'><?php echo $confirm_passwordErr; ?> </span>
        </div>
        <!-- Submit button -->
        <button type="submit" name="register" class="btn_signup btn btn-primary" ><?php if($loadingAnim == false ){echo 'Register';}else{echo '<i class="loading fa-solid fa-spinner"></i>';}?></button>
        <a href="index.php" class="signup_link">already have an account?</a>

    </form>
    <h1></h1>
</section>

<!-- html footer -->
<?php require('./components/footer.php');?>