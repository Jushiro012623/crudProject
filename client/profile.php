<?php require('./config/post.php');?>


<!-- html header -->
<?php require('./components/header.php');?>
<div>
    <form   class="form"
                action="<?php $_SERVER['PHP_SELF'];?>"
                method="POST"
        >
        <!-- <h3>Register</h3> -->
        <!-- username -->
        <div class="mb-3">
            <label for="username" class="form-label">
                Username
            </label>
            <input type="text" class="form-control" id="username" value="<?php echo $_SESSION['username']?>" name="username" autocomplete="off" >
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
        </div>
        <!-- fname -->
        <div class="mb-3">
            <label for="firstname" class="form-label">
                Firstname
            </label>
            <input type="text" class="form-control" id="firstname"  name="firstname" autocomplete="off" value="<?php echo $_SESSION['firstname']?>" >
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
        </div>
        <!-- lname -->
        <div class="mb-3">
            <label for="lastname" class="form-label">
                Lastname
            </label>
            <input type="text" name="lastname" class="form-control" id="lastname" autocomplete="off"  value="<?php echo $_SESSION['lastname']?>"  >
        </div>
        <!-- mobile -->
        <div class="mb-3">
            <label for="email" class="form-label">
                Email
            </label>
            <input type="tel" class="form-control" name="email" id="email" value="<?php echo $_SESSION['email']?>"  >
        </div>
        <!-- mobile -->
        <div class="mb-3">
            <label for="mobile" class="form-label">
                Mobile
            </label>
            <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $_SESSION['mobile']?>"  >
        </div>
        <div class="mb-3">
            <label for="bday" class="form-label">
                Birthday
            </label>
            <input type="date" class="form-control" name="bday" id="bday" value="<?php echo $_SESSION['bday']?>"  >
        </div>
        <!-- Submit button -->
        <button type="submit" name="edit_profile" class="btn btn-primary">Edit Profile</button>
    </form>
</div>
<!-- html footer -->
<?php require('./components/footer.php');?>