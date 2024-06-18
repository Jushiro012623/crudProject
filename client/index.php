
<!-- html body -->
<?php require('./components/header.php');?>
<?php
    require('./code/post.php');
?>

<section class="login-wrapper">

    <form   class="form"
            action="<?php $_SERVER['PHP_SELF'];?>"
            method="POST"
    >
    <!-- <h1>Login</h1> -->
        <!-- Username -->
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">
            Username
        </label>
        <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
    </div>
    <!-- Password -->
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">
            Password
        </label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    <!-- Submit button -->
    <button type="submit" name="login" class="btn btn-primary" onClick={handleSubmit} 
        
    >Login</button>
    </form>

</section>

<?php require('./components/footer.php');?>
