<?php
    require('./code/post.php');
    
?>
<!-- html header -->
<?php require('./components/header.php');?>
<section class="login-wrapper">

    <form   class="form"
            action="<?php $_SERVER['PHP_SELF'];?>"
            method="POST"
    >
        <!-- <h3>Register</h3> -->
        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">
                Username
            </label>
            <input type="text" class="form-control" id="username"  name="username" autocomplete="off" >
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
        </div>
        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">
                Email
            </label>
            <input type="email" name="email" class="form-control" id="email" autocomplete="off"  >
        </div>
        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">
                Password
            </label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="confirm_password" class="form-label">
                Confirm Password
            </label>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password">
        </div>
        <!-- Submit button -->
        <button type="submit" name="register" class="btn btn-primary">Register</button>
    </form>
    <h1></h1>
</section>

<!-- html footer -->
<?php require('./components/footer.php');?>