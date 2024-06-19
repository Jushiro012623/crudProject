
<!-- polish after finish -->


<?php

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
            // $query = "INSERT INTO `user_account` (`username`,`password`,`email`,`status`) VALUES ('$username','$dbPWD','$email','active')";
            // $result = mysqli_query($conn, $query);
            // header('Refresh:1 ; /crudapp/client/index.php');
        }
    }

    //start session only when logged in
    session_start();
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
            if(mysqli_num_rows($result)){
                if($row['status'] == 'inactive'){
                    $passwordErr = "User not found";
                }else{
                    $loadingAnim = true;
                    header('Refresh:1 ; /crudapp/client/home.php');
                }
            }
        }
    }
        
        
    
    // if(isset($_POST['login'])){
    //     //user credentials
    //     $username = $_POST['username'];
    //     $password = $_POST['password'];
    //     //sql query
    //     $query = "SELECT * FROM `user_account` WHERE `username` = '$username' AND `password` = '$password'";
    //     $result = mysqli_query($conn, $query);
        
    //     //if theres a result
    //     if(mysqli_num_rows($result)){
            
    //         $row = mysqli_fetch_assoc($result);
    //         //if active then login
    //         if($row['status'] == 'active'){
    //             echo 'active ';
    //             echo 'success';
    //             //sessions the user info
    //             $_SESSION['id'] = $row['id'];
    //             echo $_SESSION['id'];
    //             $_SESSION['username'] = $row['username'] ;
    //             $_SESSION['firstname'] = $row['firstname'];
    //             $_SESSION['lastname'] = $row['lastname'];
    //             $_SESSION['email'] = $row['email'];
    //             $_SESSION['mobile'] = $row['mobile'];
    //             $_SESSION['bday'] = $row['bday'];

    //         }else{ // if the account is inactive 
    //             echo 'inactive';
    //         }
    //     }else{ //if no user found
    //         echo 'no users found';
    //     }
    //     //add validation next
        
    // }


    //Profile post 

    if (isset($_POST['edit_profile'])){
        //set the session id to variable id
        $id = $_SESSION['id'];
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $bday = $_POST['bday'];

        // if the firstname input is touch and has a str count of 1 (lenght of 1? is that even a name?)
        if(strlen($firstname) == 1 AND !empty($firstname) ){
            echo ' invalid';
        }else{// if the firstname is untouch firstname is not set 
            echo ' valid';
            //update the value
            $query = "UPDATE `user_account` SET `username` = '$username',
            `firstname` = '$firstname',`lastname` = '$lastname',`email` = '$email',
            `mobile` = '$mobile',`bday` = '$bday' WHERE `id` = $id ";
            $result = mysqli_query($conn, $query);
            echo $id;
        }
        #add readonly and editable
        //next add validation
    }
?>