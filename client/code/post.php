
<!-- polish after finish -->


<?php

    //include connection
    require('./code/conn.php');

    // Register post
    
    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $date_time = date("Y/m/d h:i:s");
        if(!empty($username) AND !empty($password) AND !empty($email)){
            if(strlen($username)<8){
                echo 'your username is too short';
            }
            else{
                if($password != $confirm_password){
                    echo 'password don\'t match';
                }else{
                    $query = "SELECT * FROM `user_account` WHERE `username` = '$username' OR `email` = '$email'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);

                    if ($row['username'] == $username){
                        echo 'username is taken';
                    }else if($row['email'] == $email){
                        echo 'email is taken';
                    }else{ 
                        $query = "INSERT INTO user_account (`username`,`password`,`email`,`status`) VALUES ('$username','$password','$email','active')";
                        $result = mysqli_query($conn, $query);
                        echo "registered successfully";     
                        header('Location: /crudapp/client/index.php');
                    }
                }
            }
        }else{
            echo 'all field must be filled';
        }
        //add regex and another validation
        //header 
    }


    //start session only when logged in
    session_start();

    if(isset($_POST['login'])){
        //user credentials
        $username = $_POST['username'];
        $password = $_POST['password'];
        //sql query
        $query = "SELECT * FROM `user_account` WHERE `username` = '$username' AND `password` = '$password'";
        $result = mysqli_query($conn, $query);
        
        //if theres a result
        if(mysqli_num_rows($result)){
            
            $row = mysqli_fetch_assoc($result);
            //if active then login
            if($row['status'] == 'active'){
                echo 'active ';
                echo 'success';
                //sessions the user info
                $_SESSION['id'] = $row['id'];
                echo $_SESSION['id'];
                $_SESSION['username'] = $row['username'] ;
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['mobile'] = $row['mobile'];
                $_SESSION['bday'] = $row['bday'];

            }else{ // if the account is inactive 
                echo 'inactive';
            }
        }else{ //if no user found
            echo 'no users found';
        }
        //add validation next
        
    }


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