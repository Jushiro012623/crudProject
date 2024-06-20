<?php

    $username = $email = $password = $confirm_password = "";
    $usernameErr = $emailErr = $passwordErr = $confirm_passwordErr = "";
    $sendToDB = true;
    $loadingAnim = false;
    $postErr = '';
    //LOGIN POST 
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
                    $_SESSION['email'] = $row['email'];
                    header('Refresh:1 ; /crudapp/client/home.php');
                }
            }else{
                $passwordErr = "User not found";
            }
        }
    }
    
    if(isset($_SESSION['id']) AND isset($_SESSION['username']) AND  isset($_SESSION['email'])){
        header('Location: /crudapp/client/home.php');
        exit;
    }
?>