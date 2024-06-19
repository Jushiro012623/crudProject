
<!-- polish after finish -->


<?php

session_start();
    //include connection
    require('./config/conn.php');
    $username = $email = $password = $confirm_password = "";
    $usernameErr = $emailErr = $passwordErr = $confirm_passwordErr = "";
    $sendToDB = true;
    $loadingAnim = false;
    // Register post
    if($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['register'])){
        //user input
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
        
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
        //hash password
        $dbPWD = password_hash($password, PASSWORD_DEFAULT);
        $confirmPWD = password_hash($confirm_password, PASSWORD_DEFAULT);//password in db

        //username validation
        if(empty($username)){
            $usernameErr = "Username must not be empty";
            $sendToDB = false;
        }
        if(!preg_match("/^[a-zA-Z0-9-']*$/", $username)){
            $usernameErr = 'Username must not have special characters';
            $sendToDB = false;  
        }
        if(strlen($username)< 8 AND strlen($username) > 0){
            $usernameErr = "Username must be atleast 8 characters long";
            $sendToDB = false;  
        }
        //email validation
        if(empty($email)){
            $emailErr = "Email must not be empty";
            $sendToDB = false;  
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr = "Please input a valid email address";
            $sendToDB = false;  
        }
        //password validation
        if(empty($password)){
            $passwordErr = "Password must not be empty";
            $sendToDB = false;  
        }
        if(strlen($password)<8 AND strlen($password) > 0){
            $passwordErr ="Password must be atleast 8-25 characters";
            $sendToDB = false;  
        }
        //confirm password validation
        if($password !== $confirm_password){
            $confirm_passwordErr = "Password don't match";
            $passwordErr = "Password don't match";
            $sendToDB = false;  
        }
        //check if username and email is already exist
        $query = "SELECT * FROM `user_account` WHERE `username` = '$username' OR `email` = '$email'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
        //check the results
        if($count > 0){
        //email exist validation
            if($row['username'] == $username){
                $usernameErr = 'Username already taken';
                $sendToDB = false;
            }//email exist validation
            if($row['email'] == $email){
                $emailErr = 'Email address already taken';
                $sendToDB = false;
            }
        }
        //send to db if sendToDB is true
        if($sendToDB == true){
            $loadingAnim = true;
            // // echo "success sending";
            $query = "INSERT INTO `user_account` (`username`,`password`,`email`,`status`) VALUES ('$username','$dbPWD','$email','active')";
            $result = mysqli_query($conn, $query);
            header('Refresh:1 ; /crudapp/client/index.php');
        }
    }

    //start session only when logged in
    if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['login'])){
        
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        //validation of username
        if(empty($username)){
            $usernameErr = "Username must not be empty";
            $sendToDB = false;
        }
        if(!preg_match("/^[a-zA-Z0-9-']*$/", $username)){
            $usernameErr = 'Username must not have special characters';
            $sendToDB = false;  
        }
        if(strlen($username)< 8 AND strlen($username) > 0){
            $usernameErr = "Username must be atleast 8 characters long";
            $sendToDB = false;  
        }
        //password validation
        if(empty($password)){
            $passwordErr = "Password must not be empty";
            $sendToDB = false;  
        } 
        if(strlen($password)<8 AND strlen($password) > 0){
            $passwordErr ="Password must be atleast 8-25 characters";
            $sendToDB = false;  
        }
        // send req to db
        if($sendToDB == true){
            $query = "SELECT * FROM `user_account` WHERE `username` = '$username' ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            if(mysqli_num_rows($result) == 1 AND  $username ==$row['username'] and password_verify($password, $row['password'])){
                if($row['status'] == 'inactive'){
                    $passwordErr = "User not found";
                }else{
                    $loadingAnim = true;
                    //sessions the user info
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'] ;
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['mobile'] = $row['mobile'];
                    $_SESSION['bday'] = $row['bday'];
                    header('Refresh:1 ; /crudapp/client/home.php');
                }
            }else{
                $passwordErr = "User not found";
            }
        }
    }
    $postErr = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['post'])){
        $post = mysqli_real_escape_string($conn, $_POST['status']);
        $postID = $_SESSION['id'];
        $poster = $_SESSION['username'];
        if(!empty($post)){
            $query = "INSERT INTO `post`(`body`,`poster`,`account_id`, `status`) VALUES ('$post','$poster', '$postID', 'active')";
            $result = mysqli_query($conn, $query);
        }else{
            $postErr = 'Post something';
        }
    }
    

    if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['delete'])){
        $deletedID = $row['id'];
        $query = "UPDATE `post` SET `status` = 'archive' WHERE `id` = $deletedID ";
        $result = mysqli_query($conn, $query);
    }