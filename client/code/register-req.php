<?php

$username = $email = $password = $confirm_password = "";
$usernameErr = $emailErr = $passwordErr = $confirm_passwordErr = "";
$sendToDB = true;
$loadingAnim = false;
$postErr = '';
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
    if(isset($_SESSION['id']) AND isset($_SESSION['username']) AND  isset($_SESSION['email'])){
        header('Location: /crudapp/client/home.php');
        exit;
    }
?>