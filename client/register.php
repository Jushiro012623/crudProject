<?php
    require('./code/conn.php');
    
    if(isset($_POST['register'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
        if(!empty($username) AND !empty($password) AND !empty($email)){

            if($password != $confirm_password){
                echo 'password don\'t match';
            }else{
                $query = "INSERT INTO user_account (`username`,`password`,`email`,`status`) VALUES ('$username','$password','$email','active')";
                $result = mysqli_query($conn, $query);
                echo "registered successfully";
            }
        }else{
            echo 'all field must be filled';
        }
    }
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
        <label for="exampleInputEmail1" class="form-label">
            Username
        </label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" >
        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
    </div>
    <!-- Email -->
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">
            Email
        </label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <!-- Password -->
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">
            Password
        </label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
    </div>
    <!-- Confirm Password -->
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">
            Confirm Password
        </label>
        <input type="password" class="form-control" name="confirm_password" id="exampleInputPassword1">
    </div>
    <!-- Submit button -->
    <button type="submit" name="register" class="btn btn-primary" onClick={handleSubmit}>Register</button>
    </form>
</section>
<!-- html footer -->
<?php require('./components/footer.php');?>